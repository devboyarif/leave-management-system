<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use Modules\Plan\Entities\Plan;
use App\Traits\PaymentAble;
use App\Http\Controllers\Controller;
use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Notifications\MembershipUpgradeNotification;

class PaystackController extends Controller
{
    use PaymentAble;

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {
        session(['plan_id' => $request->plan_id]);
        session(['payment_provider' => 'paystack']);

        $request->validate([
            'plan_id' => 'required',
            'amount' => 'required',
        ]);

        $secret_key = config('zakirsoft.paystack_key');
        $curl = curl_init();
        $callback_url = route('paystack.success'); // url to go to after payment
        $amount = (int) Currency::convert()
            ->from(config('jobpilot.currency'))
            ->to('ZAR')
            ->amount($request->amount)
            ->round(2)
            ->get() * 100;
        // $amount = $request->amount * 100 * 16;

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'amount' => $amount,
                'email' => auth('user')->user()->email,
                'callback_url' => $callback_url,
            ]),
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer " . $secret_key, //replace this with your own test key
                "content-type: application/json",
                "cache-control: no-cache"
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        if ($err) {
            return redirect()->back()->with('error', $err);
        }

        $tranx = json_decode($response, true);
        session(['paystack_request' => $request->all()]);
        if (!$tranx['status']) {
            return redirect()->back()->with("error", $tranx['message']);
        }
        return redirect($tranx['data']['authorization_url']);
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function successPaystack(Request $request)
    {
        $paystack_request = session('paystack_request');

        if ($request['trxref'] === $request['reference']) {
            $this->orderPlacing();
        }

        session()->flash('error', 'Something went wrong.');
        return back();
    }
}
