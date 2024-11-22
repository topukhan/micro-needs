<x-frontend.layouts.master>
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h1 class="text-xl font-bold mb-4">Rendered Form</h1>
        <form>
            @foreach($fields as $field)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ $field->field_label }}</label>
                    <input type="{{ $field->field_type }}" name="{{ $field->field_name }}" class="w-full border-gray-300 rounded mt-1">
                </div>
            @endforeach
        </form>
    </div>
</x-frontend.layouts.master>
