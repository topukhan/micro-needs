<x-frontend.layouts.master>
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Translate Japanese Word</h1>

        <form method="POST" action="{{ route('japaneses.store') }}" class="space-y-4">
            @csrf

            <!-- Japanese Input -->
            <div>
                <label for="japanese_word" class="block text-sm font-medium text-gray-700">Japanese</label>
                <input type="text" name="japanese_word" id="japanese_word" value="{{ old('japanese_word') }}"
                    class="mt-1 p-2 w-full border rounded-md">
                <x-input-error :messages="$errors->get('japanese_word')" class="mt-2" />

            </div>

            <!-- Language Selection Buttons -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Select Language</label>
                <div class="flex space-x-4">
                    <button type="button" onclick="toggleInput('bangla')" class="px-4 py-2 bg-blue-500 text-white rounded-md">Bangla</button>
                    <button type="button" onclick="toggleInput('english')" class="px-4 ml-3 py-2 bg-blue-500 text-white rounded-md">English</button>
                </div>
            </div>

            <!-- Bangla Meaning Input -->
            <div id="banglaInput" class="hidden">
                <label for="bangla_meaning" class="block text-sm font-medium text-gray-700">Meaning in Bangla</label>
                <input type="text" name="bangla_meaning" id="bangla_meaning" value="{{ old('bangla_meaning') }}"
                    class="mt-1 p-2 w-full border rounded-md">
                <x-input-error :messages="$errors->get('bangla_meaning')" class="mt-2" />
            </div>

            <!-- English Meaning Input -->
            <div id="englishInput" class="hidden">
                <label for="english_meaning" class="block text-sm font-medium text-gray-700">Meaning in English</label>
                <input type="text" name="english_meaning" id="english_meaning" value="{{ old('english_meaning') }}"
                    class="mt-1 p-2 w-full border rounded-md">
                <x-input-error :messages="$errors->get('english_meaning')" class="mt-2" />
            </div>

            <!-- Example Input -->
            <div>
                <label for="example" class="block text-sm font-medium text-gray-700">Example</label>
                <input type="text" name="example" id="example" value="{{ old('example') }}"
                    class="mt-1 p-2 w-full border rounded-md">
                <x-input-error :messages="$errors->get('example')" class="mt-2" />
            </div>

            <!-- Note Textarea -->
            <div>
                <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
                <textarea name="note" id="note" class="mt-1 p-2 w-full border rounded-md">{{ old('note') }}</textarea>
                <x-input-error :messages="$errors->get('note')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Create Entry</button>
            </div>
        </form>

        <script>
            function toggleInput(language) {
                var inputField = document.getElementById(language + 'Input');
                inputField.style.display = (inputField.style.display === 'none' || inputField.style.display === '') ? 'block' : 'none';
            }
        </script>
    </div>
</x-frontend.layouts.master>
