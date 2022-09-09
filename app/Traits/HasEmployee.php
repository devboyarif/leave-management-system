<?php

namespace App\Traits;

use App\Models\Holiday;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

trait HasEmployee
{
    function employeeDashboardSummary($employee,  $all_leave_requests)
    {
        $company = $employee->company;
        $approved_leave_request =  $all_leave_requests->where('status', 'approved')->count();
        $pending_leave_request =  $all_leave_requests->where('status', 'pending')->count();
        $total_leave_types = $company->leaveTypes->count();

        return [
            'total_leaves' => $all_leave_requests->count(),
            'total_pending_leaves' => $pending_leave_request,
            'total_approved_leaves' => $approved_leave_request,
            'total_leave_types' => $total_leave_types,
        ];
    }

    function employeeDashboardHolidays($employee)
    {
        return Holiday::where('company_id', $employee->company_id)
            ->get()
            ->transform(function ($holiday) {
                return [
                    'title' => $holiday->title,
                    'start' => $holiday->start,
                    'end' => $holiday->end,
                    'color' => $holiday->color,
                ];
            });
    }

    function employeeDashboardLeaveBalance($employee)
    {
        return $employee->leaveBalances->load('leaveType:id,name')->transform(function ($leaveBalance) {
            $total_days = $leaveBalance->total_days;
            $used_days = $leaveBalance->used_days;
            $remaining_days = $leaveBalance->remaining_days;

            return [
                'title' => $leaveBalance->leaveType->name,
                'total_days' => $total_days,
                'used_days' => $used_days,
                'remaining_days' => $remaining_days,
                'user_percentage' => round(($used_days / $total_days) * 100),
                'remaining_percentage' => round(($remaining_days / $total_days) * 100),
            ];
        });
    }

    public function employeeDashboardPendingLeave($all_leave_requests)
    {
        return $all_leave_requests->where('status', 'pending')->load('leaveType')->transform(function ($leaveRequest) {
            return [
                'id' => $leaveRequest->id,
                'name' => $leaveRequest->leaveType->name,
                'start' => formatTime($leaveRequest->start, 'D d M'),
                'end' => formatTime($leaveRequest->end, 'D d M'),
                'days' => $leaveRequest->days,
                'status' => $leaveRequest->status,
                'color' => $leaveRequest->leaveType->color,
            ];
        });
    }
}
