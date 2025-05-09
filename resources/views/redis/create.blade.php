<x-frontend.layouts.master>
    <div class="max-w-2xl mx-auto mt-10 p-8 bg-white rounded-xl shadow-lg border border-gray-100">

        <div class="mt-12 p-6 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl shadow-inner border border-blue-100">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2 text-red-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                Redis Command Wizard
            </h2>

            <div class="space-y-4">
                <div>
                    <label for="redis-request" class="block text-sm font-medium text-gray-700 mb-1">
                        Tell me what you want to store in Redis:
                    </label>
                    <textarea id="redis-request" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="e.g., 'Create a leaderboard with Alice:100, Bob:85, Charlie:70'"></textarea>
                </div>

                <div class="flex space-x-3">
                    <button id="generate-command" type="button"
                        class="flex items-center justify-center space-x-2 flex-1 bg-gradient-to-r from-purple-500 to-blue-600 hover:from-purple-600 hover:to-blue-700 text-white py-2 px-4 rounded-md font-medium transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <span>Generate Command</span>
                    </button>
                    <button id="execute-command" type="button" disabled
                        class="flex items-center justify-center space-x-2 flex-1 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white py-2 px-4 rounded-md font-medium transition-all disabled:opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Execute Command</span>
                    </button>
                </div>

                <div id="command-display" class="hidden mt-4 p-4 bg-gray-800 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-400">Generated Command:</span>
                        <button id="copy-command" class="text-blue-400 hover:text-blue-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                            </svg>
                        </button>
                    </div>
                    <div id="generated-command"
                        class="p-3 bg-black bg-opacity-50 rounded font-mono text-green-400 overflow-x-auto"></div>
                </div>

                <div id="redis-results" class="hidden mt-6 p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
                    <h3 class="text-lg font-medium text-gray-800 mb-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-amber-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Command Results
                    </h3>
                    <div class="bg-gray-50 p-3 rounded border border-gray-200">
                        <pre id="result-output" class="text-sm font-mono text-gray-800 overflow-x-auto"></pre>
                    </div>
                </div>

                <div id="command-history" class="mt-6">
                    <h4 class="text-sm font-medium text-gray-500 mb-2">Recent Commands</h4>
                    <div id="history-list" class="space-y-2"></div>
                </div>
            </div>
        </div>

    </div>
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Generate Command
                $('#generate-command').click(function() {
                    const input = $('#redis-request').val().trim();
                    if (!input) return;

                    const $btn = $(this);
                    $btn.prop('disabled', true).html('<span class="animate-pulse">Generating...</span>');

                    $.ajax({
                        url: '/redis-wizard/generate-command',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            input: input
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#generated-command').text(response.command);
                                $('#command-display').removeClass('hidden');
                                $('#execute-command').prop('disabled', false);

                                // Add to history
                                addToHistory(response.input, response.command);
                            }
                        },
                        error: function() {
                            alert('Failed to generate command');
                        },
                        complete: function() {
                            $btn.prop('disabled', false).html(
                                '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg><span>Generate Command</span>'
                                );
                        }
                    });
                });

                // Execute Command
                $('#execute-command').click(function() {
                    const command = $('#generated-command').text().trim();
                    if (!command) return;

                    const $btn = $(this);
                    $btn.prop('disabled', true).html('<span class="animate-pulse">Executing...</span>');

                    $.ajax({
                        url: '/redis-wizard/execute-command',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            command: command
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#result-output').text(JSON.stringify(response.result, null, 2));
                                $('#redis-results').removeClass('hidden');

                                // Update history with result
                                updateHistoryWithResult(command, response.result);
                            }
                        },
                        error: function(xhr) {
                            const error = xhr.responseJSON?.message || 'Command execution failed';
                            $('#result-output').text('Error: ' + error);
                            $('#redis-results').removeClass('hidden');
                        },
                        complete: function() {
                            $btn.prop('disabled', false).html(
                                '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg><span>Execute Command</span>'
                                );
                        }
                    });
                });

                // Copy Command
                $('#copy-command').click(function() {
                    const command = $('#generated-command').text();
                    navigator.clipboard.writeText(command);
                    $(this).html(
                        '<svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>'
                        );
                    setTimeout(() => {
                        $(this).html(
                            '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" /></svg>'
                            );
                    }, 2000);
                });

                // History functions
                function addToHistory(input, command) {
                    const historyItem = `
                <div class="p-3 bg-white rounded border border-gray-200 hover:border-blue-300 transition-colors">
                    <div class="text-sm text-gray-600 mb-1">${input}</div>
                    <div class="font-mono text-xs bg-gray-800 text-green-400 p-2 rounded overflow-x-auto">${command}</div>
                    <div class="result-placeholder mt-1 text-xs text-gray-400 hidden">Executing...</div>
                </div>
            `;
                    $('#history-list').prepend(historyItem);
                }

                function updateHistoryWithResult(command, result) {
                    $('.result-placeholder').first()
                        .removeClass('hidden')
                        .html(`<span class="font-medium">Result:</span> ${JSON.stringify(result)}`);
                }
            });
        </script>
    @endpush
</x-frontend.layouts.master>
