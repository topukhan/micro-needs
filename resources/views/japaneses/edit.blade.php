<x-frontend.layouts.master>
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Edit CRUD Word</h1>

        <form method="POST" action="{{ route('crud.update', $japanese->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Japanese Input -->
            <div>
                <label for="japanese_word" class="block text-sm font-medium text-gray-700">Japanese</label>
                <input type="text" name="japanese_word" id="japanese_word" value="{{ old('japanese_word', $japanese->japanese_word) }}"
                    class="mt-1 p-2 w-full border rounded-md">
                <x-input-error :messages="$errors->get('japanese_word')" class="mt-2" />
            </div>

            <!-- Language Selection Buttons -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Select Language</label>
                <div class="flex space-x-4">
                    <button type="button" onclick="toggleInput('bangla')" class="px-4 py-2 bg-gradient-to-r from-green-400 to-green-700 text-white rounded-md">Bangla</button>
                    <button type="button" onclick="toggleInput('english')" class="px-4 ml-3 py-2 bg-gradient-to-r from-orange-400 to-orange-700 text-white rounded-md">English</button>
                </div>
            </div>

            <!-- Bangla Meaning Input -->
            <div id="banglaInput" class="{{ old('bangla_meaning', $japanese->bangla_meaning) ? '' : 'hidden' }}">
                <label for="bangla_meaning" class="block text-sm font-medium text-gray-700">Meaning in Bangla</label>
                <input type="text" name="bangla_meaning" id="bangla_meaning" value="{{ old('bangla_meaning', $japanese->bangla_meaning) }}"
                    class="mt-1 p-2 w-full border border-green-700 rounded-md focus:border-green-500 focus:ring-green-500">
                <x-input-error :messages="$errors->get('bangla_meaning')" class="mt-2" />
            </div>

            <!-- English Meaning Input -->
            <div id="englishInput" class="{{ old('english_meaning', $japanese->english_meaning) ? '' : 'hidden' }}">
                <label for="english_meaning" class="block text-sm font-medium text-gray-700">Meaning in English</label>
                <input type="text" name="english_meaning" id="english_meaning" value="{{ old('english_meaning', $japanese->english_meaning) }}"
                    class="mt-1 p-2 w-full border border-orange-700 rounded-md focus:border-orange-500 focus:ring-orange-500">
                <x-input-error :messages="$errors->get('english_meaning')" class="mt-2" />
            </div>

            <!-- Example Input -->
            <div>
                <label for="example" class="block text-sm font-medium text-gray-700">Example</label>
                <input type="text" name="example" id="example" value="{{ old('example', $japanese->example) }}"
                    class="mt-1 p-2 w-full border rounded-md">
                <x-input-error :messages="$errors->get('example')" class="mt-2" />
            </div>

            <!-- Note Textarea -->
            <div>
                <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
                <textarea name="note" id="note" class="mt-1 p-2 w-full border rounded-md">{{ old('note', $japanese->note) }}</textarea>
                <x-input-error :messages="$errors->get('note')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div>
                <!-- Back to List Link -->
                
                <button type="submit" class="px-4 py-2 mx-2 bg-gradient-to-l from-sky-600 to-sky-900 shadow-2xl text-white rounded-full">Update Entry</button>
            </div>
            <div class="mt-4 flex justify-between items-center px-3">
                <a href="{{ route('crud.show', $japanese['id']) }}" class="text-blue-500 hover:underline">
                    <i class="fas fa-info-circle"></i> View Details
                </a>
    
                <a href="{{ route('crud.index') }}" class="text-blue-500 hover:underline">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>

        </form>

        <script>
            function toggleInput(language) {
                var inputField = document.getElementById(language + 'Input');
                inputField.classList.toggle('hidden');
            }
        </script>
    </div>
</x-frontend.layouts.master>
