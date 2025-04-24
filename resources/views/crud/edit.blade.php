<x-frontend.layouts.master>
    <div class="max-w-2xl mx-auto mt-8 p-8 bg-white rounded-xl shadow-lg border border-gray-100">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Edit Vocabulary</h1>
                <p class="text-gray-600 mt-1">Update the details for "{{ $japanese->japanese_word }}"</p>
            </div>
            <a href="{{ route('crud.index') }}" class="flex items-center space-x-2 text-blue-600 hover:text-blue-800 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span>Back to List</span>
            </a>
        </div>

        <form method="POST" action="{{ route('crud.update', $japanese->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Japanese Input -->
            <div class="space-y-2">
                <label for="japanese_word" class="block text-sm font-medium text-gray-700">Japanese Word</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" name="japanese_word" id="japanese_word" 
                           value="{{ old('japanese_word', $japanese->japanese_word) }}"
                           class="pl-10 mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-200 p-3 border">
                </div>
                <x-input-error :messages="$errors->get('japanese_word')" class="mt-1" />
            </div>

            <!-- Language Selection Buttons -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Translation Language</label>
                <div class="flex space-x-3">
                    <button type="button" onclick="toggleInput('bangla')" 
                            class="flex-1 flex items-center justify-center px-4 py-3 rounded-lg bg-gradient-to-r from-teal-500 to-green-600 text-white font-medium hover:from-teal-600 hover:to-green-700 transition-all shadow-md hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z" clip-rule="evenodd" />
                        </svg>
                        Bangla
                    </button>
                    <button type="button" onclick="toggleInput('english')" 
                            class="flex-1 flex items-center justify-center px-4 py-3 rounded-lg bg-gradient-to-r from-amber-500 to-orange-600 text-white font-medium hover:from-amber-600 hover:to-orange-700 transition-all shadow-md hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                        </svg>
                        English
                    </button>
                </div>
            </div>

            <!-- Bangla Meaning Input -->
            <div id="banglaInput" class="{{ old('bangla_meaning', $japanese->bangla_meaning) ? '' : 'hidden' }} space-y-2">
                <label for="bangla_meaning" class="block text-sm font-medium text-gray-700">Bangla Meaning</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                        </svg>
                    </div>
                    <input type="text" name="bangla_meaning" id="bangla_meaning" 
                           value="{{ old('bangla_meaning', $japanese->bangla_meaning) }}"
                           class="pl-10 mt-1 block w-full rounded-lg border-teal-300 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 transition duration-200 p-3 border">
                </div>
                <x-input-error :messages="$errors->get('bangla_meaning')" class="mt-1" />
            </div>

            <!-- English Meaning Input -->
            <div id="englishInput" class="{{ old('english_meaning', $japanese->english_meaning) ? '' : 'hidden' }} space-y-2">
                <label for="english_meaning" class="block text-sm font-medium text-gray-700">English Meaning</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                        </svg>
                    </div>
                    <input type="text" name="english_meaning" id="english_meaning" 
                           value="{{ old('english_meaning', $japanese->english_meaning) }}"
                           class="pl-10 mt-1 block w-full rounded-lg border-amber-300 shadow-sm focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50 transition duration-200 p-3 border">
                </div>
                <x-input-error :messages="$errors->get('english_meaning')" class="mt-1" />
            </div>

            <!-- Example Input -->
            <div class="space-y-2">
                <label for="note" class="block text-sm font-medium text-gray-700">Example </label>
                <div class="relative">
                    <div class="absolute top-3 left-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </div>
                    <textarea name="example" id="example" rows="8"
                              class="pl-10 mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50 transition duration-200 p-3 border">{{ old('example', $japanese->example) }}</textarea>
                </div>
                <x-input-error :messages="$errors->get('note')" class="mt-1" />
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between pt-6">
                <div class="flex space-x-4">
                    <a href="{{ route('crud.show', $japanese->id) }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                        </svg>
                        View Details
                    </a>
                    <a href="{{ route('crud.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Back to List
                    </a>
                </div>
                <button type="submit" 
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-indigo-600 to-blue-700 hover:from-indigo-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Update Entry
                </button>
            </div>
        </form>
    </div>

    <script>
        function toggleInput(language) {
            const inputField = document.getElementById(language + 'Input');
            const otherLanguage = language === 'bangla' ? 'english' : 'bangla';
            const otherField = document.getElementById(otherLanguage + 'Input');
            
            inputField.classList.toggle('hidden');
            
            // Optional: Close the other language field when one is opened
            if (!otherField.classList.contains('hidden')) {
                otherField.classList.add('hidden');
            }
        }
    </script>
</x-frontend.layouts.master>