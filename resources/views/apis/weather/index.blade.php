<x-frontend.layouts.master>
    <div class="w-full rounded-lg">
        {{-- search city --}}
        <div class="flex space-x-10">
            {{-- weather api.com  --}}
            <div class="md:w-1/2 w-full py-4 bg-sky-600 text-white mx-auto p-5 rounded-lg">
                <h2 class="py-2">Weather API</h2>
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

                <div class="flex justify-around mt-8 py-3">
                    <div class="flex items-center">
                        <img class="mr-2" src="{{ asset('ui/frontend/assets/images/sky.png') }}" alt="Sky icon">

                        <div>
                            <span class="text-lg font-bold" id="skyCondition">clear</span>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <img class="mr-2" src="{{ asset('ui/frontend/assets/images/clock.png') }}" alt="clock icon">

                        <div>
                            <span class="text-lg font-bold" id="localTime">0</span>
                            <p>Time</p>
                        </div>
                    </div>
                </div>
                {{-- Details --}}
                <div class="flex justify-around mt-8 py-3">
                    <div class="flex items-center">
                        <img class="mr-2" src="{{ asset('ui/frontend/assets/images/humidity.png') }}"
                            alt="humidity icon">

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



            {{-- Weather map api --}}
            <div class="md:w-1/2 w-full py-4 bg-purple-600 text-white mx-auto p-5 rounded-lg">
                <h2 class="py-2">Weather Map API</h2>
                <form id="weatherMapApiForm">
                    <input id="cityNameMapInput"
                        class="border p-2 focus:border-green-600 focus:ring-green-500 text-black" type="text"
                        placeholder="Enter city Name" spellcheck="false">
                    <button class="bg-green-500 rounded py-2 px-3 text-white mt-2" type="submit">Search</button>
                </form>
                <span id="responseMessageMap" class="py-3 px-2 text-sm"></span>
                {{-- Weather --}}
                <div class="text-center py-3">
                    <img class="mx-auto" src="https://openweathermap.org/img/wn/02d@2x.png" alt="weather icon"
                        id="weatherIconMap">
                    <span class="text-4xl font-bold" id="temperatureMap">0</span><span class="text-3xl">°C</span>
                    <h2 class="text-lg" id="cityNameMap"></h2>
                </div>

                {{-- Details --}}
                <div class="flex justify-around mt-8 py-3">
                    <div class="flex items-center">
                        <img class="mr-2" src="{{ asset('ui/frontend/assets/images/humidity.png') }}"
                            alt="humidity icon">

                        <div>
                            <span class="text-lg font-bold" id="humidityMap">0</span><span>%</span>
                            <p>Humidity</p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <i class="fa-solid fa-wind px-2 text-3xl"></i>
                        <div>
                            <span class="text-lg font-bold" id="windSpeedMap">0</span><span> KMPH</span>
                            <p>Wind Speed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
            <script src="{{ asset('ui/frontend/assets/js/weatherApi.js') }}"></script>
            <script src="{{ asset('ui/frontend/assets/js/weatherMap.js') }}" data-route="{{ route('api.weathermap') }}"></script>
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    // city search form submission
                    document
                        .getElementById("weatherMapApiForm")
                        .addEventListener("submit", (event) => {
                            event.preventDefault();
                            cityName = document.getElementById("cityNameMapInput").value;
                            apiUrl = `https://api.weatherapi.com/v1/current.json?q=${cityName}`;

                            const data = {
                                city: cityName,
                                url: apiUrl,
                            };
                            axios.post('{{ route('api.weathermap') }}', data)
                                .then((response) => {
                                    // Handle successful response

                                    // if city found
                                    if (response.data.cod == 200) {
                                        console.time("city found");
                                        console.log("city name: ", response.data.name);

                                        document.getElementById(
                                            "temperatureMap"
                                        ).innerHTML = Math.round(
                                            response.data.main.temp - 273.15
                                        );
                                        document.getElementById("cityNameMap").innerHTML =
                                            response.data.name;
                                        document.getElementById("humidityMap").innerHTML =
                                            response.data.main.humidity;
                                        document.getElementById("windSpeedMap").innerHTML =
                                            response.data.wind.speed * 3.6;

                                        let iconCode = response.data.weather[0].icon;
                                        let iconUrl = `https://openweathermap.org/img/wn/${iconCode}@2x.png`;
                                        document
                                            .getElementById("weatherIconMap")
                                            .setAttribute("src", iconUrl);

                                        console.timeEnd("city found");
                                    }
                                    // if city not found
                                    if (response.data.cod == 404) {
                                        console.log("in 404: ", response.data.cod);
                                        document.getElementById(
                                            "responseMessageMap"
                                        ).innerHTML = response.data.message;
                                        setTimeout(() => {
                                            document.getElementById(
                                                "responseMessageMap"
                                            ).innerHTML = "";
                                        }, 5000);
                                    }
                                })
                                .catch((error) => {
                                    // Handle error
                                    console.error("Error:", error);
                                });
                        })
                });
            </script>
        @endpush

</x-frontend.layouts.master>
