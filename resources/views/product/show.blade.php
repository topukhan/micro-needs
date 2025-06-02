<x-frontend.layouts.master>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-800">Product Details</h2>
    </div>
    
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>
                <dl class="mt-2 space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Name</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $product->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Price</dt>
                        <dd class="mt-1 text-sm text-gray-900">${{ number_format($product->price, 2) }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Quantity</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $product->quantity }}</dd>
                    </div>
                </dl>
            </div>
            
            <div>
                <h3 class="text-lg font-medium text-gray-900">Description</h3>
                <div class="mt-2 text-sm text-gray-900">
                    @if($product->description)
                        {{ $product->description }}
                    @else
                        <span class="text-gray-400">No description provided</span>
                    @endif
                </div>
                <h5 class="text-lg font-bold text-gray-900 mt-4">Barcode</h5>
                <div class="mt-2 text-sm text-gray-900">
                    <img src="data:image/png;base64,{{ $barcodeImage }}">
                </div>
            </div>
        </div>
        
        <div class="mt-6 flex space-x-3">
            <a href="{{ route('products.edit', $product->id) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Edit Product
            </a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Are you sure?')">
                    Delete Product
                </button>
            </form>
            <a href="{{ route('products.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Back to List
            </a>
        </div>
    </div>
</div>
</x-frontend.layouts.master>