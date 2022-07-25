<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Traits\HasAdmin;
use App\Models\LeaveType;
use App\Traits\HasCompany;
use App\Traits\HasEmployee;
use Illuminate\Support\Arr;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use HasAdmin, HasEmployee, HasCompany;

    public function dashboard()
    {
        return inertia('dashboard');
    }

    public function adminDashboard()
    {
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

    public function employeeDashboard()
    {
        $employee = currentEmployee();
        $all_leave_requests = LeaveRequest::where('employee_id', $employee->id)->where('company_id', $employee->company_id)->get();

        // Calendar Events
        $holidays = $this->employeeDashboardHolidays($employee);

        $leaveRequest = $all_leave_requests->load('leaveType', 'employee.user')
            ->where('status', 'approved')
            ->transform(function ($leaveRequest) {
                return [
                    'title' => $leaveRequest->employee->user->name,
                    'end' => $leaveRequest->end,
                    'start' => $leaveRequest->start,
                    'color' => $leaveRequest->leaveType->color,
                ];
            });


        $leave_type_color = LeaveType::where('company_id', $employee->company_id)
            ->get(['name', 'color']);
        $holiday = [['name' => 'Holiday', 'color' => '#ff0000']];

        // Leave Balance
        $leave_balances = $this->employeeDashboardLeaveBalance($employee);

        // Summary
        $summary = $this->employeeDashboardSummary($employee, $all_leave_requests);

        // Pending Leave Request
        $pending_leave_requests = $this->employeeDashboardPendingLeave($all_leave_requests);

        return [
            'events' => Arr::collapse([$holidays, $leaveRequest]),
            'event_types' => Arr::collapse([$holiday, $leave_type_color]),
            'leave_balances' => $leave_balances,
            'summary' => $summary,
            'pending_leave_requests' => $pending_leave_requests,
        ];
    }

    public function companyDashboard()
    {
        $company = currentCompany();
        $all_leave_requests = LeaveRequest::where('company_id', $company->id)->with('leaveType', 'employee.user')->latest()->get();

        // Summary
        $summary = $this->companyDashboardSummary($company, $all_leave_requests);

        // Holidays
        $holidays = $this->companyDashboardHolidays($company);

        // Leave Requests
        $leaveRequest =  $this->companyDashboardAcceptedLeaves($all_leave_requests);

        // Leave type color
        $leave_type_color = LeaveType::where('company_id', $company->id)->get(['name', 'color']);
        $holiday = [['name' => 'Holiday', 'color' => '#ff0000']];

        // Leave pending and recent leaves
        $pending_requests = $this->companyDashboardPendingLeave($all_leave_requests);
        $recent_approved_requests = $this->companyDashboardApprovedLeave($all_leave_requests);

        // Current Subscribed Plan
        $subscribed_plan = $this->companyDashboardSubscribedPlan($company);

        return [
            'summary' => $summary,
            'events' => Arr::collapse([$holidays, $leaveRequest]),
            'event_types' => Arr::collapse([$holiday, $leave_type_color]),
            'pending_requests' => $pending_requests,
            'recent_approved_requests' => $recent_approved_requests,
            'subscribed_plan' => $subscribed_plan,
        ];
    }
}
