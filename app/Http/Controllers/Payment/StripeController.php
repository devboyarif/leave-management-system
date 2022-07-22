<?php

namespace App\Http\Controllers\Payment;

use Stripe\Charge;
use Stripe\Stripe;
use App\Traits\PaymentAble;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StripeController extends Controller
{
    use PaymentAble;

    public function stripePost(Request $request)
    {
        $plan = session('plan');
        $converted_amount = currencyConversion($plan->price);

        session(['order_payment' => [
            'payment_provider' => 'stripe',
            'amount' =>  $converted_amount,
            'currency_symbol' => '$',
            'usd_amount' =>  $converted_amount,
        ]]);

        try {
            Stripe::setApiKey(config('kodebazar.stripe_secret'));
            $charge = Charge::create([
                "amount" => session('stripe_razor_amount'),
                "currency" => 'USD',
                "source" => $request->stripeToken,
                "description" => "Payment for " . $plan->name . " plan" . " in " . config('app.name'),
            ]);

            session(['transaction_id' => $charge->id ?? null]);

            $this->orderPlacing();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

        // return $charge;

        // Australian Dollar, AUD
        // Brazilian Real, BRL
        // British Pound, GBP
        // Bulgarian Lev, BGN
        // Canadian Dollar, CAD
        // Czech Koruna, CZK
        // Danish Krone, DKK
        // Euro, EUR
        // Hong Kong Dollar, HKD
        // Hungarian Forint, HUF
        // Israeli New Sheqel, ILS
        // Japanese Yen, JPY
        // Malaysian Ringgit, MYR
        // Mexican Peso, MXN
        // New Taiwan Dollar, TWD
        // New Zealand Dollar, NZD
        // Norwegian Krone, NOK
        // Philippine Peso, PHP
        // Polish Złoty, PLN
        // Romania Leu, RON
        // Russian Ruble, RUB
        // Singapore Dollar, SGD
        // Swedish Krona, SEK
        // Swiss Franc, CHF
        // Thai Baht, THB
        // United States Dollar, USD
    }
}
