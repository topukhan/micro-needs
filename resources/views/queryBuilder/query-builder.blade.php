{{-- resources/views/queryBuilder/query-builder.blade.php --}}
<x-frontend.layouts.master>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-gray-900">Advanced Query Builder</h1>
                </div>

                <div class="p-6">
                    <!-- Table Selection -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Select Table</label>
                            <select class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm" 
                                    id="tableSelect">
                                <option value="">Choose Table...</option>
                                @foreach($allowedTables as $table)
                                    <option value="{{ $table }}">{{ $table }}</option>
                                @endforeach
                            </select>
                        </div>
                       
                    </div>

                    <!-- Columns Display -->
                    <div id="columnList" class="hidden mb-6 p-4 bg-blue-50 border border-blue-200 rounded-md">
                        <div id="columnsContent"></div>
                    </div>

                    <!-- Query Options -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Query Options</h3>
                        
                        <!-- Columns Selection -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Select Columns</label>
                            <div id="columnsCheckbox" class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                <!-- Columns will be populated here -->
                            </div>
                        </div>

                        <!-- Filters -->
                        <div class="mb-4">
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-sm font-medium text-gray-700">Filters</label>
                                <button type="button" id="addFilterBtn" class="bg-green-100 hover:bg-green-200 text-green-700 px-3 py-1 rounded-md transition-colors duration-200 text-sm">
                                    + Add Filter
                                </button>
                            </div>
                            <div id="filtersContainer" class="space-y-2">
                                <!-- Filters will be added here -->
                            </div>
                        </div>

                        <!-- Sorting & Limit -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                                <select class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm" id="sortBy">
                                    <option value="">No sorting</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                                <select class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm" id="sortOrder">
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Limit Results</label>
                                <input type="number" min="1" max="1000" 
                                       class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm" 
                                       id="limit" placeholder="e.g., 100">
                            </div>
                        </div>
                    </div>

                    <!-- AI Prompt -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">AI Query Generator (Optional)</h3>
                        <textarea class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm" 
                                  id="promptInput" rows="3" 
                                  placeholder="Example: Find all orders with status 'pending'"></textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-4">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition-colors duration-200" 
                                id="executeBtn" disabled>
                            Run Query
                        </button>
                        <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-md transition-colors duration-200" 
                                id="resetBtn">
                            Reset
                        </button>
                    </div>

                    <!-- Loading -->
                    <div id="loading" class="hidden mt-6 text-center">
                        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                        <p class="text-gray-600 mt-2">Generating and executing query...</p>
                    </div>

                    <!-- Results -->
                    <div id="results" class="mt-6">
                        <div id="warningAlert" class="hidden bg-yellow-50 border border-yellow-200 rounded-md p-4 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle text-yellow-400 mr-2"></i>
                                <span id="warningText"></span>
                            </div>
                        </div>
                        
                        <div id="errorAlert" class="hidden bg-red-50 border border-red-200 rounded-md p-4 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-times-circle text-red-400 mr-2"></i>
                                <span id="errorText"></span>
                            </div>
                        </div>

                        <div id="successResults" class="hidden">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Query Results</h3>
                                <span id="resultCount" class="text-sm text-gray-500"></span>
                            </div>
                            
                            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200" id="resultTable">
                                        <thead class="bg-gray-50"></thead>
                                        <tbody class="bg-white divide-y divide-gray-200"></tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="mt-4 p-3 bg-gray-50 rounded-md">
                                <code id="generatedQuery" class="text-sm text-gray-600"></code>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Template -->
    <div id="filterTemplate" class="hidden">
        <div class="filter-row flex items-end space-x-2 p-3 bg-gray-50 rounded-md">
            <div class="flex-1">
                <label class="block text-xs font-medium text-gray-500 mb-1">Column</label>
                <select class="w-full rounded border border-gray-300 px-2 py-1 text-sm filter-column">
                    <option value="">Select column</option>
                </select>
            </div>
            <div class="w-24">
                <label class="block text-xs font-medium text-gray-500 mb-1">Operator</label>
                <select class="w-full rounded border border-gray-300 px-2 py-1 text-sm filter-operator">
                    <option value="=">=</option>
                    <option value="!=">!=</option>
                    <option value=">">></option>
                    <option value="<"><</option>
                    <option value="LIKE">LIKE</option>
                </select>
            </div>
            <div class="flex-1">
                <label class="block text-xs font-medium text-gray-500 mb-1">Value</label>
                <input type="text" class="w-full rounded border border-gray-300 px-2 py-1 text-sm filter-value" placeholder="Enter value">
            </div>
            <div>
                <button type="button" class="bg-red-100 hover:bg-red-200 text-red-600 px-2 py-1 rounded text-sm remove-filter">
                    ×
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="{{ asset('ui/frontend/assets/js/queryBuilder.js') }}"></script>
    @endpush
</x-frontend.layouts.master>