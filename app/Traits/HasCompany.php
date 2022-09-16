<?php

namespace App\Traits;

use App\Models\Holiday;
use App\Models\Order;

trait HasCompany
{
    function companyDashboardHolidays($company)
    {
        Holiday::where('company_id', $company->id)
            ->get()
            ->transform(function ($holiday) {
                return [
                    'title' => $holiday->title,
                    'start' => $holiday->start,
                    'end' => $holiday->end,
                    'color' => $holiday->color,
                    'description' => $holiday->title,
                ];
            });
    }

    function companyDashboardAcceptedLeaves($all_leave_requests)
    {
        return $all_leave_requests->where('status', 'approved')
            ->transform(function ($leaveRequest) {
                return [
                    'title' => $leaveRequest->employee->user->name,
                    'user_id' => $leaveRequest->employee->user_id,
                    'end' => $leaveRequest->end,
                    'start' => $leaveRequest->start,
                    'color' => $leaveRequest->leaveType->color,
                    'description' => $leaveRequest->title,
                ];
            });
    }

    function companyDashboardPendingLeave($all_leave_requests)
    {
        return $all_leave_requests->where('status', 'pending')
            ->transform(function ($leaveRequest) {
                return [
                    'id' => $leaveRequest->id,
                    'user_id' => $leaveRequest->employee->user_id,
                    'title' => $leaveRequest->employee->user->name,
                    'type' => $leaveRequest->leaveType->name,
                    'start' => $leaveRequest->start,
                    'end' => $leaveRequest->end,
                    'days' => diffBetweenDays($leaveRequest->start, $leaveRequest->end),
                    'color' => $leaveRequest->leaveType->color,
                    'status' => $leaveRequest->status,
                    'reason' => $leaveRequest->reason,
                ];
            });
    }

    function companyDashboardApprovedLeave($all_leave_requests)
    {
        return $all_leave_requests->where('status', 'approved')
            ->transform(function ($leaveRequest) {
                return [
                    'title' => $leaveRequest->employee->user->name,
                    'user_id' => $leaveRequest->employee->user_id,
                    'type' => $leaveRequest->leaveType->name,
                    'start' => $leaveRequest->start,
                    'end' => $leaveRequest->end,
                    'days' => diffBetweenDays($leaveRequest->start, $leaveRequest->end),
                    'color' => $leaveRequest->leaveType->color,
                    'status' => $leaveRequest->status,
                    'reason' => $leaveRequest->reason,
                ];
            })->take(5);
    }

    public function companyDashboardSummary($company, $all_leave_requests)
    {
        $total_expense =  currencyConversion(Order::where('company_id', currentCompany()->id)->sum('usd_amount'), 'USD', currentCompany()->currency);
        $pending_leave_request =  $all_leave_requests->where('status', 'pending')->count();
        $approve_leave_request =  $all_leave_requests->where('status', 'approved')->count();
        $total_teams = $company->teams->count();
        $total_employees = $company->employees->count();

        return [
            'total_expense' => $total_expense,
            'total_pending_leaves' => $pending_leave_request,
            'total_approve_leaves' => $approve_leave_request,
            'total_teams' => $total_teams,
            'total_employees' => $total_employees,
        ];
    }

    public function companyDashboardSubscribedPlan()
    {
        return currentCompany()->subscription->load('plan.planFeatures');
    }
}
