<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Company;
use App\Models\Country;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('search') ?? '';
        $country = request('country') ?? '';

        $companies = Company::with('country')
        ->where(function ($query) use ($search) {
            $query->where('company_name', 'LIKE', '%' . $search . '%')
                ->orWhere('company_email', 'LIKE', '%' . $search . '%');
        })
        ->when($country, function ($query, $country) {
            $query->where('country_id', $country);
        })
        ->latest()
        ->paginate(10)
        ->withQueryString()
        // ->get()
        ->through(fn ($company) => [
            'id' => $company->id,
            'name' => $search ? preg_replace('/(' . $search . ')/i', "<b class='bg-warning'>$1</b>", $company->company_name) : $company->company_name,
            'email' => $search ? preg_replace('/(' . $search . ')/i', "<b class='bg-warning'>$1</b>", $company->company_email) : $company->company_email,
            'avatar' => $company->company_logo,
            'country' => $company->country->name ?? '',
        ]);

        $countries = Country::all(['id', 'name', 'slug']);

        return inertia('admin/company/index', [
            'companies' => $companies,
            'countries' => $countries,
            'filters' => [
                'search' => $search,
                'country' => $country ?? '',
            ],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $company->load('country:id,name');

        // Working days
        $working_days = $company->workingDays;

        // Company summary
        $leave_requests = $company->leaveRequests;
        $summary = [
            'total_expense' => currencyConversion(Order::where('company_id', $company->id)->sum('usd_amount'), 'USD', $company->currency) ?? 0,
            'total_teams' => $company->teams()->count(),
            'total_employees' => $company->employees()->count(),
            'total_holidays' => $company->holidays()->count(),
            'total_leave_types' => $company->leaveTypes()->count(),
            'total_rejected_leave_requests' => $leave_requests->where('status','rejected')->count(),
            'total_pending_leave_requests' => $leave_requests->where('status','pending')->count(),
            'total_approved_leave_requests' => $leave_requests->where('status','approved')->count(),
        ];

        // Currently Subscription
       $subscribed_plan = $company->subscription->load('plan.planFeatures');

        return inertia('admin/company/show', [
            'user' => $company,
            'working_days' => $working_days,
            'summary' => $summary,
            'subscribed_plan' => $subscribed_plan,
        ]);
    }

    public function companiesTeams(Company $company)
    {
        $teams = $company->teams;

        return response()->json([
            'success' => true,
            'teams' => $teams,
        ]);
    }

    public function companiesLeaveTypes(User $user)
    {
        $leaveTypes = $user->company->leaveTypes;

        return response()->json([
            'success' => true,
            'leaveTypes' => $leaveTypes,
        ]);
    }

    public function companiesEmployees(User $user)
    {
        $employeesUsers = $user->company->employees->load('user');

        return response()->json([
            'success' => true,
            'employeesUsers' => $employeesUsers,
        ]);
    }

    public function companiesWiseEmployees(Company $company)
    {
        $employees = $company->employees->load('user:id,name');

        return response()->json([
            'success' => true,
            'employees' => $employees,
        ]);
    }
}
