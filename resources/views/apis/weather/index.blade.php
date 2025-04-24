<x-frontend.layouts.master>
    <div class="w-full rounded-lg">
        <div class="flex flex-col lg:flex-row space-y-6 lg:space-y-0 lg:space-x-6">
            <!-- WeatherAPI.com Card -->
            <div
                class="w-full lg:w-1/2 bg-gradient-to-br from-sky-600 to-blue-800 text-white p-6 rounded-2xl shadow-xl transform transition-all hover:scale-[1.01]">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">WeatherAPI.com</h2>
                    <div class="flex space-x-2">
                        <button id="refreshWeatherApi" class="p-2 rounded-full bg-white/10 hover:bg-white/20 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </button>
                        <button id="locationWeatherApi"
                            class="p-2 rounded-full bg-white/10 hover:bg-white/20 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <form id="weatherApiForm" class="mb-4">
                    <div class="relative">
                        <input id="cityNameInput"
                            class="w-full p-3 pr-12 rounded-lg text-gray-900 focus:ring-2 focus:ring-blue-300 focus:border-blue-300"
                            type="text" placeholder="Enter city name" spellcheck="false">
                        <button type="submit"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-green-500 hover:bg-green-600 text-white p-1 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>

                <div id="responseMessage" class="text-yellow-300 text-sm mb-4 min-h-6"></div>

                <!-- Current Weather -->
                <div class="flex flex-col items-center py-4">
                    <div class="flex items-center justify-center space-x-4">
                        <img class="w-20 h-20" src="//cdn.weatherapi.com/weather/64x64/day/116.png" alt="Weather icon"
                            id="weatherIcon">
                        <div>
                            <span class="text-5xl font-bold" id="temperature">0</span>
                            <span class="text-3xl">°C</span>
                        </div>
                    </div>
                    <h2 class="text-xl font-semibold mt-2" id="cityName"></h2>
                    <p class="text-blue-100" id="weatherDescription"></p>
                </div>

                <!-- Weather Details -->
                <div class="grid grid-cols-2 gap-4 mt-6">
                    <div class="bg-white/10 rounded-xl p-4 flex items-center">
                        <div class="bg-white/20 p-3 rounded-full mr-3">
                            <img class="w-6 h-6" src="{{ asset('ui/frontend/assets/images/humidity.png') }}"
                                alt="Humidity">
                        </div>
                        <div>
                            <span class="text-lg font-bold" id="humidity">0</span><span>%</span>
                            <p class="text-sm text-blue-100">Humidity</p>
                        </div>
                    </div>

                    <div class="bg-white/10 rounded-xl p-4 flex items-center">
                        <div class="bg-white/20 p-3 rounded-full mr-3">
                            <i class="fa-solid fa-wind text-white"></i>
                        </div>
                        <div>
                            <span class="text-lg font-bold" id="windSpeed">0</span><span> km/h</span>
                            <p class="text-sm text-blue-100">Wind</p>
                        </div>
                    </div>

                    <div class="bg-white/10 rounded-xl p-4 flex items-center">
                        <div class="bg-white/20 p-3 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-lg font-bold" id="localTime">0</span>
                            <p class="text-sm text-blue-100">Local Time</p>
                        </div>
                    </div>

                    <div class="bg-white/10 rounded-xl p-4 flex items-center">
                        <div class="bg-white/20 p-3 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-lg font-bold" id="cloudCover">0</span><span>%</span>
                            <p class="text-sm text-blue-100">Cloud Cover</p>
                        </div>
                    </div>
                </div>

                <!-- Forecast (New Feature) -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-3">3-Day Forecast</h3>
                    <div class="grid grid-cols-3 gap-2" id="forecastContainer">
                        <!-- Forecast items will be added here by JavaScript -->
                    </div>
                </div>
            </div>

            <!-- OpenWeatherMap Card -->
            <div
                class="w-full lg:w-1/2 bg-gradient-to-br from-purple-600 to-indigo-800 text-white p-6 rounded-2xl shadow-xl transform transition-all hover:scale-[1.01]">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">OpenWeatherMap</h2>
                    <div class="flex space-x-2">
                        <button id="refreshWeatherMap"
                            class="p-2 rounded-full bg-white/10 hover:bg-white/20 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </button>
                        <button id="locationWeatherMap"
                            class="p-2 rounded-full bg-white/10 hover:bg-white/20 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <form id="weatherMapApiForm" class="mb-4">
                    <div class="relative">
                        <input id="cityNameMapInput"
                            class="w-full p-3 pr-12 rounded-lg text-gray-900 focus:ring-2 focus:ring-purple-300 focus:border-purple-300"
                            type="text" placeholder="Enter city name" spellcheck="false">
                        <button type="submit"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-green-500 hover:bg-green-600 text-white p-1 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>

                <div id="responseMessageMap" class="text-yellow-300 text-sm mb-4 min-h-6"></div>

                <!-- Current Weather -->
                <div class="flex flex-col items-center py-4">
                    <div class="flex items-center justify-center space-x-4">
                        <img class="w-20 h-20" src="https://openweathermap.org/img/wn/02d@2x.png" alt="Weather icon"
                            id="weatherIconMap">
                        <div>
                            <span class="text-5xl font-bold" id="temperatureMap">0</span>
                            <span class="text-3xl">°C</span>
                        </div>
                    </div>
                    <h2 class="text-xl font-semibold mt-2" id="cityNameMap"></h2>
                    <p class="text-purple-100" id="weatherDescriptionMap"></p>
                </div>

                <!-- Weather Details -->
                <div class="grid grid-cols-2 gap-4 mt-6">
                    <div class="bg-white/10 rounded-xl p-4 flex items-center">
                        <div class="bg-white/20 p-3 rounded-full mr-3">
                            <img class="w-6 h-6" src="{{ asset('ui/frontend/assets/images/humidity.png') }}"
                                alt="Humidity">
                        </div>
                        <div>
                            <span class="text-lg font-bold" id="humidityMap">0</span><span>%</span>
                            <p class="text-sm text-purple-100">Humidity</p>
                        </div>
                    </div>

                    <div class="bg-white/10 rounded-xl p-4 flex items-center">
                        <div class="bg-white/20 p-3 rounded-full mr-3">
                            <i class="fa-solid fa-wind text-white"></i>
                        </div>
                        <div>
                            <span class="text-lg font-bold" id="windSpeedMap">0</span><span> km/h</span>
                            <p class="text-sm text-purple-100">Wind</p>
                        </div>
                    </div>

                    <div class="bg-white/10 rounded-xl p-4 flex items-center">
                        <div class="bg-white/20 p-3 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-lg font-bold" id="sunriseMap">--:--</span>
                            <p class="text-sm text-purple-100">Sunrise</p>
                        </div>
                    </div>

                    <div class="bg-white/10 rounded-xl p-4 flex items-center">
                        <div class="bg-white/20 p-3 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-lg font-bold" id="sunsetMap">--:--</span>
                            <p class="text-sm text-purple-100">Sunset</p>
                        </div>
                    </div>
                </div>

                <!-- Air Quality (New Feature) -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-3">Air Quality</h3>
                    <div class="bg-white/10 rounded-xl p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm">Air Quality Index</span>
                            <span class="text-lg font-bold" id="airQualityIndex">--</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div id="airQualityBar" class="bg-green-500 h-2.5 rounded-full" style="width: 0%"></div>
                        </div>
                        <div class="flex justify-between mt-1 text-xs">
                            <span>Good</span>
                            <span>Moderate</span>
                            <span>Unhealthy</span>
                            <span>Hazardous</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('ui/frontend/assets/js/weatherApi.js') }}"></script>

        <script>
            function fetchWeatherMap(cityName) {
                let apiKeyMap = 'd244580c4ef65da36df45a219910e1fd';
                let apiUrl = `https://api.openweathermap.org/data/2.5/weather?appid=${apiKeyMap}&q=${cityName}`;
                let forecastUrl = `https://api.openweathermap.org/data/2.5/forecast?appid=${apiKeyMap}&q=${cityName}&cnt=4`;

                // Fetch current weather
                fetch(apiUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data.cod == 200) {
                            // Update current weather
                            document.getElementById("temperatureMap").innerHTML = Math.round(data.main.temp - 273.15);
                            document.getElementById("cityNameMap").innerHTML = data.name;
                            document.getElementById("humidityMap").innerHTML = data.main.humidity;
                            document.getElementById("windSpeedMap").innerHTML = Math.round(data.wind.speed * 3.6 * 100) /
                                100;

                            // Weather description
                            document.getElementById("weatherDescriptionMap").innerHTML = data.weather[0].description;

                            // Weather icon
                            let iconCode = data.weather[0].icon;
                            let iconUrl = `https://openweathermap.org/img/wn/${iconCode}@2x.png`;
                            document.getElementById("weatherIconMap").setAttribute("src", iconUrl);

                            // Sunrise/sunset times
                            let sunrise = new Date(data.sys.sunrise * 1000);
                            let sunset = new Date(data.sys.sunset * 1000);
                            document.getElementById("sunriseMap").innerHTML = sunrise.toLocaleTimeString([], {
                                hour: '2-digit',
                                minute: '2-digit'
                            });
                            document.getElementById("sunsetMap").innerHTML = sunset.toLocaleTimeString([], {
                                hour: '2-digit',
                                minute: '2-digit'
                            });

                            // Clear any previous error messages
                            document.getElementById("responseMessageMap").innerHTML = "";
                        } else if (data.cod == 404) {
                            document.getElementById("responseMessageMap").innerHTML = data.message;
                            setTimeout(() => {
                                document.getElementById("responseMessageMap").innerHTML = "";
                            }, 5000);
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                    });

                // Fetch air quality data (mock for this example)
                setTimeout(() => {
                    // Simulate air quality data
                    let aqi = Math.floor(Math.random() * 300) + 1;
                    document.getElementById("airQualityIndex").innerHTML = aqi;

                    // Set color based on AQI
                    let aqiBar = document.getElementById("airQualityBar");
                    if (aqi <= 50) {
                        aqiBar.className = "bg-green-500 h-2.5 rounded-full";
                        aqiBar.style.width = "25%";
                    } else if (aqi <= 100) {
                        aqiBar.className = "bg-yellow-500 h-2.5 rounded-full";
                        aqiBar.style.width = "50%";
                    } else if (aqi <= 150) {
                        aqiBar.className = "bg-orange-500 h-2.5 rounded-full";
                        aqiBar.style.width = "75%";
                    } else {
                        aqiBar.className = "bg-red-500 h-2.5 rounded-full";
                        aqiBar.style.width = "100%";
                    }
                }, 500);
            }

            // Get user's current location
            function getCurrentLocation(apiType) {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            let lat = position.coords.latitude;
                            let lon = position.coords.longitude;
                            let apiKeyMap = 'd244580c4ef65da36df45a219910e1fd';
                            let apiUrl =
                                `https://api.openweathermap.org/data/2.5/weather?appid=${apiKeyMap}&lat=${lat}&lon=${lon}`;

                            fetch(apiUrl)
                                .then(response => response.json())
                                .then(data => {
                                    if (data.cod == 200) {
                                        document.getElementById(apiType === 'map' ? 'cityNameMapInput' :
                                            'cityNameInput').value = data.name;
                                        if (apiType === 'map') {
                                            fetchWeatherMap(data.name);
                                        } else {
                                            // You would call your weatherApi.js function here
                                            console.log("Fetching weather for current location:", data.name);
                                        }
                                    }
                                });
                        },
                        (error) => {
                            console.error("Geolocation error:", error);
                            alert("Unable to retrieve your location. Please enable location services or search manually.");
                        }
                    );
                } else {
                    alert("Geolocation is not supported by this browser.");
                }
            }

            document.addEventListener("DOMContentLoaded", () => {
                // Initialize with default city
                fetchWeatherMap("dhaka");

                // City search form submission
                document.getElementById("weatherMapApiForm").addEventListener("submit", (event) => {
                    event.preventDefault();
                    let cityName = document.getElementById("cityNameMapInput").value.trim() || "dhaka";
                    fetchWeatherMap(cityName);
                });

                // Refresh buttons
                document.getElementById("refreshWeatherMap").addEventListener("click", () => {
                    let cityName = document.getElementById("cityNameMapInput").value.trim() || "dhaka";
                    fetchWeatherMap(cityName);
                });

                // Location buttons
                document.getElementById("locationWeatherMap").addEventListener("click", () => {
                    getCurrentLocation('map');
                });
            });
        </script>
    @endpush
</x-frontend.layouts.master>
