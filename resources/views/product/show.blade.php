<x-frontend.layouts.master>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-800">Product Details</h2>
    </div>
    
    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Product Images -->
            <div class="lg:col-span-1">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Product Images</h3>
                
                @if($product->thumbnail)
                    <div class="mb-4">
                        <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}" class="w-full h-64 object-cover rounded-lg shadow-md">
                        <p class="text-xs text-gray-500 mt-1">Main Image</p>
                    </div>
                @endif
                
                @if($product->images && count(json_decode($product->images, true)) > 0)
                    <div class="grid grid-cols-2 gap-2">
                        @foreach(json_decode($product->images, true) as $index => $image)
                            <img src="{{ $image }}" alt="{{ $product->name }} - Image {{ $index + 1 }}" class="w-full h-24 object-cover rounded-md shadow-sm">
                        @endforeach
                    </div>
                @elseif(!$product->thumbnail)
                    <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                        <span class="text-gray-400">No images available</span>
                    </div>
                @endif
            </div>
            
            <!-- Product Information -->
            <div class="lg:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Name</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ $product->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Price</dt>
                                <dd class="mt-1 text-lg font-bold text-green-600">{{ number_format($product->price, 2) }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Quantity in Stock</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $product->quantity > 10 ? 'bg-green-100 text-green-800' : ($product->quantity > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $product->quantity }} units
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Barcode</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-mono">{{ $product->barcode ?? 'Not set' }}</dd>
                            </div>
                        </dl>
                    </div>
                    
                    <!-- Additional Details -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Details</h3>
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Category</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if($product->category)
                                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">{{ ucfirst($product->category) }}</span>
                                    @else
                                        <span class="text-gray-400">Not specified</span>
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Brand</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $product->brand ?? 'Not specified' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Rating</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if($product->rating && $product->rating > 0)
                                        <div class="flex items-center">
                                            <span class="text-yellow-400 text-lg">★</span>
                                            <span class="ml-1 font-medium">{{ number_format($product->rating, 1) }}</span>
                                            <span class="text-gray-500 ml-1">/ 5.0</span>
                                        </div>
                                    @else
                                        <span class="text-gray-400">Not rated</span>
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Availability Status</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if($product->availabilityStatus)
                                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $product->availabilityStatus === 'In Stock' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $product->availabilityStatus }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">Not specified</span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
                
                <!-- Description -->
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                    <div class="text-sm text-gray-700 bg-gray-50 p-4 rounded-lg">
                        @if($product->description)
                            {{ $product->description }}
                        @else
                            <span class="text-gray-400 italic">No description provided</span>
                        @endif
                    </div>
                </div>
                
                <!-- Tags -->
                @if($product->tags && count(json_decode($product->tags, true)) > 0)
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach(json_decode($product->tags, true) as $tag)
                            <span class="px-3 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-full">
                                {{ ucfirst($tag) }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Warranty Information -->
                @if($product->warrantyInformation)
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Warranty Information</h3>
                    <div class="text-sm text-gray-700 bg-blue-50 p-4 rounded-lg border-l-4 border-blue-400">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $product->warrantyInformation }}
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Barcode Image -->
                @if(isset($barcodeImage))
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Barcode</h3>
                    <div class="bg-white p-4 rounded-lg border border-gray-200 inline-block">
                        <img src="data:image/png;base64,{{ $barcodeImage }}" alt="Product Barcode" class="max-w-full h-auto">
                    </div>
                </div>
                @endif
                
                <!-- Timestamps -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Record Information</h3>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        <div>
                            <dt class="font-medium text-gray-500">Created</dt>
                            <dd class="mt-1 text-gray-900">{{ $product->created_at->format('M d, Y \a\t g:i A') }}</dd>
                        </div>
                        <div>
                            <dt class="font-medium text-gray-500">Last Updated</dt>
                            <dd class="mt-1 text-gray-900">{{ $product->updated_at->format('M d, Y \a\t g:i A') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="mt-8 pt-6 border-t border-gray-200 flex flex-wrap gap-3">
            <a href="{{ route('products.edit', $product->id) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Product
            </a>
            
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200" onclick="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Delete Product
                </button>
            </form>
            
            <a href="{{ route('products.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to List
            </a>
        </div>
    </div>
</div>

</x-frontend.layouts.master>