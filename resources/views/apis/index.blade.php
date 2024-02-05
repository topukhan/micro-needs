<x-frontend.layouts.master>
    <div class="mx-auto p-5 bg-sky-600 w-2/3 rounded-lg text-white" id="weather">
        {{-- search city --}}
        <div class="w-full ">
            <form id="weatherApiForm">
                <input id="cityNameInput" class="border p-2 focus:border-green-600 focus:ring-green-500 text-black"
                    type="text" placeholder="Enter city Name" spellcheck="false">
                <button class="bg-green-500 rounded py-2 px-3 text-white mt-2" type="submit">Search</button>
            </form>
            <span id="responseMessage" class="py-3 px-2 text-sm"></span>
            {{-- Weather --}}
            <div class="text-center py-3">
                <img class="mx-auto" src="//cdn.weatherapi.com/weather/64x64/day/116.png" alt="weather icon"
                    id="weatherIcon">
                <span class="text-4xl font-bold" id="temperature">0</span><span class="text-3xl">°C</span>
                <h2 class="text-lg" id="cityName"></h2>
            </div>

            {{-- Details --}}
            <div class="flex justify-around mt-8 py-3">
                <div class="flex items-center">
                    <img class="mr-2" src="{{ asset('ui/frontend/assets/images/humidity.png') }}" alt="humidity icon">

                    <div>
                        <span class="text-lg font-bold" id="humidity">0</span><span>%</span>
                        <p>Humidity</p>
                    </div>
                </div>

                <div class="flex items-center">
                    <i class="fa-solid fa-wind px-2 text-3xl"></i>
                    <div>
                        <span class="text-lg font-bold" id="windSpeed">0</span><span> KMPH</span>
                        <p>Wind Speed</p>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
            
            <script src="{{ asset('ui/frontend/assets/js/weatherApi.js') }}"></script>
        @endpush

</x-frontend.layouts.master>
