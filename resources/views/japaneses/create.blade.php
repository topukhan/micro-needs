<x-frontend.layouts.master>
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Translate Japanese Word</h1>

        <form method="POST" action="{{ route('japaneses.store') }}" class="space-y-4">
            @csrf

            <!-- Japanese Input -->
            <div>
                <label for="japanese" class="block text-sm font-medium text-gray-700">Japanese</label>
                <input type="text" name="japanese" id="japanese" value="{{ old('japanese') }}"
                    class="mt-1 p-2 w-full border rounded-md">
                <x-input-error :messages="$errors->get('japanese')" class="mt-2" />

            </div>

            <!-- Meaning Input -->
            <div>
                <label for="meaning" class="block text-sm font-medium text-gray-700">Meaning</label>
                <input type="text" name="meaning" id="meaning" value="{{ old('meaning') }}"
                    class="mt-1 p-2 w-full border rounded-md">
                <x-input-error :messages="$errors->get('meaning')" class="mt-2" />

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
    </div>
</x-frontend.layouts.master>
