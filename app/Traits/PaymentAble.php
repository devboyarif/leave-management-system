<?php

namespace App\Traits;

use App\Models\Admin;
use App\Models\Earning;
use App\Models\UserPlan;
use Modules\Plan\Entities\Plan;
use Illuminate\Support\Facades\Notification;
use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Models\Order;
use App\Models\User;
use App\Notifications\Admin\NewPlanPurchaseNotification;
use App\Notifications\Admin\PlanPurchase;

trait PaymentAble
{
    public function orderPlacing($redirect = true, $order_id = null)
    {
        $plan = session('plan');
        $company_subscription = currentCompany()->subscription;
        $order_amount = session('order_payment');
        $transaction_id = session('transaction_id') ?? uniqid('tr_');

        // attach the plan to the company
        $company_subscription->plan_id = $plan->id;
        if ($plan->interval == 'monthly') {
            $expired_date = now()->addMonth()->format('Y-m-d');
        } elseif ($plan->interval == 'yearly') {
            $expired_date = now()->addYear()->format('Y-m-d');
        } elseif ($plan->interval == 'custom_date') {
            $expired_date = now()->addDays($plan->custom_interval_days)->format('Y-m-d');
        } else {
            $expired_date = '';
        }
        $company_subscription->expired_date = $expired_date;
        $company_subscription->subscription_type = $plan->interval;
        $company_subscription->save();

        // create the order
        Order::create([
            'order_id' => $order_id ?? uniqid(),
            'transaction_id' => $transaction_id,
            'plan_id' => $plan->id,
            'company_id' => currentCompany()->id,
            'expired_date' => $expired_date ?? 'Lifetime',
            'payment_status' => 'paid',
            'amount' => $order_amount['amount'],
            'usd_amount' => $order_amount['usd_amount'],
            'currency_symbol' => $order_amount['currency_symbol'],
            'payment_provider' => $order_amount['payment_provider'],
        ]);

        storeCompanyCurrentSubscription();
        $this->forgetSessions();

        if (checkMailConfig()) {
            $admins = User::roleAdmin()->get();
            foreach ($admins as $admin) {
                Notification::send($admin, new PlanPurchase($admin->name, $plan->name, auth()->user()->name));
            }
        }

        if ($redirect) {
            session()->flash('success', 'Plan purchased successfully.');
            return redirect()->route('website.home')->send();
            // return redirect()->route('company.plan')->send();
        }
    }

    private function forgetSessions()
    {
        session()->forget('plan');
        session()->forget('order_payment');
        session()->forget('transaction_id');
        session()->forget('stripe_razor_amount');
    }
}
