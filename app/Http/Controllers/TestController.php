<?php

namespace App\Http\Controllers;

use App\Traits\HasAdmin;
use Illuminate\Http\Request;

class TestController extends Controller
{
    use HasAdmin;

    public function index(){

        return inertia('company/setup/index');
        return view('test.progress');



         // Summary
         $Summary = $this->adminDashboardSummary();

         // Expenses per company
        $expense_per_company = $this->adminExpensePerCompany();

         // Expenses per country
         $companies_per_country = $this->adminCompaniesPerCountry();

         // Yearly earnings
         $yearly_earnings = $this->adminYearlyEarnings();

         // Recent joined companies
        $recent_companies = $this->adminRecentCompanies();

         // Recent purchase orders
         $recent_orders = $this->adminRecentOrders();

         return [
             'summary' => $Summary,
             'expense_per_company' => $expense_per_company,
             'companies_per_country' => $companies_per_country,
             'yearly_earnings' => $yearly_earnings,
             'recent_companies' => $recent_companies,
             'recent_orders' => $recent_orders,
         ];
    }
}
