<x-frontend.layouts.master>
    <div class="container mx-auto px-4 py-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Control Panel -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800">Control Panel</h2>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('api.simulator.dispatch') }}" id="dispatchForm">
                        @csrf
                        <div class="mb-4">
                            <label for="count" class="block text-gray-700 text-sm font-bold mb-2">Number of
                                Requests</label>
                            <input type="number"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="count" name="count" value="10" min="1" max="50">
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Dispatch Requests
                        </button>
                    </form>

                    <div class="mt-6">
                        <button id="clearLogs"
                            class="w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Clear Logs
                        </button>
                    </div>
                    <span class="text-xs text-gray-600">Note: run queue:work and make sure QUEUE_CONNECTION is set to "database"</span>
                </div>
            </div>

            <!-- Live Processing Feed -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800">Processing Log</h2>
                    <div class="flex items-center">
                        <span id="queueStatus" class="inline-block w-3 h-3 rounded-full bg-gray-400 mr-2"></span>
                        <span id="statusText" class="text-sm text-gray-600">Queue not running</span>
                    </div>
                </div>
                <div class="p-4">
                    <div id="processingLog" class="h-96 overflow-y-auto bg-gray-50 rounded p-4 font-mono text-sm">
                        <div class="text-gray-400">Waiting for jobs...</div>
                    </div>

                    <div class="mt-4 grid grid-cols-3 gap-4 text-center">
                        <div class="bg-blue-50 p-3 rounded">
                            <div class="text-blue-800 font-bold text-xl" id="processedCount">0</div>
                            <div class="text-blue-600 text-sm">Processed</div>
                        </div>
                        <div class="bg-yellow-50 p-3 rounded">
                            <div class="text-yellow-800 font-bold text-xl" id="rateLimitedCount">0</div>
                            <div class="text-yellow-600 text-sm">Rate Limited</div>
                        </div>
                        <div class="bg-gray-50 p-3 rounded">
                            <div class="text-gray-800 font-bold text-xl" id="pendingCount">0</div>
                            <div class="text-gray-600 text-sm">Pending</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // State variables
                const state = {
                    processed: 0,
                    rateLimited: 0,
                    pending: 0,
                    seenLogs: [],
                    expectedJobs: 0
                };


                // DOM elements
                const elements = {
                    logContainer: $('#processingLog'),
                    processedCount: $('#processedCount'),
                    rateLimitedCount: $('#rateLimitedCount'),
                    pendingCount: $('#pendingCount'),
                    queueStatus: $('#queueStatus'),
                    statusText: $('#statusText'),
                    clearLogsBtn: $('#clearLogs'),
                    dispatchForm: $('#dispatchForm'),
                    countInput: $('#count')
                };

                // Initialize
                updateCounters();

                elements.clearLogsBtn.on('click', function() {
                    elements.logContainer.html('<div class="text-gray-400">Logs cleared</div>');
                    resetState();
                    updateCounters();
                });

                // Form submission
                elements.dispatchForm.on('submit', function(e) {
                    e.preventDefault();
                    const form = $(this);
                    const formData = new FormData(this);
                    const submitBtn = form.find('button[type="submit"]');

                    // UI updates
                    submitBtn.prop('disabled', true).text('Dispatching...');
                    elements.logContainer.html('<div class="text-gray-600">Starting job dispatch...</div>');

                    // Reset state
                    resetState();
                    state.expectedJobs = parseInt(elements.countInput.val());
                    state.pending = state.expectedJobs;
                    updateCounters();

                    $.ajax({
                        url: form.attr('action'),
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        success: function(data) {
                            if (data.success) {
                                addLogEntry(
                                    `Successfully dispatched ${state.expectedJobs} jobs to the queue`,
                                    'text-green-600');
                                pollQueueStatus();                                
                            }
                        },
                        error: function(xhr) {
                            addLogEntry(
                                `Error: ${xhr.responseJSON?.message || 'Failed to dispatch jobs'}`,
                                'text-red-600');
                            resetState();
                        },
                        complete: function() {
                            submitBtn.prop('disabled', false).text('Dispatch Requests');
                        }
                    });
                });

                // Poll queue status
                function pollQueueStatus() {
                    $.get('/api/queue-status')
                        .done(function(data) {
                            console.log(data);
                            // Update counters
                            state.processed = data.processed || 0;
                            state.rateLimited = data.rate_limited || 0;
                            state.pending = data.pending || 0;
                            updateCounters();

                            // Update status
                            updateStatus();

                            // Update logs
                            if (data.logs && data.logs.length > 0) {
                                data.logs.forEach(log => {
                                    if (!state.seenLogs.includes(log)) {
                                        const colorClass = log.includes('Rate limit hit') ?
                                            'text-yellow-600' : 'text-green-600';
                                        addLogEntry(log, colorClass);
                                        state.seenLogs.push(log);
                                    }
                                });
                            }

                            // Continue polling if not all jobs are processed
                            if (state.processed < state.expectedJobs) {
                                setTimeout(pollQueueStatus, 1000);
                            console.log(state.processed, state.expectedJobs);

                            } else {
                                addLogEntry('All jobs completed!', 'text-green-600');
                                updateStatus();
                            }
                        })
                        .fail(function() {
                            setTimeout(pollQueueStatus, 2000);
                        });
                }

                // Helper functions
                function updateStatus() {
                    if (state.pending > 0) {
                        elements.queueStatus.removeClass('bg-gray-400 bg-red-400').addClass('bg-green-400');
                        elements.statusText.text('Processing jobs');
                    } else {
                        elements.queueStatus.removeClass('bg-green-400 bg-red-400').addClass('bg-gray-400');
                        elements.statusText.text('Queue idle');
                    }
                }

                function addLogEntry(message, colorClass = 'text-gray-800') {
                    const now = new Date();
                    const timeString = now.toLocaleTimeString();
                    const logEntry = $(`<div class="mb-1 ${colorClass}">[${timeString}] ${message}</div>`);
                    elements.logContainer.append(logEntry);
                    elements.logContainer.scrollTop(elements.logContainer[0].scrollHeight);
                }

                function updateCounters() {
                    elements.processedCount.text(state.processed);
                    elements.rateLimitedCount.text(state.rateLimited);
                    elements.pendingCount.text(state.pending);
                }

                function resetState() {
                    state.processed = 0;
                    state.rateLimited = 0;
                    state.pending = 0;
                    state.seenLogs = [];
                    state.expectedJobs = 0;
                }
            });
        </script>
    @endpush
</x-frontend.layouts.master>
