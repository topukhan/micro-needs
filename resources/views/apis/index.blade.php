<x-frontend.layouts.master>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('3rd Party API\'s') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">Different API's</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 text-center">
                    <!--Weather API  -->
                    <a href="{{ route('api.weather.index') }}" class="bg-blue-600 rounded py-2 px-3 text-white">
                        Weather API
                    </a>
                    <!-- News API -->
                    <a href="{{ route('api.news.index') }}" class="bg-green-500 rounded py-2 px-3 text-white">
                        News API
                    </a>

                    <!-- Add more buttons for additional features -->

                </div>
            </div>
        </div>
    </div>


</x-frontend.layouts.master>
