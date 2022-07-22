<?php

namespace App\Http\Controllers\Payment;

use Instamojo\Instamojo;
use Illuminate\Http\Request;
use App\Traits\PaymentAble;
use App\Http\Controllers\Controller;

class InstamojoController extends Controller
{
    use PaymentAble;

    public function pay(Request $request)
    {
        session(['plan_id' => $request->plan_id]);
        session(['payment_provider' => 'instamojo']);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                "X-Api-Key:" . config('zakirsoft.im_key'),
                "X-Auth-Token:" . config('zakirsoft.im_secret')
            )
        );
        $payload = array(
            'purpose' => "Payment for the job you bought",
            'amount' => $request->amount,
            'phone' => "9888888888",
            'buyer_name' => auth('user')->user()->name,
            'redirect_url' => route('instamojo.success'),
            'send_email' => true,
            'webhook' => 'http://www.example.com/webhook/',
            'send_sms' => true,
            'email' => auth('user')->user()->email,
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        return redirect($response->payment_request->longurl);

        $api = new Instamojo(
            config('zakirsoft.im_key'),
            config('zakirsoft.im_secret'),
            config('zakirsoft.im_url')
        );

        try {
            $response = $api->paymentRequestCreate(array(
                "purpose" => "Payment for the product you bought",
                "amount" => $request->amount,
                "buyer_name" => auth('user')->user()->name,
                "send_email" => true,
                "email" => auth('user')->user()->name,
                "phone" => "123456789",
                "redirect_url" => route('instamojo.success')
            ));

            header('Location: ' . $response['longurl']);
            exit();
        } catch (\Exception $e) {
            print('Error: ' . $e->getMessage());
        }
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
                "X-Api-Key:" . config('zakirsoft.im_key'),
                "X-Auth-Token:" . config('zakirsoft.im_secret')
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

                // Here Your Database Insert Login
                $this->orderPlacing();
            } else {
                session()->flash('error', 'Payment was failed, , Try Again!!');
                return redirect()->route('payment');
            }
        }
    }
}
