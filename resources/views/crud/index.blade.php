<x-frontend.layouts.master>
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Vocabulary List</h1>
                <p class="text-gray-600 mt-1">Manage your Japanese vocabulary collection</p>
            </div>
            <a href="{{ route('crud.create')}}" 
               class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-medium rounded-lg hover:from-blue-700 hover:to-indigo-800 transition-all transform hover:scale-105 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add New Word
            </a>
        </div>

        <!-- Word Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($words as $word)
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <!-- Word Header -->
                        <div class="flex items-start justify-between">
                            <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $word->japanese_word }}</h3>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $loop->iteration }}  
                            </span>
                        </div>
                        
                        <!-- Meanings -->
                        <div class="mt-3 space-y-2">
                            @if($word->english_meaning)
                            <div class="flex items-start">
                                <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-indigo-100 text-indigo-800 text-xs font-medium mr-2">EN</span>
                                <p class="text-gray-600">{{ $word->english_meaning }}</p>
                            </div>
                            @endif
                            
                            @if($word->bangla_meaning)
                            <div class="flex items-start">
                                <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-teal-100 text-teal-800 text-xs font-medium mr-2">BN</span>
                                <p class="text-gray-600">{{ $word->bangla_meaning }}</p>
                            </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-6 pt-4 border-t border-gray-100 flex justify-between">
                            <a href="{{ route('crud.show', $word->id) }}" 
                               class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                </svg>
                                Details
                            </a>

                            <a href="{{ route('crud.edit', $word->id) }}" 
                               class="inline-flex items-center text-sm font-medium text-amber-600 hover:text-amber-800 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                Edit
                            </a>

                            <form method="POST" action="{{ route('crud.destroy', $word->id) }}" 
                                  onsubmit="return confirm('Are you sure you want to delete this word?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center text-sm font-medium text-red-600 hover:text-red-800 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Footer with creation date -->
                    <div class="px-6 py-3 bg-gray-50 text-xs text-gray-500">
                        Created {{ $word->created_at->diffForHumans() }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination (if applicable) -->
        @if($words->hasPages())
        <div class="mt-8">
            {{ $words->links() }}
        </div>
        @endif
    </div>
</x-frontend.layouts.master>