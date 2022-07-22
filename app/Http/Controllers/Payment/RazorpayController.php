<?php

namespace App\Http\Controllers\Payment;

use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Modules\Plan\Entities\Plan;
use App\Traits\PaymentAble;
use App\Http\Controllers\Controller;
use App\Notifications\MembershipUpgradeNotification;

class RazorpayController extends Controller
{
    use PaymentAble;

    public function payment(Request $request)
    {
        session(['plan_id' => $request->plan_id]);
        session(['payment_provider' => 'razorpay']);

        $input = $request->all();
        $api = new Api(config('zakirsoft.razorpay_key'), config('zakirsoft.razorpay_secret'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $payment->capture(array('amount' => $payment['amount']));
                $this->orderPlacing();
            } catch (\Exception $e) {
                return $e->getMessage();
                session()->put('error', $e->getMessage());
                return redirect()->back();
            }
        }
    }
}
