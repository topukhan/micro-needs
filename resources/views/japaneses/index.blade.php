<x-frontend.layouts.master>
    <a href="{{ route('japaneses.create')}}">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Japanese Word
        </button> 
    </a>
    <div class="container mx-auto mt-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
            @foreach($words as $word)
                <div class="bg-white p-6 rounded-md shadow-md">
                    <h3 class="text-xl font-bold mb-2">{{ $word['japanese'] }}</h3>
                    <p class="text-gray-600">{{ $word['meaning'] }}</p>
    
                    <div class="mt-4 flex justify-between items-center">
                        <a href="{{ route('japaneses.show', $word['id']) }}" class="text-blue-500 hover:underline">
                            <i class="fas fa-info-circle"></i> Detail
                        </a>
    
                        <a href="{{ route('japaneses.edit', $word['id']) }}" class="text-yellow-500 hover:underline">
                            <i class="fas fa-edit"></i> Edit
                        </a>
    
                        <form method="POST" action="{{ route('japaneses.destroy', $word['id']) }}" onsubmit="return confirm('Are you sure you want to delete this word?')">
                            @csrf
                            @method('DELETE')
    
                            <button type="submit" class="text-red-500 hover:underline">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-frontend.layouts.master>
