<?php

namespace App\Http\Controllers\Company;

use App\Models\Plan;
use App\Models\Order;
use App\Models\Company;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function switchCompany($id)
    {
        auth()->user()->update([
            'current_company_id' => $id,
        ]);

        session()->flash('success', 'Company Switched');
        return back();
    }

    public function createCompany()
    {
        return inertia('company/createnew/index');
    }

    public function deleteCompany()
    {
        $current_company = currentCompany();
        $user = auth()->user();
        $companies = Company::where('user_id', auth()->id())
        ->where('id', '!=', $current_company->id)
        ->pluck('id')
        ->toArray();

        if (count($companies) && $companies[0]) {
            $current_company->delete();
            $user->update(['current_company_id' => $companies[0]]);

            session()->flash('success', 'Company deleted successfully');
            return redirect()->route('dashboard');
        }else{
            $user->update([
                'current_company_id' => null,
                'is_opening_setup_complete' => 0,
                'opening_setup_steps' => 1
            ]);

            return redirect()->intended('/account/setup');
        }
    }

    public function billing(){
        $currently_subscribed = currentCompany()->subscription->load('plan');
        $plans = Plan::with('planFeatures')->get();

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

        return inertia('company/billing', [
            'orders' => $orders,
            'plans' => $plans,
            'filters' => [
                'search' => $search,
                'payment' => $payment,
                'plan' => $plan,
            ],
            'plans' => $plans,
            'currently_subscribed' => $currently_subscribed,
        ]);
    }
}
