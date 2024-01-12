<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hashing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Hash ENC/DEC') }}
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <form action="{{ route('hash.decrypt')}}" method="POST">
                                @csrf
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-password">
                                    Decrypt
                                </label>
                                <input type="text" name="decrypt" id="">
                                <button type="submit" class="bg-blue-600 rounded py-2 px-3 text-white">submit</button>
                            </form>
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 my-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-password">
                                    Result:<span class="bg-gray-300 p-1 rounded">ljlakjei</span>
                                </label>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</x-app-layout>
