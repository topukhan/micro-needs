<x-frontend.layouts.master>
    <style>
        #searchResults {
            max-height: 300px;
            overflow-y: auto;
            z-index: 1000;
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .search-result {
            transition: background-color 0.2s;
        }

        .search-result:hover {
            background-color: #f9fafb;
        }
    </style>
    <div class="max-w-4xl mx-auto mt-10 p-8 bg-white rounded-xl shadow-lg border border-gray-100">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Address Search 
                <a href="https://github.com/topukhan/geokit" class=" text-blue-600 font-mono font-semibold text-2xl" target="_blank">(Used Geokit)</a>
            </h1>
            
        </div>

        <!-- Search Form -->
        <div class="space-y-6">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" id="addressSearch" placeholder="Search for an address..."
                    class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-200 p-3 border">
                <div id="searchResults"
                    class="absolute z-10 mt-1 w-full bg-white shadow-lg rounded-lg border border-gray-200 hidden"></div>
            </div>

            <!-- Cached Addresses Section -->
            <div id="cachedAddresses" class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-700">Cached Addresses</h2>
                <div id="addressCards" class="space-y-3">
                    <!-- Cached addresses will appear here -->
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                $(document).ready(function() {
                    let currentRequest = null;
                    let debounceTimer;
                    const searchDelay = 500; // 500ms debounce delay

                    // Search address with debounce
                    $('#addressSearch').on('input', function() {
                        clearTimeout(debounceTimer);
                        $('#searchResults').html('<div class="p-3 text-gray-500">Searching...</div>').removeClass(
                            'hidden');

                        const query = $(this).val().trim();
                        if (query.length < 3) {
                            $('#searchResults').empty().addClass('hidden');
                            return;
                        }

                        debounceTimer = setTimeout(() => {
                            if (currentRequest) {
                                currentRequest.abort();
                            }

                            currentRequest = $.ajax({
                                url: "{{ route('search-address.search') }}",
                                method: 'GET',
                                data: {
                                    search: query
                                },
                                beforeSend: function() {
                                    $('#searchResults').html(
                                        '<div class="p-3 text-gray-500">Loading...</div>');
                                },
                                success: function(response) {
                                    if (response.results.length > 0) {
                                        let html = '';
                                        response.results.forEach(result => {
                                            html += `
                                <div class="p-3 hover:bg-gray-50 cursor-pointer border-b border-gray-100 search-result" 
                                     data-formatted="${result.formatted}"
                                     data-lat="${result.lat}"
                                     data-lng="${result.lng}"
                                     data-components='${JSON.stringify(result.components)}'>
                                    <div class="font-medium">${result.formatted}</div>
                                    <div class="text-sm text-gray-500">${result.components.city ? result.components.city : result.components.district ? result.components.district : result.components.state || ''}, ${result.components.country || ''}</div>
                                </div>
                            `;
                                        });
                                        $('#searchResults').html(html).removeClass('hidden');
                                    } else {
                                        $('#searchResults').html(
                                            '<div class="p-3 text-gray-500">No results found</div>'
                                        ).removeClass('hidden');
                                    }
                                },
                                complete: function() {
                                    currentRequest = null;
                                }
                            });
                        }, searchDelay);
                    });

                    // Hide suggestions when clicking outside
                    $(document).on('click', function(e) {
                        if (!$(e.target).closest('#addressSearch, #searchResults').length) {
                            $('#searchResults').addClass('hidden');
                        }
                    });

                    // Add address to list when clicked
                    $(document).on('click', '.search-result', function() {
                        const formatted = $(this).data('formatted');
                        const lat = $(this).data('lat');
                        const lng = $(this).data('lng');
                        const components = $(this).data('components');

                        addAddressCard({
                            formatted: formatted,
                            lat: lat,
                            lng: lng,
                            components: components
                        }, false);

                        $('#addressSearch').val('');
                        $('#searchResults').empty().addClass('hidden');
                    });

                    // Load cached addresses on page load
                    loadCachedAddresses();

                    function loadCachedAddresses() {
                        $.ajax({
                            url: "{{ route('search-address.get-cached') }}",
                            method: 'GET',
                            success: function(response) {
                                $('#addressCards').empty();
                                if (response.length > 0) {
                                    response.forEach(address => {
                                        addAddressCard(address, true);
                                    });
                                } else {
                                    $('#addressCards').html(
                                        '<p class="text-gray-500">No cached addresses yet.</p>');
                                }
                            }
                        });
                    }

                    function addAddressCard(address, isCached = false) {
                        const cardId = 'address-' + Math.random().toString(36).substr(2, 9);
                        const cacheButtonText = isCached ? 'Remove from Cache' : 'Add to Cache';
                        const cacheButtonClass = isCached ? 'bg-red-500 hover:bg-red-600' :
                            'bg-green-500 hover:bg-green-600';

                        const card = `
            <div id="${cardId}" class="p-4 border rounded-lg bg-gray-50 mb-3">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h3 class="font-medium">${address.formatted}</h3>
                        <div class="text-sm text-gray-600 mt-1">
                            <p>Lat: ${address.lat}, Lng: ${address.lng}</p>
                            <p>City: ${address.components.city || 'N/A'}</p>
                            <p>Country: ${address.components.country || 'N/A'}</p>
                        </div>
                    </div>
                    <button class="cache-btn px-3 py-1 rounded text-white ${cacheButtonClass} transition-colors ml-3"
                            data-address='${JSON.stringify(address)}'
                            data-cached="${isCached}">
                        ${cacheButtonText}
                    </button>
                </div>
            </div>
        `;

                        $('#addressCards').prepend(card);
                    }

                    // Handle cache button clicks
                    $(document).on('click', '.cache-btn', function() {
                        const address = $(this).data('address');
                        const isCached = $(this).data('cached');
                        const card = $(this).closest('div[id^="address-"]');
                        const url = isCached ? "{{ route('search-address.remove-from-cache') }}" :
                            "{{ route('search-address.add-to-cache') }}";

                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                address: address
                            },
                            success: function() {
                                if (isCached) {
                                    card.remove();
                                    if ($('#addressCards').children().length === 0) {
                                        $('#addressCards').html(
                                            '<p class="text-gray-500">No cached addresses yet.</p>');
                                    }
                                } else {
                                    $(card).find('.cache-btn')
                                        .text('Remove from Cache')
                                        .removeClass('bg-green-500 hover:bg-green-600')
                                        .addClass('bg-red-500 hover:bg-red-600')
                                        .data('cached', true);
                                }
                            }
                        });
                    });
                });
            </script>
        @endpush
    </div>
</x-frontend.layouts.master>
