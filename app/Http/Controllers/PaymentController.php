<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment.form');
    }

    public function processPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $token = $request->stripeToken;

        try {
            $charge = Charge::create([
                'amount' => 1000, // amount in cents
                'currency' => 'usd',
                'description' => 'Example Charge',
                'source' => $token,
            ]);

            return redirect('/payment/success');
        } catch (Exception $e) {
            return redirect('/payment/failure');
        }
    }

    public function paymentSuccess()
    {
        return view('payment.success');
    }

    public function paymentFailure()
    {
        return view('payment.failure');
    }
}
