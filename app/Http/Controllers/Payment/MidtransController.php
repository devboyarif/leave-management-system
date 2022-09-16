<?php

namespace App\Http\Controllers\Payment;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Traits\PaymentAble;
use App\Http\Controllers\Controller;

class MidtransController extends Controller
{
    use PaymentAble;

    public function success(Request $request)
    {
        // session data store
        $plan = session('plan');
        $converted_amount = currencyConversion($plan->price);

        session(['order_payment' => [
            'payment_provider' => 'midtrans',
            'amount' => session('midtrans_amount'),
            'currency_symbol' => 'Rp',
            'usd_amount' =>  $converted_amount,
        ]]);

        // plan data store
        session(['transaction_id' => $request->transaction_id]);
        $this->orderPlacing(false, $request->order_id);

        // forget midtrans session
        session()->forget('midtrans_amount');
        session()->forget('payment_details');
        session()->flash('success', 'Payment Successfully');

        // redirect url pass
        return response()->json([
            'redirect_url' => route('website.home'),
        ]);
    }

    public function transactionUpdate(Request $request)
    {
        $order = Order::where('order_id', $request->order_id)->first();

        return [
            'request' => $request->all(),
            'order' => $order,
        ];
    }
}
