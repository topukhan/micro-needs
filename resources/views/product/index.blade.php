<x-frontend.layouts.master>
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between">
            <h2 class="text-2xl font-semibold text-gray-800">
                Product List <a class="text-blue-600" href="https://cloud.typesense.org/" target="_blank">(Typesense Implemented)</a>
                <span id="fromCache" class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-semibold font-mono bg-green-100 text-green-800">
                    {{ $fromCache ? 'From Cache' : 'By Query' }}
                </span>
                <span id="searchSource" class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-semibold font-mono bg-teal-100 text-teal-800">
                    {{ $searchSource === 'typesense' ? 'Typesense' : ($searchSource === 'database' ? 'Database' : 'Cache') }}
                </span>
                <span id="queryTime" class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-semibold font-mono bg-green-100 text-green-800">
                    {{ $queryTimeMs }}ms
                </span>
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('support.clear-cache') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Clear Cache
                </a>
                <a href="{{ route('products.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create
                </a>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <form id="searchForm" class="flex flex-col sm:flex-row gap-4">
                @csrf
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="Search products by name, category, (Ctrl + K to focus)..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex gap-2">
                    <select name="category" id="categorySelect" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Categories</option>
                        @foreach(['smartphones', 'laptops', 'fragrances', 'skincare', 'groceries', 'home-decoration'] as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ ucfirst(str_replace('-', ' ', $cat)) }}</option>
                        @endforeach
                    </select>
                    <select name="sort" id="sortSelect" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Sort By</option>
                        @foreach(['name_asc' => 'Name A-Z', 'name_desc' => 'Name Z-A', 'price_asc' => 'Price Low-High', 'price_desc' => 'Price High-Low', 'created_desc' => 'Newest First', 'created_asc' => 'Oldest First'] as $val => $label)
                            <option value="{{ $val }}" {{ request('sort') == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <button type="button" id="clearFilters" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" style="display:none">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Clear
                    </button>
                </div>
            </form>
            <div id="searchSummary" class="mt-3 text-sm text-gray-600" style="display:none"></div>
            <div id="loadingIndicator" class="mt-3 text-sm text-blue-600" style="display:none">
                <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-blue-600 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Searching...
            </div>
        </div>

        <!-- Products Container -->
        <div id="productsContainer" class="px-2 py-3">
            @include('product.partials.product-list', ['products' => $products])
        </div>

        <!-- Infinite Scroll Indicator -->
        <div id="infiniteScrollIndicator" class="text-center py-4" style="display:none">
            <svg class="animate-spin h-8 w-8 text-blue-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </div>
</x-frontend.layouts.master>

<script>
$(document).ready(function() {
    const $el = {
        searchInput: $('#searchInput'),
        categorySelect: $('#categorySelect'),
        sortSelect: $('#sortSelect'),
        clearButton: $('#clearFilters'),
        searchSummary: $('#searchSummary'),
        loadingIndicator: $('#loadingIndicator'),
        productsContainer: $('#productsContainer'),
        infiniteScrollIndicator: $('#infiniteScrollIndicator')
    };

    let state = {
        searchTimeout: null,
        nextPageUrl: '{{ $products->nextPageUrl() }}',
        isLoading: false,
        hasMorePages: {{ $products->hasMorePages() ? 'true' : 'false' }},
        currentPage: {{ $products->currentPage() }},
        lastScrollTop: 0,
        scrollTimeout: null
    };

    // Utility functions
    const utils = {
        getParams: () => {
            const params = new URLSearchParams();
            const search = $el.searchInput.val().trim();
            const category = $el.categorySelect.val();
            const sort = $el.sortSelect.val();
            if (search) params.append('search', search);
            if (category) params.append('category', category);
            if (sort) params.append('sort', sort);
            return params;
        },
        
        updateURL: () => {
            const params = utils.getParams();
            params.delete('page');
            const newURL = params.toString() ? `${window.location.pathname}?${params}` : window.location.pathname;
            window.history.pushState({}, '', newURL);
        },
        
        updateBadges: (data) => {
            $('#fromCache').text(data.from_cache ? 'From Cache' : 'By Query');
            $('#queryTime').text(data.query_time_ms + 'ms');
            const sources = { typesense: 'Typesense', database: 'Database', cache: 'Cache' };
            $('#searchSource').text(sources[data.search_source] || 'Cache');
        },
        
        updateClearButton: () => {
            const hasFilters = $el.searchInput.val() || $el.categorySelect.val() || $el.sortSelect.val();
            $el.clearButton[hasFilters ? 'show' : 'hide']();
        },
        
        attachDeleteListeners: () => {
            $('.delete-product').off('click').on('click', function(e) {
                if (!confirm('Are you sure you want to delete this product?')) e.preventDefault();
            });
        },
        
        showError: (msg = 'An error occurred. Please try again.') => {
            const $error = $('<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4"><p>' + msg + '</p></div>');
            $el.productsContainer.prepend($error);
            setTimeout(() => $error.remove(), 5000);
        }
    };

    // Search functionality
    const search = {
        debounce: () => {
            clearTimeout(state.searchTimeout);
            $el.loadingIndicator.show();
            state.searchTimeout = setTimeout(() => search.perform(true), 300);
        },
        
        perform: (isNewSearch = false) => {
            if (isNewSearch) {
                state.currentPage = 1;
                state.hasMorePages = true;
                state.nextPageUrl = null;
            }
            
            state.isLoading = true;
            
            $.ajax({
                url: `{{ route('products.index') }}?${utils.getParams()}`,
                method: 'GET',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: (data) => {
                    if (data.success) {
                        $el.productsContainer.html(data.html);
                        state.nextPageUrl = data.next_page_url;
                        state.hasMorePages = data.current_page < data.last_page;
                        state.currentPage = data.current_page;
                        
                        utils.updateBadges(data);
                        $el.searchSummary[data.search_summary ? 'html' : 'hide'](data.search_summary).toggle(!!data.search_summary);
                        utils.updateClearButton();
                        utils.updateURL();
                        utils.attachDeleteListeners();
                        
                        if (!state.hasMorePages) $el.infiniteScrollIndicator.hide();
                    }
                },
                error: () => utils.showError(),
                complete: () => {
                    $el.loadingIndicator.hide();
                    state.isLoading = false;
                }
            });
        }
    };

    // Infinite scroll
    const infiniteScroll = {
        load: () => {
            if (state.isLoading || !state.hasMorePages || !state.nextPageUrl) return;
            
            state.isLoading = true;
            $el.infiniteScrollIndicator.show();
            
            const url = new URL(state.nextPageUrl, window.location.origin);
            utils.getParams().forEach((value, key) => url.searchParams.set(key, value));
            
            $.ajax({
                url: url.toString(),
                method: 'GET',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: (data) => {
                    if (data.success) {
                        const $tempDiv = $('<div>').html(data.html);
                        const $grid = $el.productsContainer.find('.grid');
                        
                        if ($grid.length === 0) return console.error('Grid not found');
                        
                        const $newProducts = $tempDiv.find('.grid').length > 0 
                            ? $tempDiv.find('.grid').children('.bg-white')
                            : $tempDiv.find('.bg-white.rounded-lg.shadow-md');
                        
                        if ($newProducts.length > 0) {
                            $grid.append($newProducts);
                            state.nextPageUrl = data.next_page_url;
                            state.hasMorePages = data.current_page < data.last_page;
                            state.currentPage = data.current_page;
                            utils.attachDeleteListeners();
                        } else {
                            state.hasMorePages = false;
                        }
                        
                        if (!state.hasMorePages) $el.infiniteScrollIndicator.hide();
                    }
                },
                error: () => {
                    state.hasMorePages = false;
                    $el.infiniteScrollIndicator.hide();
                },
                complete: () => {
                    state.isLoading = false;
                    $el.infiniteScrollIndicator.hide();
                }
            });
        },
        
        handleScroll: () => {
            const currentScrollTop = $(window).scrollTop();
            if (currentScrollTop <= state.lastScrollTop) {
                state.lastScrollTop = currentScrollTop;
                return;
            }
            state.lastScrollTop = currentScrollTop;
            
            clearTimeout(state.scrollTimeout);
            state.scrollTimeout = setTimeout(() => {
                const scrollPosition = $(window).scrollTop() + $(window).height();
                const documentHeight = $(document).height();
                if (scrollPosition >= documentHeight - 300) infiniteScroll.load();
            }, 150);
        }
    };

    // Event bindings
    $el.searchInput.on('input', search.debounce);
    $el.categorySelect.on('change', () => search.perform(true));
    $el.sortSelect.on('change', () => search.perform(true));
    $el.clearButton.on('click', () => {
        $el.searchInput.val('');
        $el.categorySelect.val('');
        $el.sortSelect.val('');
        search.perform(true);
    });
    
    $(window).on('scroll', infiniteScroll.handleScroll);
    $(document).on('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            $el.searchInput.focus().select();
        }
    });

    // Initialize
    utils.updateClearButton();
    utils.attachDeleteListeners();
    
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('search') || urlParams.has('category') || urlParams.has('sort')) {
        const filterCount = ['search', 'category', 'sort'].filter(k => urlParams.has(k)).length;
        $el.searchSummary.html(`${filterCount} filter(s) active`).show();
    }
});
</script>