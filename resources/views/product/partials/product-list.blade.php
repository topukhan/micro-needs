<div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
    @forelse ($products as $product)
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-100">
            <!-- Product Image -->
            <div class="relative">
                <img 
                    src="{{ $product->thumbnail ?? 'https://placehold.co/400x300' }}"
                    alt="{{ $product->name }}"
                    class="w-full h-36 object-cover rounded-t-lg"
                    loading="lazy"
                >
                <!-- Stock Badge -->
                <div class="absolute top-3 right-3">
                    <span class="px-2 py-1 text-xs font-medium rounded-full 
                        {{ $product->quantity > 10 ? 'bg-green-100 text-green-800 border border-green-200' : 
                           ($product->quantity > 0 ? 'bg-yellow-100 text-yellow-800 border border-yellow-200' : 'bg-red-100 text-red-800 border border-red-200') }}">
                        {{ $product->quantity }} in stock
                    </span>
                </div>
            </div>

            <!-- Product Content -->
            <div class="p-3">
                <!-- Category & Brand -->
                <div class="flex items-center justify-between mb-2">
                    @if ($product->category)
                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                            {{ ucfirst(str_replace('-', ' ', $product->category)) }}
                        </span>
                    @endif
                    @if ($product->brand)
                        <span class="text-xs text-gray-500">{{ $product->brand }}</span>
                    @endif
                </div>

                <!-- Product Name -->
                <h3 class="text-base font-semibold text-gray-900 mb-1 line-clamp-2">
                    {{ $product->name }}
                </h3>

                <!-- Description -->
                @if ($product->description)
                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                        {{ Str::limit($product->description, 80) }}
                    </p>
                @endif

                <!-- Rating -->
                @if ($product->rating && $product->rating > 0)
                    <div class="flex items-center mb-3">
                        <div class="flex text-yellow-400">
                            ★
                        </div>
                        <span class="ml-1 text-sm text-gray-700">{{ number_format($product->rating, 1) }}</span>
                    </div>
                @endif

                <!-- Price and Actions -->
                <div class="flex items-center justify-between mt-3">
                    <div class="text-lg font-bold text-green-600">
                        ${{ number_format($product->price, 2) }}
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex space-x-2">
                        <!-- View -->
                        <a href="{{ route('products.show', $product->id) }}"
                           class="p-2 text-blue-600 hover:bg-blue-50 rounded-full transition-colors duration-150"
                           title="View Product">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </a>
                        
                        <!-- Edit -->
                        <a href="{{ route('products.edit', $product->id) }}"
                           class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-full transition-colors duration-150"
                           title="Edit Product">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                        </a>
                        
                        <!-- Delete -->
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="p-2 text-red-600 hover:bg-red-50 rounded-full transition-colors duration-150 delete-product"
                                title="Delete Product">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <!-- Empty State -->
        <div class="col-span-full">
            <div class="text-center py-12">
                <div class="text-gray-500">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                        </path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No products found</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        @if (request()->hasAny(['search', 'category', 'sort']))
                            Try adjusting your search criteria or
                            <button onclick="document.getElementById('clearFilters').click()" 
                                class="text-blue-600 hover:text-blue-500 underline">
                                clear filters
                            </button>
                        @else
                            Get started by creating a new product.
                        @endif
                    </p>
                    @unless(request()->hasAny(['search', 'category', 'sort']))
                        <div class="mt-6">
                            <a href="{{ route('products.create') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Add Product
                            </a>
                        </div>
                    @endunless
                </div>
            </div>
        </div>
    @endforelse
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
