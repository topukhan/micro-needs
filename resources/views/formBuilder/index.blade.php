<x-frontend.layouts.master>
    <div class="container mx-auto mt-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form Builder -->
            <div class="bg-white shadow-xl p-6 rounded">
                <h1 class="text-lg font-bold mb-4">Form Builder</h1>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label for="field_type" class="block text-sm font-medium text-gray-700">Field Type</label>
                        <select id="field_type" class="w-full border-gray-300 rounded mt-1">
                            <option value="text">Text</option>
                            <option value="number">Number</option>
                            <option value="email">Email</option>
                            <option value="password">Password</option>
                            <option value="textarea">Textarea</option>
                            <option value="checkbox">Checkbox</option>
                            <option value="radio">Radio</option>
                            <option value="select">Select</option>
                            <option value="date">Date</option>
                            <option value="file">File</option>
                            <option value="button">Button</option>
                        </select>
                    </div>
                    <div>
                        <label for="field_name" class="block text-sm font-medium text-gray-700">Field Name</label>
                        <input type="text" id="field_name" class="w-full border-gray-300 rounded mt-1"
                            placeholder="e.g., username">
                    </div>
                    <div>
                        <label for="field_label" class="block text-sm font-medium text-gray-700">Field Label</label>
                        <input type="text" id="field_label" class="w-full border-gray-300 rounded mt-1"
                            placeholder="e.g., Enter your name">
                    </div>
                </div>

                <div id="options_container" class="mt-4 hidden">
                    <label for="field_options" class="block text-sm font-medium text-gray-700">Options
                        (comma-separated)</label>
                    <input type="text" id="field_options" class="w-full border-gray-300 rounded mt-1"
                        placeholder="e.g., Option 1, Option 2">
                </div>

                <div class="flex items-center gap-4 mt-4">
                    <button id="add_field" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Add
                        Field</button>
                </div>
            </div>

            <!-- Field List -->
            <div class="bg-white p-4 rounded shadow-xl mt-4">
                <p class="font-bold">Field List</p>
                <div id="field_list"></div>
            </div>

            <!-- Preview Form -->
            <div class="bg-white p-4 rounded shadow-xl mt-4">
                <p class="font-bold">Preview Form</p>
                <form id="preview_form">
                    <!-- Dynamic form fields will be appended here -->
                </form>
            </div>
        </div>

        <!-- Generated HTML -->
        <div class="bg-gray-100 p-4 rounded shadow mt-4">
            <h2 class="text-lg font-bold">Generated Form HTML</h2>
            <pre id="generated_html" class="bg-white p-4 rounded border mt-2 overflow-x-auto"></pre>
            <pre><code class="html" id="codeSnippet"></code></pre>

            <button id="copy_html" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded mt-4">Copy
                HTML</button>
        </div>
    </div>

    {{-- @push('script-links')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.14.7/beautify-html.min.js"></script>
    @endpush --}}
    @push('scripts')
        <script src="{{ asset('ui/frontend/assets/js/formBuilderTailwind.js') }}"></script>
    @endpush
</x-frontend.layouts.master>
