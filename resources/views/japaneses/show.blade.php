<x-frontend.layouts.master>
    <div class="container mx-auto mt-8 mb-10">
        <div class="bg-gradient-to-r from-blue-800 to-blue-300 p-8 rounded-lg shadow-2xl text-white">
            <h1 class="text-3xl font-bold mb-4">Japanese Translation Details</h1>

            <!-- Japanese Word -->
            <div class="mb-3">
                <label for="japanese_word" class="font-semibold">Japanese:</label>
                <span
                    class="font-bold text-lg bg-gradient-to-r from-sky-100 to-sky-200 text-black py-1 px-4 rounded-2xl">{{ $japanese->japanese_word }}</span>
            </div>

            <!-- Bangla Meaning -->
            <div class="mb-3">
                <label for="meaning" class="font-semibold">Bangla Meaning:</label>
                <span
                    class="font-bold text-lg bg-gradient-to-r from-sky-100 to-sky-200 text-black py-1 px-4 rounded-2xl">{{ $japanese->bangla_meaning }}</span>
            </div>

            <!-- English Meaning -->
            <div class="mb-3">
                <label for="english_meaning" class="font-semibold">English Meaning:</label>
                <span
                    class="font-bold text-lg bg-gradient-to-r from-sky-100 to-sky-200 text-black py-1 px-4 rounded-2xl">{{ $japanese->english_meaning }}</span>
            </div>

            <!-- Example -->
            <div class="mb-3">
                <label for="example" class="font-semibold">Example:</label>
                <span
                    class=" text-lg bg-gradient-to-r from-sky-100 to-sky-200 text-black py-1 px-4 rounded-2xl">{{ $japanese->example }}</span>
            </div>

            <!-- Note -->
            <div class="mb-3">
                <label for="note" class="font-semibold">Note:</label>
                <span
                    class=" text-lg bg-gradient-to-r from-sky-100 to-sky-200 text-black py-1 px-4 rounded-2xl">{{ $japanese->note }}</span>
            </div>


            <!-- Back to List Link -->
            <div class="mt-4 flex justify-center">
                <a href="{{ route('crud.index') }}"
                    class="bg-gradient-to-r from-sky-100 to-sky-500 text-gray-800 py-2 px-4 rounded-full">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</x-frontend.layouts.master>
