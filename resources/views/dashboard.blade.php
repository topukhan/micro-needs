<x-frontend.layouts.master>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-8">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Micro Features</h2>
                    <p class="text-gray-500">Explore our collection of handy tools</p>
                </div>
    
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <!-- Hash Button -->
                    <a href="{{ route('hash.index') }}" class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 p-0.5 shadow-lg transition-all hover:shadow-blue-500/20 hover:scale-[1.02]">
                        <div class="rounded-[10px] bg-white p-6 h-full flex flex-col items-center justify-center transition duration-300 group-hover:bg-opacity-0">
                            <div class="rounded-full bg-blue-100 p-4 mb-4 text-blue-600 group-hover:text-white group-hover:bg-opacity-20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-white">Generate Hash</h3>
                        </div>
                    </a>
    
                    <!-- QR Code Button -->
                    <a href="{{ route('qrcode.index') }}" class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-green-500 to-green-600 p-0.5 shadow-lg transition-all hover:shadow-green-500/20 hover:scale-[1.02]">
                        <div class="rounded-[10px] bg-white p-6 h-full flex flex-col items-center justify-center transition duration-300 group-hover:bg-opacity-0">
                            <div class="rounded-full bg-green-100 p-4 mb-4 text-green-600 group-hover:text-white group-hover:bg-opacity-20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-white">Generate QR Code</h3>
                        </div>
                    </a>
    
                    <!-- CRUD Button -->
                    <a href="{{ route('crud.index') }}" class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 p-0.5 shadow-lg transition-all hover:shadow-purple-500/20 hover:scale-[1.02]">
                        <div class="rounded-[10px] bg-white p-6 h-full flex flex-col items-center justify-center transition duration-300 group-hover:bg-opacity-0">
                            <div class="rounded-full bg-purple-100 p-4 mb-4 text-purple-600 group-hover:text-white group-hover:bg-opacity-20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-white">CRUD</h3>
                        </div>
                    </a>
    
                    <!-- Payment Gateway Button -->
                    <a href="{{ route('paymentGateways') }}" class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-sky-500 to-sky-600 p-0.5 shadow-lg transition-all hover:shadow-sky-500/20 hover:scale-[1.02]">
                        <div class="rounded-[10px] bg-white p-6 h-full flex flex-col items-center justify-center transition duration-300 group-hover:bg-opacity-0">
                            <div class="rounded-full bg-sky-100 p-4 mb-4 text-sky-600 group-hover:text-white group-hover:bg-opacity-20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-white">Payment Gateway</h3>
                        </div>
                    </a>
    
                    <!-- Web API's Button -->
                    <a href="{{ route('api.index') }}" class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 p-0.5 shadow-lg transition-all hover:shadow-amber-500/20 hover:scale-[1.02]">
                        <div class="rounded-[10px] bg-white p-6 h-full flex flex-col items-center justify-center transition duration-300 group-hover:bg-opacity-0">
                            <div class="rounded-full bg-amber-100 p-4 mb-4 text-amber-600 group-hover:text-white group-hover:bg-opacity-20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-white">Web API's</h3>
                        </div>
                    </a>
    
                    <!-- Gate Policy Button -->
                    <a href="{{ route('posts.index') }}" class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-red-500 to-red-600 p-0.5 shadow-lg transition-all hover:shadow-red-500/20 hover:scale-[1.02]">
                        <div class="rounded-[10px] bg-white p-6 h-full flex flex-col items-center justify-center transition duration-300 group-hover:bg-opacity-0">
                            <div class="rounded-full bg-red-100 p-4 mb-4 text-red-600 group-hover:text-white group-hover:bg-opacity-20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-white">Gate Policy</h3>
                        </div>
                    </a>
                    
                    <!-- Form Builder Button -->
                    <a href="{{ route('form.builder') }}" class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-lime-500 to-lime-600 p-0.5 shadow-lg transition-all hover:shadow-lime-500/20 hover:scale-[1.02]">
                        <div class="rounded-[10px] bg-white p-6 h-full flex flex-col items-center justify-center transition duration-300 group-hover:bg-opacity-0">
                            <div class="rounded-full bg-lime-100 p-4 mb-4 text-lime-600 group-hover:text-white group-hover:bg-opacity-20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-white">Form Builder</h3>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>


</x-frontend.layouts.master>
