<x-frontend.layouts.master>
    <a href="{{ route('japaneses.create')}}">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Japanese Word
        </button> 
    </a>
    <div class="container mx-auto mt-6">
        <div class="bg-white p-6 rounded-md shadow-md">
            <h1 class="text-2xl font-bold mb-4">Edit Word: {{ $japanese['japanese'] }}</h1>
    
            <form method="POST" action="{{ route('japaneses.update', $japanese['id']) }}" class="space-y-4">
                @csrf
                @method('PATCH')
    
                <!-- Japanese Input -->
                <div>
                    <label for="japanese" class="block text-sm font-medium text-gray-700">Japanese</label>
                    <input type="text" name="japanese" id="japanese" value="{{ $japanese['japanese'] }}" class="mt-1 p-2 w-full border rounded-md">
                </div>
    
                <!-- Meaning Input -->
                <div>
                    <label for="meaning" class="block text-sm font-medium text-gray-700">Meaning</label>
                    <input type="text" name="meaning" id="meaning" value="{{ $japanese['meaning'] }}" class="mt-1 p-2 w-full border rounded-md">
                </div>
    
                <!-- Note Textarea -->
                <div>
                    <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
                    <textarea name="note" id="note" class="mt-1 p-2 w-full border rounded-md">{{ $japanese['note'] }}</textarea>
                </div>
    
                <!-- Submit Button -->
                <div>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Update Word</button>
                </div>
            </form>
    
            <div class="mt-4 flex justify-between items-center">
                <a href="{{ route('japaneses.show', $japanese['id']) }}" class="text-blue-500 hover:underline">
                    <i class="fas fa-info-circle"></i> View Details
                </a>
    
                <a href="{{ route('japaneses.index') }}" class="text-blue-500 hover:underline">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</x-frontend.layouts.master>
