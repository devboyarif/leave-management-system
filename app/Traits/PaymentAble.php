<?php

namespace App\Traits;

use Illuminate\Support\Facades\Notification;
use App\Models\Order;
use App\Models\User;
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
        } elseif ($plan->interval == 'custom_days') {
            $expired_date = now()->addDays($plan->custom_interval_days)->format('Y-m-d');
        } else {
            $expired_date = '';
        }
        $company_subscription->expired_date = $expired_date;
        $company_subscription->subscription_type = $plan->interval;
        $company_subscription->save();

        // create the order
        $order = Order::create([
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
                Notification::send($admin, new PlanPurchase($admin->name, $plan->name, currentCompany()->company_name, $order->id));
            }
        }

        if ($redirect) {
            session()->flash('success', 'Plan purchased successfully.');
            return redirect()->route('company.billing')->send();
        }
    }

    private function forgetSessions()
    {
        session()->forget('plan');
        session()->forget('order_payment');
        session()->forget('transaction_id');
        session()->forget('stripe_amount');
    }

    public function switchToFreePlan($plan){
        $company_subscription = currentCompany()->subscription;

        // attach the plan to the company
        $company_subscription->plan_id = $plan->id;
        if ($plan->interval == 'monthly') {
            $expired_date = now()->addMonth()->format('Y-m-d');
        } elseif ($plan->interval == 'yearly') {
            $expired_date = now()->addYear()->format('Y-m-d');
        } elseif ($plan->interval == 'custom_days') {
            $expired_date = now()->addDays($plan->custom_interval_days)->format('Y-m-d');
        } else {
            $expired_date = '';
        }

        if ($expired_date) {
            $company_subscription->expired_date = $expired_date;
        }

        $company_subscription->subscription_type = $plan->interval;
        $company_subscription->save();

        // create the order
        $order = Order::create([
            'order_id' => uniqid(),
            'transaction_id' => uniqid('tr_'),
            'plan_id' => $plan->id,
            'company_id' => currentCompany()->id,
            'expired_date' => $expired_date ?? 'Lifetime',
            'payment_status' => 'paid',
            'amount' => 0,
            'usd_amount' => 0,
            'currency_symbol' => config('kodebazar.currency_symbol'),
            'payment_provider' => 'none',
        ]);

        storeCompanyCurrentSubscription();
        $this->forgetSessions();

        if (checkMailConfig()) {
            $admins = User::roleAdmin()->get();
            foreach ($admins as $admin) {
                Notification::send($admin, new PlanPurchase($admin->name, $plan->name, currentCompany()->company_name, $order->id));
            }
        }

        session()->flash('success', 'Plan purchased successfully.');
        return redirect()->route('company.billing')->send();
    }
}
