<?php

namespace App\Traits;

use App\Models\Team;
use App\Models\Order;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Holiday;

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
}
