<x-frontend.layouts.master>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">Micro Features</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 text-center">
                    <!-- Hash Button -->
                    <a href="{{ route('hash.index') }}" class="bg-blue-600 rounded py-2 px-3 text-white">
                        Generate Hash
                    </a>
                    <!-- QR Code Button -->
                    <a href="{{ route('qrcode.index') }}" class="bg-green-500 rounded py-2 px-3 text-white">
                        Generate QR Code
                    </a>

                    <!-- Simple Translator Button -->
                    <a href="{{ route('japaneses.index') }}" class="bg-purple-600 rounded py-2 px-3 text-white">
                        Japanese Words
                    </a>

                    <!--Payment Gateway  Button -->
                    <a href="{{ route('paymentGateways') }}" class="bg-sky-600 rounded py-2 px-3 text-white">
                        Payment Gateway
                    </a>

                    <!-- Web API's  Button -->
                    <a href="{{ route('api.index') }}" class="bg-amber-600 rounded py-2 px-3 text-white">
                        Web API's
                    </a>


                    <!-- Add more buttons for additional features -->

                </div>
            </div>
        </div>
    </div>


</x-frontend.layouts.master>
