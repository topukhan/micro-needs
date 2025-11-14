{{-- resources/views/queryBuilder/query-builder.blade.php --}}
<x-frontend.layouts.master title="Query Builder">

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Database Query Builder</h1>

            <!-- Table Selection -->
            <div class="mb-6">
                <label for="table" class="block text-sm font-medium text-gray-700 mb-2">Select Table</label>
                <select id="table" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">-- Choose a table --</option>
                    @foreach($allowedTables as $table)
                        <option value="{{ $table }}">{{ $table }}</option>
                    @endforeach
                </select>
            </div>

            <!-- AI Prompt Input -->
            <div id="ai-prompt-section" class="mb-6 hidden">
                <label for="prompt" class="block text-sm font-medium text-gray-700 mb-2">
                    AI Prompt (e.g., "Get all active users sorted by name")
                </label>
                <textarea id="prompt" rows="3" placeholder="Describe your query in plain English..."
                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                <p class="mt-1 text-xs text-gray-500">Only SELECT queries are allowed.</p>
            </div>

            <!-- Manual Builder -->
            <div id="manual-builder" class="space-y-6 hidden">

                <!-- Columns Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Columns</label>
                    <div id="columns-container" class="flex flex-wrap gap-2">
                        <!-- Columns will be injected via JS -->
                    </div>
                </div>

                <!-- Filters -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Filters</label>
                    <div id="filters-container" class="space-y-2">
                        <div class="filter-row flex gap-2 items-center">
                            <select class="column-select flex-1 px-3 py-2 border border-gray-300 rounded-md"></select>
                            <select class="operator-select w-32 px-3 py-2 border border-gray-300 rounded-md">
                                <option value="=">=</option>
                                <option value="!=">!=</option>
                                <option value=">">></option>
                                <option value="<"><</option>
                                <option value=">=">>=</option>
                                <option value="<="><=</option>
                                <option value="LIKE">LIKE</option>
                                <option value="NOT LIKE">NOT LIKE</option>
                                <option value="IS NULL">IS NULL</option>
                                <option value="IS NOT NULL">IS NOT NULL</option>
                            </select>
                            <input type="text" class="value-input flex-1 px-3 py-2 border border-gray-300 rounded-md" placeholder="Value">
                            <button type="button" class="remove-filter text-red-600 hover:text-red-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </div>
                    <button id="add-filter" class="mt-2 text-sm text-indigo-600 hover:text-indigo-800">+ Add Filter</button>
                </div>

                <!-- Sort & Limit -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                        <select id="sort_by" class="w-full px-3 py-2 border border-gray-300 rounded-md"></select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Order</label>
                        <select id="sort_order" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Limit</label>
                        <input type="number" id="limit" min="1" max="1000" value="10"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                </div>
            </div>

            <!-- Toggle AI vs Manual -->
            <div class="flex justify-center gap-4 my-6">
                <button id="use-ai" class="px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-md hover:from-purple-700 hover:to-indigo-700 transition">
                    Use AI Prompt
                </button>
                <button id="use-manual" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                    Build Manually
                </button>
            </div>

            <!-- Execute Button -->
            <div class="text-center">
                <button id="execute-query" disabled
                        class="px-6 py-3 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 disabled:bg-gray-400 disabled:cursor-not-allowed transition">
                    Execute Query
                </button>
            </div>

            <!-- Loading & Results -->
            <div id="loading" class="mt-6 hidden text-center">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
                <p class="mt-2 text-gray-600">Executing query...</p>
            </div>

            <div id="results-section" class="mt-8 hidden">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold text-gray-800">Results (<span id="result-count">0</span>)</h3>
                    <button id="copy-query" class="text-sm text-indigo-600 hover:underline">Copy SQL</button>
                </div>
                <div class="bg-gray-900 text-green-400 p-4 rounded-md font-mono text-sm overflow-x-auto mb-4" id="sql-query"></div>
                <div class="overflow-x-auto border border-gray-200 rounded-md">
                    <table class="min-w-full divide-y divide-gray-200" id="results-table">
                        <thead class="bg-gray-50">
                            <tr id="results-header"></tr>
                        </thead>
                        <tbody id="results-body" class="bg-white divide-y divide-gray-200"></tbody>
                    </table>
                </div>
            </div>

            <!-- Error Alert -->
            <div id="error-alert" class="mt-6 hidden p-4 bg-red-50 border border-red-200 text-red-700 rounded-md"></div>
            <div id="warning-alert" class="mt-6 hidden p-4 bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-md"></div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.allowedTables = @json($allowedTables);
    </script>
    <script src="{{ asset('ui/frontend/assets/js/queryBuilder.js') }}"></script>
@endpush

</x-frontend.layouts.master>