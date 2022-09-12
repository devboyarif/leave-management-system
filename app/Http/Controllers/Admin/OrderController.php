<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use App\Models\Order;
use App\Models\Company;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function orders()
    {
        $search = request('search') ?? '';
        $company = request('company') ?? '';
        $payment = request('payment') ?? '';
        $plan = request('plan') ?? '';

        $orders = Order::with('company.user', 'plan.planFeatures')
        ->where(function ($query) use ($search) {
            $query->where('order_id', 'LIKE', '%' . $search . '%')
                ->orWhere('transaction_id', 'LIKE', '%' . $search . '%');
        })
        ->when($plan, function ($query, $plan) {
            $query->where('plan_id', $plan);
        })
        ->when($payment, function ($query, $payment) {
            $query->where('payment_provider', $payment);
        })
        ->when($company, function ($query, $company) {
            $query->where('company_id', $company);
        })
        ->latest()
        ->paginate(10)
        ->withQueryString()
        ->through(fn ($order) => [
            'id' => $order->id,
            'order_id' => $search ? preg_replace('/(' . $search . ')/i', "<b class='bg-warning'>$1</b>", $order->order_id) : $order->order_id,
            'transaction_id' => $search ? preg_replace('/(' . $search . ')/i', "<b class='bg-warning'>$1</b>", $order->transaction_id) : $order->transaction_id,
            'company_name' => $order->company->user->name,
            'company_email' => $order->company->user->email,
            'company_id' => $order->company->id,
            'currency_symbol' => $order->currency_symbol,
            'amount' => $order->amount,
            'payment_provider' => $order->payment_provider,
            'plan' => $order->plan,
        ]);

        $companies = Company::with('user:id,name')->get()->map(function ($company) {
            return [
                'id' => $company->id,
                'name' => $company->user->name,
            ];
        });

        $plans = Plan::all(['id', 'name']);

        return inertia('admin/order/index', [
            'companies' => $companies,
            'plans' => $plans,
            'orders' => $orders,
            'filters' => [
                'company' => $company,
                'search' => $search,
                'payment' => $payment,
                'plan' => $plan,
            ],
        ]);
    }

    public function orderDetails(Order $order){
       $company = $order->company->load('country:id,name', 'user');
        $subscribed_plan = $company->subscription->load('plan.planFeatures');
        $setting = Setting::first();

        return inertia('admin/order/show', compact('subscribed_plan','order','setting','company'));
    }
}
