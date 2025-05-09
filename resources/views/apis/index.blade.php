<x-frontend.layouts.master>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('3rd Party API Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Explore Our API Integrations</h2>
                    <div class="text-sm text-gray-500">Total 3 services available</div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Weather API Card -->
                    <a href="{{ route('api.weather.index') }}" class="group">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 h-full transition-all duration-300 transform group-hover:scale-[1.02] shadow-lg hover:shadow-xl overflow-hidden relative">
                            <div class="absolute -right-4 -top-4 opacity-10">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2v4"></path>
                                    <path d="m16.24 7.76 2.83-2.83"></path>
                                    <path d="M18 12h4"></path>
                                    <path d="m16.24 16.24 2.83 2.83"></path>
                                    <path d="M12 18v4"></path>
                                    <path d="m4.93 19.07 2.83-2.83"></path>
                                    <path d="M2 12h4"></path>
                                    <path d="m4.93 4.93 2.83 2.83"></path>
                                </svg>
                            </div>
                            <div class="relative z-10">
                                <div class="flex items-center mb-4">
                                    <div class="p-3 rounded-lg bg-white/20 backdrop-blur-sm mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-white">Weather API</h3>
                                </div>
                                <p class="text-blue-100 mb-6">Real-time weather data and forecasts for any location worldwide</p>
                                <div class="flex justify-between items-center text-blue-50 text-sm">
                                    <span>Live Data</span>
                                    <span class="flex items-center">
                                        Explore
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- News API Card -->
                    <a href="{{ route('api.news.index') }}" class="group">
                        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl p-6 h-full transition-all duration-300 transform group-hover:scale-[1.02] shadow-lg hover:shadow-xl overflow-hidden relative">
                            <div class="absolute -right-4 -top-4 opacity-10">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"></path>
                                    <path d="M18 14h-8"></path>
                                    <path d="M15 18h-5"></path>
                                    <path d="M10 6h8v4h-8V6Z"></path>
                                </svg>
                            </div>
                            <div class="relative z-10">
                                <div class="flex items-center mb-4">
                                    <div class="p-3 rounded-lg bg-white/20 backdrop-blur-sm mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-white">News API</h3>
                                </div>
                                <p class="text-emerald-100 mb-6">Latest headlines and articles from global news sources</p>
                                <div class="flex justify-between items-center text-emerald-50 text-sm">
                                    <span>Multiple Sources</span>
                                    <span class="flex items-center">
                                        Explore
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Country Info API Card -->
                    <a href="{{ route('api.country.index') }}" class="group">
                        <div class="bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl p-6 h-full transition-all duration-300 transform group-hover:scale-[1.02] shadow-lg hover:shadow-xl overflow-hidden relative">
                            <div class="absolute -right-4 -top-4 opacity-10">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 12a9 9 0 0 1-9 9m9-9a9 9 0 0 0-9-9m9 9H3m9 9a9 9 0 0 1-9-9m9 9c1.66 0 3-4.48 3-10s-1.34-10-3-10m0 20c-1.66 0-3-4.48-3-10s1.34-10 3-10m-9 9a9 9 0 0 1 9-9"></path>
                                </svg>
                            </div>
                            <div class="relative z-10">
                                <div class="flex items-center mb-4">
                                    <div class="p-3 rounded-lg bg-white/20 backdrop-blur-sm mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-white">Country Info</h3>
                                </div>
                                <p class="text-indigo-100 mb-6">Comprehensive data about countries, currencies, and demographics</p>
                                <div class="flex justify-between items-center text-indigo-50 text-sm">
                                    <span>Global Coverage</span>
                                    <span class="flex items-center">
                                        Explore
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-frontend.layouts.master>