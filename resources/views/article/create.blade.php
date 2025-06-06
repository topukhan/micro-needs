<x-frontend.layouts.master>
    <div class="max-w-4xl mx-auto mt-10 p-8 bg-white rounded-xl shadow-lg border border-gray-100">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Create New Article</h1>
            <a href="{{ route('articles.index') }}"
                class="flex items-center space-x-2 text-sky-600 hover:text-sky-800 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                <span>Back to Articles</span>
            </a>
        </div>

        <form id="article-form" method="POST" action="{{ route('articles.store') }}" class="space-y-6"
            enctype="multipart/form-data">
            @csrf

            <!-- Title Input -->
            <div class="space-y-2">
                <label for="title" class="block text-sm font-medium text-gray-700">Article Title</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="pl-10 mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-200 focus:ring-opacity-50 transition duration-200 p-3 border"
                        required>
                </div>
                <x-input-error :messages="$errors->get('title')" class="mt-1" />
            </div>

            <!-- Featured Image -->
            <div class="space-y-2">
                <label for="featured_image" class="block text-sm font-medium text-gray-700">Featured Image</label>
                <div class="mt-1 flex items-center">
                    <input type="file" name="featured_image" id="featured_image"
                        class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-sky-50 file:text-sky-700
                        hover:file:bg-sky-100">
                </div>
                <x-input-error :messages="$errors->get('featured_image')" class="mt-1" />
            </div>

            <!-- Content with AI Generation -->
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <label for="content" class="block text-sm font-medium text-gray-700">Article Content</label>
                    <button type="button" id="generateContent"
                        class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-purple-500 to-indigo-600 hover:from-purple-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
                        </svg>
                        Generate with AI
                    </button>
                </div>
                <textarea rows="12" name="content" id="content"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition duration-200 p-3 border prose max-w-none">{{ old('content') }}</textarea>
                <x-input-error :messages="$errors->get('content')" class="mt-1" />
            </div>

            <!-- Meta Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-200 focus:ring-opacity-50 transition duration-200 p-3 border">
                    <x-input-error :messages="$errors->get('meta_title')" class="mt-1" />
                </div>

                <div class="space-y-2">
                    <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta
                        Description</label>
                    <textarea rows="3" name="meta_description" id="meta_description"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-200 focus:ring-opacity-50 transition duration-200 p-3 border">{{ old('meta_description') }}</textarea>
                    <x-input-error :messages="$errors->get('meta_description')" class="mt-1" />
                </div>
            </div>

            <!-- Publish Status -->
            <div class="flex items-center space-x-4">
                <div class="flex items-center">
                    <input id="is_published" name="is_published" type="checkbox"
                        class="h-4 w-4 text-sky-600 focus:ring-sky-500 border-gray-300 rounded"
                        {{ old('is_published') ? 'checked' : '' }}>
                    <label for="is_published" class="ml-2 block text-sm text-gray-700">Publish Immediately</label>
                </div>

                <div class="space-y-2" id="publishDateContainer"
                    style="{{ old('is_published') ? '' : 'display: none;' }}">
                    <label for="published_at" class="block text-sm font-medium text-gray-700">Publish Date</label>
                    <input type="datetime-local" name="published_at" id="published_at"
                        value="{{ old('published_at') ?? now()->format('Y-m-d\TH:i') }}"
                        class="mt-1 block rounded-lg border-gray-300 shadow-sm focus:border-sky-500 focus:ring focus:ring-sky-200 focus:ring-opacity-50 transition duration-200 p-2 border">
                </div>
            </div>

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
                    Create Article
                </button>
            </div>
        </form>

        @push('scripts')
            <script>
                // In your blade file, replace the form submission with:
                // Replace your form submission with this:
                document.getElementById('article-form').addEventListener('submit', function(e) {
                    e.preventDefault();

                    ajaxCall({
                        url: this.action,
                        data: new FormData(this),
                        button: document.querySelector('button[type="submit"]'),
                        onSuccess: function(response) {
                            // Redirect or reset form
                            if (response.redirect) {
                                window.location.href = response.redirect;
                            } else {
                                document.querySelector('form').reset();
                            }
                        }
                    });
                });
                // Toggle publish date visibility
                document.getElementById('is_published').addEventListener('change', function() {
                    document.getElementById('publishDateContainer').style.display =
                        this.checked ? 'block' : 'none';
                });

                // Gemini AI Content Generation - Fixed to match working Japanese version
                document.getElementById('generateContent').addEventListener('click', async function() {
                    const title = document.getElementById('title').value;

                    if (!title) {
                        alert('Please enter a title first');
                        return;
                    }

                    const button = document.getElementById('generateContent');
                    const originalText = button.innerHTML;
                    button.innerHTML = `
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Generating...
                    `;
                    button.disabled = true;

                    try {
                        // Use the same API structure as the working Japanese form
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
                                            text: `Write a comprehensive, SEO-friendly blog article about "${title}" with the following structure:

# ${title}

## Introduction
[Write 1 engaging paragraphs introducing the topic]

## Main Content
[Write 2-3 well-structured sections with relevant subheadings covering the topic comprehensively]

## Key Points
[Include important bullet points or numbered lists where relevant]

## Conclusion
[Write 1 paragraphs summarizing the key takeaways]

Use markdown formatting for headings, lists, and emphasis. Make it informative, engaging, and around 300-600 words. Focus on providing value to readers and include actionable insights where possible.`
                                        }]
                                    }]
                                })
                            });

                        if (!response.ok) {
                            throw new Error('API request failed');
                        }

                        const data = await response.json();

                        // Extract the generated text using the same structure as Japanese form
                        const generatedText = data.candidates[0].content.parts[0].text;
                        document.getElementById('content').value = generatedText;

                        // Auto-fill meta title if empty
                        const metaTitleField = document.getElementById('meta_title');
                        if (!metaTitleField.value) {
                            metaTitleField.value = title;
                        }

                        // Auto-fill meta description if empty
                        const metaDescField = document.getElementById('meta_description');
                        if (!metaDescField.value) {
                            // Extract first few lines as meta description
                            const lines = generatedText.split('\n').filter(line => line.trim() && !line.startsWith(
                                '#'));
                            if (lines.length > 0) {
                                const description = lines[0].substring(0, 150) + '...';
                                metaDescField.value = description;
                            }
                        }

                    } catch (error) {
                        console.error('Error generating content:', error);
                        alert('Failed to generate content. Please try again later.');
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
