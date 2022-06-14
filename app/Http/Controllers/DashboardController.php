<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\LeaveType;
use Illuminate\Support\Arr;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
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

        $holidays = Holiday::where('company_id', $employee->company_id)
            ->get()
            ->transform(function ($holiday) {
                return [
                    'title' => $holiday->title,
                    'start' => $holiday->start,
                    'end' => $holiday->end,
                    'color' => $holiday->color,
                ];
            });

        $leaveRequest = LeaveRequest::with('leaveType', 'employee.user')
            ->where('company_id', $employee->company_id)
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

        $leave_type_color = LeaveType::where('company_id', $employee->company_id)
            ->get(['name', 'color']);
        $holiday = [['name' => 'Holiday', 'color' => '#ff0000']];

        return [
            'events' => Arr::collapse([$holidays, $leaveRequest]),
            'event_types' => Arr::collapse([$holiday, $leave_type_color]),
        ];
    }

    public function companyDashboard()
    {
        $company = currentCompany();

        $holidays = Holiday::where('company_id', $company->id)
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

        $leaveRequest = LeaveRequest::with('leaveType', 'employee.user')
            ->where('company_id', $company->id)
            ->where('status', 'approved')
            ->get()
            ->transform(function ($leaveRequest) {
                return [
                    'title' => $leaveRequest->employee->user->name,
                    'end' => $leaveRequest->end,
                    'start' => $leaveRequest->start,
                    'color' => $leaveRequest->leaveType->color,
                    'description' => $leaveRequest->title,
                ];
            });

        $leave_type_color = LeaveType::where('company_id', $company->id)
            ->get(['name', 'color']);
        $holiday = [['name' => 'Holiday', 'color' => '#ff0000']];

        return [
            'events' => Arr::collapse([$holidays, $leaveRequest]),
            'event_types' => Arr::collapse([$holiday, $leave_type_color]),
        ];
    }
}
