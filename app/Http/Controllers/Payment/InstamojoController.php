<?php

namespace App\Http\Controllers\Payment;

use Instamojo\Instamojo;
use App\Traits\PaymentAble;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstamojoController extends Controller
{
    use PaymentAble;

    public function pay()
    {
        $plan = session('plan');
        $converted_amount = currencyConversion($plan->price);
        $amount = currencyConversion($plan->price, null, 'INR', 1);

        session(['order_payment' => [
            'payment_provider' => 'instamojo',
            'amount' =>  $amount,
            'currency_symbol' => '₹',
            'usd_amount' =>  $converted_amount,
        ]]);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                "X-Api-Key:" . config('kodebazar.im_key'),
                "X-Auth-Token:" . config('kodebazar.im_secret')
            )
        );
        $payload = array(
            'purpose' => "Payment for the plan: " . $plan->name,
            'amount' => $amount,
            'phone' => "9888888888",
            'buyer_name' => auth()->user()->name,
            'redirect_url' => route('instamojo.success'),
            'send_email' => true,
            'webhook' => 'http://www.example.com/webhook/',
            'send_sms' => true,
            'email' => auth()->user()->email,
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        return redirect($response->payment_request->longurl);
    }

    public function success(Request $request)
    {
        $input = $request->all();

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payments/' . $request->get('payment_id'));
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                "X-Api-Key:" . config('kodebazar.im_key'),
                "X-Auth-Token:" . config('kodebazar.im_secret')
            )
        );

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            return back()->with('error', 'Payment was failed');
        } else {
            $data = json_decode($response);
        }

        if ($data->success == true) {
            if ($data->payment->status == 'Credit') {
                session(['transaction_id' => $request->get('payment_id') ?? null]);

                $this->orderPlacing();
            } else {
                session()->flash('error', 'Payment was failed, , Try Again!!');
                return redirect()->route('payment');
            }
        }
    }
}
