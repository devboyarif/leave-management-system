<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\LeaveType;
use App\Traits\HasCompany;
use App\Traits\HasEmployee;
use Illuminate\Support\Arr;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use HasEmployee, HasCompany;

    public function dashboard()
    {
        return inertia('dashboard');
    }

    public function adminDashboard()
    {
        $holidays = Holiday::get()
            ->transform(function ($holiday) {
                return [
                    'title' => $holiday->title,
                    'start' => $holiday->start,
                    'end' => $holiday->end,
                    'color' => $holiday->color,
                ];
            });

        $leaveRequest = LeaveRequest::with('leaveType', 'employee.user')
            ->where('status', 'approved')
            ->get()
            ->transform(function ($leaveRequest) {
                return [
                    'title' => $leaveRequest->employee->user->name,
                    'end' => $leaveRequest->end,
                    'start' => $leaveRequest->start,
                    'color' => $leaveRequest->leaveType->color,
                ];
            });

        return [
            'events' => Arr::collapse([$holidays, $leaveRequest]),
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

        // Summery
        $summery = $this->employeeDashboardSummery($employee, $all_leave_requests);

        // Pending Leave Request
        $pending_leave_requests = $this->employeeDashboardPendingLeave($all_leave_requests);

        return [
            'events' => Arr::collapse([$holidays, $leaveRequest]),
            'event_types' => Arr::collapse([$holiday, $leave_type_color]),
            'leave_balances' => $leave_balances,
            'summery' => $summery,
            'pending_leave_requests' => $pending_leave_requests,
        ];
    }

    public function companyDashboard()
    {
        $company = currentCompany();
        $all_leave_requests = LeaveRequest::where('company_id', $company->id)->with('leaveType', 'employee.user')->latest()->get();

        // Summery
        $summery = $this->companyDashboardSummery($company, $all_leave_requests);

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

        return [
            'summery' => $summery,
            'events' => Arr::collapse([$holidays, $leaveRequest]),
            'event_types' => Arr::collapse([$holiday, $leave_type_color]),
            'pending_requests' => $pending_requests,
            'recent_approved_requests' => $recent_approved_requests,
        ];
    }
}
