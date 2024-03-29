<x-frontend.layouts.master>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment Gateways') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">Different Gateways</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 text-center">
                    <!-- Hash Button -->
                    <a href="{{ route('hash.index') }}" class="bg-blue-600 rounded py-2 px-3 text-white">
                        Bkash Gateway
                    </a>
                    <!-- QR Code Button -->
                    <a href="{{ route('japaneses.index') }}" class="bg-green-500 rounded py-2 px-3 text-white">
                        Edokan Pay
                    </a>

                    <!--SSL Commerzs  Button -->
                    <a href="{{ route('gateway.sslcommerz.index') }}" class="bg-sky-600 rounded py-2 px-3 text-white">
                        SSL Commerzs
                    </a>


                    <!-- Add more buttons for additional features -->

                </div>
            </div>
        </div>
    </div>


</x-frontend.layouts.master>
