<x-frontend.layouts.master>
    <a href="{{ route('japaneses.create') }}">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Japanese Word
        </button>
    </a>
    <div class="container mx-auto mt-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">

            {{-- <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow"> --}}
            <h1 class="text-xl font-bold mb-4">Form Builder</h1>

            <!-- Form for Adding Fields -->
            <form id="add-field-form">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Field Type</label>
                    <select id="field_type" class="w-full border-gray-300 rounded mt-1">
                        <option value="text">Text</option>
                        <option value="number">Number</option>
                        <option value="email">Email</option>
                        <option value="date">Date</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Field Name</label>
                    <input id="field_name" type="text" class="w-full border-gray-300 rounded mt-1"
                        placeholder="e.g., username">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Field Label</label>
                    <input id="field_label" type="text" class="w-full border-gray-300 rounded mt-1"
                        placeholder="e.g., Enter your name">
                </div>

                <button type="button" id="add-field" class="bg-blue-500 text-white px-4 py-2 rounded">Add
                    Field</button>
            </form>

            <!-- Display Selected Fields -->
            <h2 class="text-lg font-bold mt-6">Selected Fields</h2>
            <ul id="field-list" class="list-disc list-inside mt-2"></ul>

            <!-- Preview and Copy Form -->
            <div class="mt-6">
                <button type="button" id="preview-form" class="bg-green-500 text-white px-4 py-2 rounded">Preview
                    Form</button>
            </div>

            <!-- Preview Area -->
            <div id="form-preview" class="hidden mt-6 bg-gray-50 p-4 rounded border"></div>

            <!-- Copy HTML Modal -->
            <div id="copy-modal" class="hidden mt-6 bg-gray-50 p-4 rounded border">
                <h3 class="text-lg font-bold">Generated Form HTML</h3>
                <textarea id="form-html" class="w-full h-40 border-gray-300 rounded mt-2"></textarea>
                <button type="button" id="copy-html" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Copy
                    HTML</button>
            </div>
            {{-- </div> --}}
        </div>
    </div>
    @push('scripts')
    <script>
        const fields = [];

        // Add Field to List
        $(document).on('click', '#add-field', function () {
            const field = {
                field_type: $('#field_type').val(),
                field_name: $('#field_name').val(),
                field_label: $('#field_label').val()
            };

            fields.push(field);

            // Append to Field List
            $('#field-list').append(`<li>${field.field_label} (${field.field_type})</li>`);

            // Clear Inputs
            $('#add-field-form')[0].reset();
        });

        // Preview Form
        $(document).on('click', '#preview-form', function () {
            $.ajax({
                url: "{{ route('form.builder.preview') }}",
                type: "POST",
                data: {
                    fields: fields,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    // Show Form Preview
                    $('#form-preview').html(response.html).removeClass('hidden');

                    // Populate Modal with HTML
                    $('#form-html').val(response.html);
                    $('#copy-modal').removeClass('hidden');
                },
                error: function () {
                    alert('Error generating preview.');
                }
            });
        });

        // Copy HTML to Clipboard
        $(document).on('click', '#copy-html', function () {
            $('#form-html').select();
            document.execCommand('copy');
            alert('Form HTML copied to clipboard!');
        });
    </script>
    @endpush
</x-frontend.layouts.master>
