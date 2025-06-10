<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function showCheckoutForm()
    {
        return view('paymentGateways.stripe.checkout');
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required',
        ]);

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Create a PaymentIntent with proper configuration
            $intent = \Stripe\PaymentIntent::create([
                'amount' => $request->amount * 100, // Convert to cents
                'currency' => 'usd',
                'payment_method' => $request->payment_method,
                'confirm' => true,
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never', // Disable redirect-based payments
                ],
            ]);

            // Handle the payment intent status
            if ($intent->status === 'succeeded') {
                session()->put('amount', $intent->amount / 100);
                session(['payment_intent_id' => $intent->id]);

                return redirect()->route('payment.success')->with('success', 'Payment processed successfully!');

            } elseif ($intent->status === 'requires_action') {
                // Payment requires additional action (3D Secure)
                return back()->with('error', 'Payment requires additional authentication.');
            } else {
                return back()->with('error', 'Payment processing failed. Please try again.');
            }
        } catch (\Stripe\Exception\CardException $e) {
            // Card was declined
            return back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function paymentSuccess()
    {
        $paymentIntentId = session('payment_intent_id');

        if (! $paymentIntentId) {
            return redirect()->route('stripe.checkout')->with('error', 'No payment information found');
        }

        // Retrieve the PaymentIntent from Stripe
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);

        return view('paymentGateways.stripe.success', [
            'paymentIntent' => $paymentIntent,
        ]);
    }
}
