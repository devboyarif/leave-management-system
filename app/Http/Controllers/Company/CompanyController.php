<?php

namespace App\Http\Controllers\Company;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Team;

class CompanyController extends Controller
{
    public function orders()
    {
        $search = request('search') ?? '';
        $payment = request('payment') ?? '';
        $plan = request('plan') ?? '';

        $orders = Order::whereCompanyId(currentCompany()->id)
            ->with('plan.planFeatures')
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
            ->latest()
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($order) => [
                'id' => $order->id,
                'order_id' => $search ? preg_replace('/(' . $search . ')/i', "<b class='bg-warning'>$1</b>", $order->order_id) : $order->order_id,
                'transaction_id' => $search ? preg_replace('/(' . $search . ')/i', "<b class='bg-warning'>$1</b>", $order->transaction_id) : $order->transaction_id,
                'currency_symbol' => $order->currency_symbol,
                'amount' => $order->amount,
                'payment_provider' => $order->payment_provider,
                'plan' => $order->plan,
            ]);

        $plans = Plan::all(['id', 'name']);

        return inertia('company/order/index', [
            'orders' => $orders,
            'plans' => $plans,
            'filters' => [
                'search' => $search,
                'payment' => $payment,
                'plan' => $plan,
            ],
        ]);
    }

    public function plan()
    {
        $plans = Plan::with('planFeatures')->whereStatus(1)->get();

        return inertia('company/plan', [
            'plans' => $plans,
        ]);
    }

    public function switchCompany($id)
    {
        auth()->user()->update([
            'current_company_id' => $id,
        ]);

        session()->flash('success', 'Company Switched');
        return back();
    }
}
