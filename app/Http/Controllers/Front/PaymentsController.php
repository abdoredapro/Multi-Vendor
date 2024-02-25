<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function create(Order $order) {
        return view('front.payment.create', [
            'order' => $order,
        ]);
    }

    public function createStripePaymentIntent(Order $order) {

        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));

        $amount = $order->items->sum(function($item) {
            return $item->price * $item->quantity;
        });



        $paymentIntent = $stripe->paymentIntents->create([
        'amount' => '60',
        'currency' => 'usd',
        'payment_method_types' => ['card'],
        ]);

        try {

            $payment = new Payment();
            $payment->forceFill([
                'order_id' => $order->id,
                'amount' => $paymentIntent->amount,
                'currency' =>  $paymentIntent->currency,
                'method' => 'stripe', 
                'status' => 'pending',
                'transaction_id' => $paymentIntent->id,
                'transaction_date' => json_decode($paymentIntent),

            ])->save(); 

        } catch (QueryException $e) {
            echo $e->getMessage();
            return;
        }
        
        return [
            'clientSecret' => $paymentIntent->client_secret,
        ];

    }

    public function confirm(Request $request, Order $order) {


        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));

        $paymentIntent = $stripe->paymentIntents->retrieve($request->query('payment_intent'), []);

        if($paymentIntent->status == 'succeeded') {
            try {

                $payment = Payment::Where('order_id', $order->id)->first();

                $payment->forceFill([
                    'status' => 'completed',
                    'transaction_date' => json_decode($paymentIntent),

                ])->save(); 

            } catch (QueryException $e) {
                echo $e->getMessage();
                return;
            }
            
            return redirect()->route('home',[
                'status' => 'payment-succeeded'
            ]);

        }

        return redirect()->route('orders.payment.create',[
            'order' => $order->id,
            'status' => $paymentIntent->status,
        ]);


    }


}
