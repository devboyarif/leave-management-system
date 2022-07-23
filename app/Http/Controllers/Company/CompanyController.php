<?php

namespace App\Http\Controllers\Company;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function plan()
    {
        $plans = Plan::with('planFeatures')->whereStatus(1)->get();

        return inertia('company/plan', [
            'plans' => $plans,
        ]);
    }
}
