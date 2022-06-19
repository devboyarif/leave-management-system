<?php

namespace App\Traits;

use App\Models\Holiday;

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
}
