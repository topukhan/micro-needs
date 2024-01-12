<x-frontend.layouts.master>
    
    <div class="container mx-auto mt-6">
        <div class="bg-white p-6 rounded-md shadow-md">
            <h1 class="text-2xl font-bold mb-4">{{ $japanese['japanese'] }}</h1>
            <p class="text-gray-600">{{ $japanese['meaning'] }}</p>
    
            <div class="mt-4 flex justify-between items-center">
                <a href="{{ route('japaneses.index') }}" class="text-blue-500 hover:underline">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</x-frontend.layouts.master>
