<!-- resources/views/payments/checkout.blade.php -->
<x-frontend.layouts.master>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Payment Gateways 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <div class="flex justify-center">
                        <img src="https://stripe.com/img/v3/home/twitter.png" class="h-12" alt="Stripe">
                    </div>
                    
                    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                        Complete Your Payment
                    </h2>
                    
                    <form id="payment-form" class="mt-8 space-y-6" action="{{ route('payment.process') }}" method="POST">
                        @csrf
                        
                        <div class="rounded-md shadow-sm space-y-4">
                            <!-- Amount Input -->
                            <div>
                                <label for="amount" class="block text-sm font-medium text-gray-700">Amount (USD)</label>
                                <input 
                                    type="number" 
                                    id="amount" 
                                    name="amount" 
                                    min="1" 
                                    step="0.01"
                                    value="10.00"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    required
                                >
                            </div>
                            
                            <!-- Cardholder Name -->
                            <div>
                                <label for="cardholder-name" class="block text-sm font-medium text-gray-700">Cardholder Name</label>
                                <input 
                                    type="text" 
                                    id="cardholder-name" 
                                    name="cardholder_name"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    required
                                    placeholder="John Doe"
                                    value="John Doe"
                                >
                            </div>
                            
                            <!-- Card Details -->
                            <div class="border-t border-gray-200 pt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                    Card Details 
                                    <a href="https://docs.stripe.com/testing?testing-method=card-numbers#cards" target="_blank" rel="noopener noreferrer" class="ml-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hover:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                </label> 
                                <div id="card-element" class="p-3 border border-gray-300 rounded-md">
                                    <!-- Stripe Card Element will be inserted here -->
                                </div>
                                <div id="card-errors" role="alert" class="text-red-500 text-xs mt-2"></div>
                            </div>
                        </div>

                        <!-- Hidden payment method input -->
                        <input type="hidden" name="payment_method" id="payment-method">
                        
                        <div>
                            <button 
                                type="submit" 
                                id="submit-button"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50"
                            >
                                <span id="button-text">Pay $<span id="amount-display">10.00</span></span>
                                <span id="button-spinner" class="hidden ml-2">
                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                        
                        <div class="flex items-center justify-center">
                            <img src="https://stripe.com/img/v3/payments/payments.svg" alt="Accepted payment methods" class="h-8">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@push('script-links')
<script src="https://js.stripe.com/v3/"></script>
    
@endpush
@push('scripts')
<script>
    console.log('Stripe loaded:', typeof Stripe !== 'undefined');
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Stripe with your publishable key
        const stripe = Stripe('{{ config('services.stripe.key') }}');
        const elements = stripe.elements();
        
        // Custom styling for the card element
        const style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        
        // Create an instance of the card Element
        const card = elements.create('card', {
            style: style,
            hidePostalCode: true
        });
        
        // Mount the card Element
        card.mount('#card-element');
        
        // Update displayed amount when input changes
        const amountInput = document.getElementById('amount');
        const amountDisplay = document.getElementById('amount-display');
        amountInput.addEventListener('input', function() {
            amountDisplay.textContent = this.value;
        });
        
        // Handle real-time validation errors from the card Element
        card.addEventListener('change', function(event) {
            const displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        
        // Handle form submission
        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit-button');
        const buttonSpinner = document.getElementById('button-spinner');
        const buttonText = document.getElementById('button-text');
        
        form.addEventListener('submit', async function(event) {
            event.preventDefault();
            
            // Disable form submission and show spinner
            submitButton.disabled = true;
            buttonText.classList.add('hidden');
            buttonSpinner.classList.remove('hidden');
            
            // Create payment method
            const { error, paymentMethod } = await stripe.createPaymentMethod({
                type: 'card',
                card: card,
                billing_details: {
                    name: document.getElementById('cardholder-name').value
                }
            });
            
            if (error) {
                // Show error to customer
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
                
                // Re-enable form
                submitButton.disabled = false;
                buttonText.classList.remove('hidden');
                buttonSpinner.classList.add('hidden');
            } else {
                // Add payment method ID to form
                document.getElementById('payment-method').value = paymentMethod.id;
                
                // Submit the form
                form.submit();
            }
        });
    });
</script>
@endpush
</x-frontend.layouts.master>
