<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function orders()
    {
        $orders = Order::with('company.user', 'plan.planFeatures')->latest()->paginate(10);

        return inertia('admin/order/index', [
            'orders' => $orders,
        ]);
    }
}
