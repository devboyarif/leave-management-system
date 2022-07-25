<?php

namespace App\Http\Controllers\Company;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;

class CompanyController extends Controller
{
    public function orders()
    {
        $orders = Order::whereCompanyId(currentCompany()->id)->with('plan.planFeatures')->latest()->paginate(10);

        return inertia('company/order/index', [
            'orders' => $orders,
        ]);
    }

    public function plan()
    {
        $plans = Plan::with('planFeatures')->whereStatus(1)->get();

        return inertia('company/plan', [
            'plans' => $plans,
        ]);
    }
}
