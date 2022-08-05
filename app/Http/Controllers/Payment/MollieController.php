<?php

namespace App\Http\Controllers\Payment;

use App\Traits\PaymentAble;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use App\Http\Controllers\Controller;

class MollieController extends Controller
{
    use PaymentAble;

    public function  __construct()
    {
        Mollie::api()->setApiKey(config('kodebazar.mollie_key')); // your mollie test api key
    }

    /**
     * Redirect the user to the Payment Gateway.
     *
     * @return Response
     */
    public function preparePayment(Request $request)
    {
        $plan = session('plan');
        $converted_amount = currencyConversion($plan->price);
        $amount = currencyConversion($plan->price, null, 'EUR', 1);

        session(['order_payment' => [
            'payment_provider' => 'mollie',
            'amount' =>  $amount,
            'currency_symbol' => '€',
            'usd_amount' =>  $converted_amount,
        ]]);

        $amount = $request->amount;
        $decimal_amount =  number_format((float)$amount, 2, '.', '');

        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => 'EUR', // Type of currency you want to send
                'value' => $decimal_amount, // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            'description' => 'Payment By ' . auth()->user()->name . ' for the subscription',
            'redirectUrl' => route('mollie.success'), // after the payment completion where you to redirect
        ]);

        session(['transaction_id' => $payment->id ?? null]);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    /**
     * Page redirection after the successfull payment
     *
     * @return Response
     */
    public function paymentSuccess()
    {
        $this->orderPlacing();
    }
}
