<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Traits\PaymentAble;
use App\Http\Controllers\Controller;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class FlutterwaveController extends Controller
{
    use PaymentAble;

    /**
     * Initialize Rave payment process
     * @return void
     */
    public function initialize(Request $request)
    {
        session(['plan_id' => $request->plan_id]);
        session(['payment_provider' => 'flutterwave']);

        //This generates a payment reference
        $reference = Flutterwave::generateReference();

        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => $request->amount,
            'email' => auth('user')->user()->email,
            'tx_ref' => $reference,
            'currency' => config('zakirsoft.currency') ?? 'NGN',
            'redirect_url' => route('flutterwave.callback'),
            'customer' => [
                'email' => auth('user')->user()->email,
                "phone_number" => '123456789',
                "name" => auth('user')->user()->name,
            ],

            "customizations" => [
                "title" => "payment for the job services",
                "description" => date('Y-m-d H:i:s'),
            ]
        ];

        $payment = Flutterwave::initializePayment($data);


        if ($payment['status'] !== 'success') {
            // notify something went wrong
            return;
        }

        return redirect($payment['data']['link']);
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback()
    {
        $status = request()->status;

        //if payment is successful
        if ($status ==  'successful') {

            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $data = Flutterwave::verifyTransaction($transactionID);

            $this->orderPlacing();
        } elseif ($status ==  'cancelled') {
            return back()->with('error', 'Payment was cancelled');
            //Put desired action/code after transaction has been cancelled here
        } else {
            return back()->with('error', 'Payment was cancelled');
            //Put desired action/code after transaction has failed here
        }
        // Get the transaction from your DB using the transaction reference (txref)
        // Check if you have previously given value for the transaction. If you have, redirect to your successpage else, continue
        // Confirm that the currency on your db transaction is equal to the returned currency
        // Confirm that the db transaction amount is equal to the returned amount
        // Update the db transaction record (including parameters that didn't exist before the transaction is completed. for audit purpose)
        // Give value for the transaction
        // Update the transaction to note that you have given value for the transaction
        // You can also redirect to your success page from here

    }
}
