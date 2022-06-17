<?php

namespace App\Traits;

use App\Models\Holiday;
use Illuminate\Http\Request;

trait HasEmployee
{
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
}
