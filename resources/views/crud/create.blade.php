<x-frontend.layouts.master>
    <div class="max-w-2xl mx-auto mt-10 p-8 bg-white rounded-xl shadow-lg border border-gray-100">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Create New Vocabulary</h1>
            <a href="{{ route('crud.index') }}"
                class="flex items-center space-x-2 text-sky-600 hover:text-sky-800 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                <span>Back to List</span>
            </a>
        </div>

        <form method="POST" action="{{ route('crud.store') }}" class="space-y-6">
            @csrf

            <!-- Japanese Input -->
            <div class="space-y-2">
                <label for="japanese_word" class="block text-sm font-medium text-gray-700">Japanese Word</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" name="japanese_word" id="japanese_word" value="{{ old('japanese_word') }}"
                        class="pl-10 mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-200 focus:ring-opacity-50 transition duration-200 p-3 border">
                </div>
                <x-input-error :messages="$errors->get('japanese_word')" class="mt-1" />
            </div>

            <!-- Language Selection Buttons -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Translation Language</label>
                <div class="flex space-x-3">
                    <button type="button" onclick="toggleInput('bangla')"
                        class="flex-1 flex items-center justify-center px-4 py-3 rounded-lg bg-gradient-to-r from-teal-500 to-cyan-600 text-white font-medium hover:from-teal-600 hover:to-cyan-700 transition-all shadow-md hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20" height="20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"/>
                            <text x="10" y="14" font-family="Noto Sans Bengali, Arial Unicode MS" font-size="8" text-anchor="middle" fill="currentColor">ব</text>
                          </svg>
                        Bangla
                    </button>
                    <button type="button" onclick="toggleInput('english')"
                        class="flex-1 flex items-center justify-center px-4 py-3 rounded-lg bg-gradient-to-r from-indigo-500 to-blue-600 text-white font-medium hover:from-indigo-600 hover:to-blue-700 transition-all shadow-md hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
                                clip-rule="evenodd" />
                        </svg>
                        English
                    </button>
                </div>
            </div>

            <!-- Bangla Meaning Input -->
            <div id="banglaInput" class=" space-y-2">
                <label for="bangla_meaning" class="block text-sm font-medium text-gray-700">Bangla Meaning</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                        </svg>
                    </div>
                    <input type="text" name="bangla_meaning" id="bangla_meaning" value="{{ old('bangla_meaning') }}"
                        class="language-input pl-10 mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50 transition duration-200 p-3 border" required>
                </div>
                <x-input-error :messages="$errors->get('bangla_meaning')" class="mt-1" />
            </div>

            <!-- English Meaning Input -->
            <div id="englishInput" class="hidden space-y-2">
                <label for="english_meaning" class="block text-sm font-medium text-gray-700">English Meaning</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                        </svg>
                    </div>
                    <input type="text" name="english_meaning" id="english_meaning"
                        value="{{ old('english_meaning') }}"
                        class="language-input pl-10 mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-200 p-3 border">
                </div>
                <x-input-error :messages="$errors->get('english_meaning')" class="mt-1" />
            </div>

            <!-- Example Input -->
            <div class="space-y-2">
                <div class="flex gap-2 items-center">
                    <label for="example" class="block text-sm font-medium text-gray-700">Example Sentence</label>
                    <button id="generateExample" type="button"
                        class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-teal-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400 transition ease-in-out duration-150">
                        Generate
                    </button>
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <textarea rows="8" type="text" name="example" id="example" value="{{ old('example') }}"
                        class="pl-10 mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-200 p-3 border"></textarea>
                </div>
                <x-input-error :messages="$errors->get('example')" class="mt-1" />
            </div>

            <!-- Note Textarea -->
            {{-- <div class="space-y-2">
                <label for="note" class="block text-sm font-medium text-gray-700">Notes</label>
                <div class="relative">
                    <div class="absolute top-3 left-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </div>
                    <textarea name="note" id="note" rows="4"
                        class="pl-10 mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50 transition duration-200 p-3 border">{{ old('note') }}</textarea>
                </div>
                <x-input-error :messages="$errors->get('note')" class="mt-1" />
            </div> --}}

            <!-- Submit Button -->
            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-gradient-to-r from-cyan-600 to-blue-700 hover:from-cyan-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-all transform hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Create Entry
                </button>
            </div>
        </form>

        @push('scripts')
            <script>
                function toggleInput(language) {
                    const inputField = document.getElementById(language + 'Input');
                    const otherLanguage = language === 'bangla' ? 'english' : 'bangla';
                    const otherField = document.getElementById(otherLanguage + 'Input');

                    inputField.classList.toggle('hidden');
                    otherField.classList.add('hidden');

                    if (!inputField.classList.contains('hidden')) {
                        inputField.getElementsByTagName('input')[0].required = true;
                        otherField.getElementsByTagName('input')[0].required = false;
                    } else {
                        inputField.getElementsByTagName('input')[0].required = false;
                        otherField.getElementsByTagName('input')[0].required = true;
                    }
                }
            </script>
            <script>
                document.getElementById('generateExample').addEventListener('click', async function() {
                    const japaneseWord = document.getElementById('japanese_word').value;

                    if (!japaneseWord) {
                        alert('Please enter a word first');
                        return;
                    }

                    let language = '';
                    if (!document.getElementById('banglaInput').classList.contains('hidden')) {
                        language = 'bangla';
                    } else if (!document.getElementById('englishInput').classList.contains('hidden')) {
                        language = 'english';
                    } else {
                        alert('Please select a translation language first');
                        return;
                    }

                    const button = document.getElementById('generateExample');
                    const originalText = button.innerHTML;
                    button.innerHTML = 'Generating...';
                    button.disabled = true;

                    try {
                        // Use the correct Gemini API endpoint and API key
                        const apiKey = "{{ env('GEMINI_API_KEY') }}";

                        const response = await fetch(
                            `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    contents: [{
                                        parts: [{
                                            text: `For Japanese word "${japaneseWord}":
                                                1. Japanese word: [Japanese version of "${japaneseWord}"]
                                                2. Meaning: [${language} meaning , (use capitalize first letter, use ${language} word obviously)]
                                                3. Example: [Japanese sentence with at least 5 words]
                                                4. Romanization: [Romanized pronunciation]
                                                5. Translation: [${language} translation]

                                                Return in exactly this format. No explanations or additional text.`
                                        }]
                                    }]
                                })
                            });

                        if (!response.ok) {
                            throw new Error('API request failed');
                        }

                        const data = await response.json();

                        // Extract the generated text from the response structure
                        const generatedText = data.candidates[0].content.parts[0].text;
                        document.getElementById('example').value = generatedText;

                    } catch (error) {
                        console.error('Error generating example:', error);
                        alert('Failed to generate example sentence. Please try again later.');
                    } finally {
                        // Restore button state
                        button.innerHTML = originalText;
                        button.disabled = false;
                    }
                });
            </script>
        @endpush
    </div>
</x-frontend.layouts.master>
