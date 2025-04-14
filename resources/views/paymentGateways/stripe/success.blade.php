<!-- resources/views/payments/success.blade.php -->
<x-frontend.layouts.master>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Payment Successful
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-center">
                    <!-- Success Icon -->
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                    <!-- Success Message -->
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-2">
                        Payment Completed Successfully!
                    </h3>
                    
                    <p class="text-sm text-gray-500 mb-6">
                        Thank you for your payment. Your transaction has been completed successfully.
                    </p>

                    <!-- Transaction Details -->
                    <div class="bg-gray-50 p-4 rounded-md mb-6 text-left">
                        <h4 class="text-md font-medium text-gray-900 mb-2">Transaction Details</h4>
                        <dl class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">
                            <dt class="font-medium text-gray-500">Amount:</dt>
                            <dd class="text-gray-900">${{ number_format($paymentIntent->amount / 100, 2) }}</dd>
                            
                            <dt class="font-medium text-gray-500">Date:</dt>
                            <dd class="text-gray-900">{{ \Carbon\Carbon::createFromTimestamp($paymentIntent->created)->format('M d, Y H:i') }}</dd>
                            
                            <dt class="font-medium text-gray-500">Payment Method:</dt>
                            <dd class="text-gray-900">
                                @if(str_contains($paymentIntent->payment_method_types[0], 'card'))
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2zm0 2v2h16V6H4zm0 4v6h16v-6H4z"/>
                                        </svg>
                                        Credit Card (**** {{ $paymentIntent->payment_method->card->last4 ?? '4242' }})
                                    </div>
                                @elseif($paymentIntent->payment_method_types[0] === 'link')
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm1 14a1 1 0 0 1-2 0v-4a1 1 0 0 1 2 0zm-1-7a1 1 0 1 1 1-1 1 1 0 0 1-1 1z"/>
                                        </svg>
                                        Stripe Link
                                    </div>
                                @else
                                    {{ ucfirst(str_replace('_', ' ', $paymentIntent->payment_method_types[0])) }}
                                @endif
                            </dd>
                            
                            <dt class="font-medium text-gray-500">Status:</dt>
                            <dd class="text-green-600 font-medium">Completed</dd>
                            
                            <dt class="font-medium text-gray-500">Transaction ID:</dt>
                            <dd class="text-gray-900 font-mono text-xs">{{ $paymentIntent->id }}</dd>
                        </dl>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('stripe.checkout') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Return to Home
                        </a>
                        
                        <a href="#" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            View Receipt
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend.layouts.master>