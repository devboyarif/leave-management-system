<?php

namespace App\Traits;

use App\Models\Team;
use App\Models\Order;
use App\Models\Company;
use App\Models\Country;
use App\Models\Holiday;
use App\Models\Employee;

trait HasAdmin
{
    public function adminDashboardSummary()
    {
        $total_income = currencyConversion(Order::sum('usd_amount'), 'USD', config('kodebazar.currency'));
        $total_companies = Company::count();
        $total_teams = Team::count();
        $total_employees = Employee::count();

        return [
            'total_income' => $total_income,
            'total_companies' => $total_companies,
            'total_teams' => $total_teams,
            'total_employees' => $total_employees,
            'currency_symbol' => config('kodebazar.currency_symbol'),
        ];
    }

    public function adminExpensePerCompany()
    {
        $expense_per_company = Company::select('id','user_id')
        ->with('user:id,name')
        ->withSum('orders as expense_amount','usd_amount')
        ->latest('expense_amount')
        ->limit(5)
        ->get()
        ->transform(fn($item) => [
            'id' => $item->id,
            'name' => $item->user->name,
            'usd_amount' => $item->expense_amount,
            'amount' => currencyConversion($item->expense_amount, 'USD', config('kodebazar.currency')),
        ]);

        $amount = $expense_per_company->pluck('amount')->toArray();
        $company = $expense_per_company->pluck('name')->toArray();

        return [
            'companies_amount' => $expense_per_company,
            'amounts' => $amount,
            'companies' => $company,
        ];
    }

    public function adminCompaniesPerCountry()
    {
        $companies_per_country = Country::select('id','name')
        ->withCount('companies')
        ->latest('companies_count')
        ->limit(5)
        ->get();

        $countries = $companies_per_country->pluck('name')->toArray();
        $percentage = $companies_per_country->pluck('companies_count')->toArray();

        return [
            'companies_per_country' => $companies_per_country,
            'countries' => $countries,
            'percentage' => $percentage,
        ];
    }

    public function adminYearlyEarnings()
    {
        $months = Order::select(
            \DB::raw('MIN(created_at) AS created_at'),
            \DB::raw('sum(usd_amount) as `amount`'),
            \DB::raw("DATE_FORMAT(created_at,'%M') as month")
        )
            ->where("created_at", ">", \Carbon\Carbon::now()->startOfYear())
            ->orderBy('created_at')
            ->groupBy('month')
            ->get();

        $amountArray = [];
        $monthArray = [];

        foreach ($months as $value) {
            array_push($amountArray, currencyConversion($value->amount, 'USD', config('kodebazar.currency')));
            array_push($monthArray, $value->month);
        }

        return ['amount' => $amountArray, 'months' => $monthArray];
    }
}
