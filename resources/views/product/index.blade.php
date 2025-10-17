<x-frontend.layouts.master>
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between">
            <h2 class="text-2xl font-semibold text-gray-800">
                Product List <a class="text-blue-600" href="https://cloud.typesense.org/" target="_blank">(Typesense
                    Implemented)</a>
                <span id="fromCache"
                    class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-semibold font-mono bg-green-100 text-green-800">
                    {{ $fromCache ? 'From Cache' : 'By Query' }}
                </span>

                <span id="searchSource"
                    class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-semibold font-mono bg-teal-100 text-teal-800">
                    @if ($searchSource == 'typesense')
                        {{ 'Typesense' }}
                    @elseif ($searchSource == 'database')
                        {{ 'Database' }}
                    @else
                        {{ 'Cache' }}
                    @endif
                </span>
                <span id="queryTime"
                    class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-semibold font-mono bg-green-100 text-green-800">
                    {{ $queryTimeMs ? '0ms' : $queryTimeMs . 'ms' }}
                </span>
            </h2>

            <div class="flex gap-2">
                <a href="{{ route('support.clear-cache') }}"
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                    Clear Cache
                </a>
                <a href="{{ route('products.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                        </path>
                    </svg>
                    Create
                </a>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <form id="searchForm" class="flex flex-col sm:flex-row gap-4">
                @csrf
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                            placeholder="Search products by name, category, brand..."
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="flex gap-2">
                    <select name="category" id="categorySelect"
                        class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Categories</option>
                        <option value="smartphones" {{ request('category') == 'smartphones' ? 'selected' : '' }}>
                            Smartphones</option>
                        <option value="laptops" {{ request('category') == 'laptops' ? 'selected' : '' }}>Laptops
                        </option>
                        <option value="fragrances" {{ request('category') == 'fragrances' ? 'selected' : '' }}>
                            Fragrances</option>
                        <option value="skincare" {{ request('category') == 'skincare' ? 'selected' : '' }}>Skincare
                        </option>
                        <option value="groceries" {{ request('category') == 'groceries' ? 'selected' : '' }}>Groceries
                        </option>
                        <option value="home-decoration"
                            {{ request('category') == 'home-decoration' ? 'selected' : '' }}>
                            Home Decoration</option>
                    </select>

                    <select name="sort" id="sortSelect"
                        class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Sort By</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name A-Z
                        </option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name Z-A
                        </option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price Low-High
                        </option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price
                            High-Low</option>
                        <option value="created_desc" {{ request('sort') == 'created_desc' ? 'selected' : '' }}>Newest
                            First</option>
                        <option value="created_asc" {{ request('sort') == 'created_asc' ? 'selected' : '' }}>Oldest
                            First</option>
                    </select>

                    <button type="button" id="clearFilters"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                        style="display: none;">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Clear
                    </button>
                </div>
            </form>

            <!-- Search Results Summary -->
            <div id="searchSummary" class="mt-3 text-sm text-gray-600" style="display: none;"></div>

            <!-- Loading Indicator -->
            <div id="loadingIndicator" class="mt-3 text-sm text-blue-600" style="display: none;">
                <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-blue-600 inline" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                Searching...
            </div>
        </div>

        <!-- Products Table Container -->
        <div id="productsContainer">
            @include('product.partials.product-list', ['products' => $products])
        </div>

        <!-- Pagination Container -->
        <div id="paginationContainer">
            @if ($products->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>

</x-frontend.layouts.master>
<script>
    $(document).ready(function() {
        let searchTimeout;
        const searchInput = $('#searchInput');
        const categorySelect = $('#categorySelect');
        const sortSelect = $('#sortSelect');
        const clearButton = $('#clearFilters');
        const searchSummary = $('#searchSummary');
        const loadingIndicator = $('#loadingIndicator');
        const productsContainer = $('#productsContainer');
        const paginationContainer = $('#paginationContainer');

        // Debounced search function
        function debounceSearch() {
            clearTimeout(searchTimeout);
            loadingIndicator.show();
            searchTimeout = setTimeout(function() {
                performSearch();
            }, 50);
        }

        // Immediate search for filters
        function performSearch() {
            const params = new URLSearchParams();
            if (searchInput.val()) params.append('search', searchInput.val());
            if (categorySelect.val()) params.append('category', categorySelect.val());
            if (sortSelect.val()) params.append('sort', sortSelect.val());

            $.ajax({
                url: `{{ route('products.index') }}?${params.toString()}`,
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.success) {
                        productsContainer.html(data.html);
                        paginationContainer.html(data.pagination);
                        $('#fromCache').text(data.from_cache ? 'From Cache' : 'By Query');
                        $('#queryTime').text(data.query_time_ms + 'ms');
                        if (data.search_source == 'typesense') {
                            $('#searchSource').text('Typesense');
                        } else if (data.search_source == 'database') {
                            $('#searchSource').text('Database');
                        } else {
                            $('#searchSource').text('Cache');
                        }

                        // Update search summary
                        if (data.search_summary) {
                            searchSummary.html(data.search_summary).show();
                        } else {
                            searchSummary.hide();
                        }

                        // Show/hide clear button
                        updateClearButton();

                        // Update URL without page reload
                        updateURL();

                        // Re-attach delete confirmation listeners
                        attachDeleteListeners();
                    }
                },
                error: function(error) {
                    console.error('Search error:', error);
                    // Show error message
                    const errorDiv = $(
                        '<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4"><p>An error occurred while searching. Please try again.</p></div>'
                        );
                    productsContainer.prepend(errorDiv);
                    setTimeout(() => errorDiv.remove(), 5000);
                },
                complete: function() {
                    loadingIndicator.hide();
                }
            });
        }

        // Update URL parameters
        function updateURL() {
            const params = new URLSearchParams();
            if (searchInput.val()) params.set('search', searchInput.val());
            if (categorySelect.val()) params.set('category', categorySelect.val());
            if (sortSelect.val()) params.set('sort', sortSelect.val());

            const newURL = params.toString() ?
                `${window.location.pathname}?${params.toString()}` :
                window.location.pathname;

            window.history.pushState({}, '', newURL);
        }

        // Update clear button visibility
        function updateClearButton() {
            const hasFilters = searchInput.val() || categorySelect.val() || sortSelect.val();
            clearButton.css('display', hasFilters ? 'block' : 'none');
        }

        // Attach delete confirmation listeners
        function attachDeleteListeners() {
            $('.delete-product').on('click', function(e) {
                if (!confirm('Are you sure you want to delete this product?')) {
                    e.preventDefault();
                }
            });
        }

        // Event listeners
        searchInput.on('input', debounceSearch);
        categorySelect.on('change', performSearch);
        sortSelect.on('change', performSearch);

        // Clear filters
        clearButton.on('click', function() {
            searchInput.val('');
            categorySelect.val('');
            sortSelect.val('');
            performSearch();
        });

        // Handle pagination clicks
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            const url = new URL($(this).attr('href'));
            const page = url.searchParams.get('page');

            if (page) {
                const params = new URLSearchParams();
                if (searchInput.val()) params.append('search', searchInput.val());
                if (categorySelect.val()) params.append('category', categorySelect.val());
                if (sortSelect.val()) params.append('sort', sortSelect.val());
                params.append('page', page);

                loadingIndicator.show();

                $.ajax({
                    url: `{{ route('products.index') }}?${params.toString()}`,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            productsContainer.html(data.html);
                            paginationContainer.html(data.pagination);

                            // Update URL
                            window.history.pushState({}, '',
                                `${window.location.pathname}?${params.toString()}`);

                            // Scroll to top of products
                            $('html, body').animate({
                                scrollTop: productsContainer.offset().top
                            }, 'smooth');

                            // Re-attach delete listeners
                            attachDeleteListeners();
                        }
                    },
                    complete: function() {
                        loadingIndicator.hide();
                    }
                });
            }
        });

        // Initial state
        updateClearButton();
        attachDeleteListeners();

        // Show search summary if filters are applied
        if (searchInput.val() || categorySelect.val() || sortSelect.val()) {
            searchSummary.show();
        }
    });
</script>
