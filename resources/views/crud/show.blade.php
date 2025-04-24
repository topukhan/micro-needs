<x-frontend.layouts.master>
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <!-- Header Card -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 rounded-xl shadow-lg mb-8 text-white">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold">Vocabulary Details</h1>
                    <p class="opacity-90 mt-1">Viewing details for Japanese word</p>
                </div>
                <span class="bg-white/20 px-3 py-1 rounded-full text-sm font-medium">ID: {{ $japanese->id }}</span>
            </div>
        </div>

        <!-- Details Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <!-- Main Content -->
            <div class="p-6 space-y-6">
                <!-- Japanese Word -->
                <div class="space-y-1">
                    <h2 class="text-xs font-semibold uppercase tracking-wider text-blue-600">Japanese Word</h2>
                    <p class="text-2xl font-bold text-gray-800">{{ $japanese->japanese_word }}</p>
                </div>

                <!-- Meanings Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Bangla Meaning -->
                    @if ($japanese->bangla_meaning)
                        <div class="space-y-1">
                            <h2 class="text-xs font-semibold uppercase tracking-wider text-teal-600">Bangla Meaning</h2>
                            <p class="text-lg text-gray-700">{{ $japanese->bangla_meaning }}</p>
                        </div>
                    @endif

                    <!-- English Meaning -->
                    @if ($japanese->english_meaning)
                        <div class="space-y-1">
                            <h2 class="text-xs font-semibold uppercase tracking-wider text-indigo-600">English Meaning
                            </h2>
                            <p class="text-lg text-gray-700">{{ $japanese->english_meaning }}</p>
                        </div>
                    @endif
                </div>

                <!-- Example Sentence -->
                @if ($japanese->example)
                    <div class="space-y-1">
                        <h2 class="text-xs font-semibold uppercase tracking-wider text-purple-600">Example Sentence</h2>
                        <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-purple-500">
                            <p class="text-gray-700 whitespace-pre-line">{{ $japanese->example }}</p>
                        </div>
                    </div>
                @endif

                <!-- Note (Hidden by default) -->
                @if ($japanese->note)
                    <div class="space-y-1 hidden" id="noteSection">
                        <h2 class="text-xs font-semibold uppercase tracking-wider text-amber-600">Note</h2>
                        <div class="bg-amber-50 p-4 rounded-lg border-l-4 border-amber-500">
                            <p class="text-gray-700 whitespace-pre-line">{{ $japanese->note }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Footer with Actions -->
            <div
                class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0">
                <div>

                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('crud.edit', $japanese->id) }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit
                    </a>
                    <a href="{{ route('crud.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        Back to List
                    </a>
                </div>
            </div>
        </div>

        <!-- Metadata -->
        <div class="mt-4 text-sm text-gray-500 flex justify-between">
            <span>Created: {{ $japanese->created_at->format('M d, Y \a\t h:i A') }}</span>
            <span>Last Updated: {{ $japanese->updated_at->format('M d, Y \a\t h:i A') }}</span>
        </div>
    </div>

</x-frontend.layouts.master>
