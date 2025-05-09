<x-frontend.layouts.master>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment Gateways') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Available Payment Gateways</h2>
                    <div class="text-sm text-gray-500">Secure payment processing</div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- SSL Commerz Card -->
                    <a href="{{ route('gateway.sslcommerz.index') }}" class="group">
                        <div class="bg-gradient-to-br from-sky-500 to-blue-600 rounded-xl p-6 h-full transition-all duration-300 transform group-hover:scale-[1.02] shadow-lg hover:shadow-xl overflow-hidden relative">
                            <div class="absolute -right-4 -top-4 opacity-10">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                                    <path d="M2 10h20"></path>
                                    <path d="M6 10v10"></path>
                                </svg>
                            </div>
                            <div class="relative z-10">
                                <div class="flex items-center mb-4">
                                    <div class="p-3 rounded-lg bg-white/20 backdrop-blur-sm mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-white">SSL Commerz</h3>
                                </div>
                                <p class="text-blue-100 mb-6">Bangladesh's leading payment gateway with local bank support</p>
                                <div class="flex justify-between items-center text-blue-50 text-sm">
                                    <span>Local Payments</span>
                                    <span class="flex items-center">
                                        Configure
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Stripe Card -->
                    <a href="{{ route('stripe.checkout') }}" class="group">
                        <div class="bg-gradient-to-br from-teal-500 to-emerald-600 rounded-xl p-6 h-full transition-all duration-300 transform group-hover:scale-[1.02] shadow-lg hover:shadow-xl overflow-hidden relative">
                            <div class="absolute -right-4 -top-4 opacity-10">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6L6 18"></path>
                                    <path d="M6 6l12 12"></path>
                                </svg>
                            </div>
                            <div class="relative z-10">
                                <div class="flex items-center mb-4">
                                    <div class="p-3 rounded-lg bg-white/20 backdrop-blur-sm mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v3m4 6v3m0 0h-4m4 0h4m-8-9h4m-4 0h4m4 0a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2h4" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-white">Stripe</h3>
                                </div>
                                <p class="text-emerald-100 mb-6">Global payments platform supporting cards and digital wallets</p>
                                <div class="flex justify-between items-center text-emerald-50 text-sm">
                                    <span>International</span>
                                    <span class="flex items-center">
                                        Configure
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Add New Gateway Card (Optional) -->
                    {{-- <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 h-full flex flex-col items-center justify-center group hover:border-gray-400 transition-colors duration-300">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-gray-200 transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-700 mb-2">Add New Gateway</h3>
                        <p class="text-gray-500 text-sm text-center">Integrate additional payment methods</p>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-frontend.layouts.master>