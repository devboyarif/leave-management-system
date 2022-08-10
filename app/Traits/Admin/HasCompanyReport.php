<?php

namespace App\Traits\Admin;

use App\Models\Company;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\Team;

trait HasCompanyReport
{
    public function getEmployeeLeaveBalance($request)
    {
        $companies = Company::with('user:id,name')->get(['id', 'user_id']);

        if ($request->has('company') && $request->company != null) {
            $company = Company::find($request->company);

            if ($company) {
                $leave_types = $company->leaveTypes;
                $employees = Employee::where('company_id', $company->id)
                    ->with('user:id,name,avatar', 'leaveBalances')
                    ->get();
            }
        }

        return [
            'leave_types' => $leave_types ?? [],
            'employees' => $employees ?? [],
            'companies' => $companies,
            'filter_company' => $request->company ?? '',
        ];
    }

    public function getTeamLeaveBalance($request)
    {
        $companies = Company::with('user:id,name')->get(['id', 'user_id']);

        if ($request->has('company') && $request->company != null) {
            $company = Company::find($request->company);

            if ($company) {
                $leave_types = $company->leaveTypes;
                $team_employees = Employee::where('company_id', $company->id)
                    ->with('team:id,name', 'user:id,name,avatar', 'leaveBalances')
                    ->get()
                    ->groupBy('team_id');
            }
        }

        return [
            'team_employees' => $team_employees ?? [],
            'leave_types' => $leave_types ?? [],
            'companies' => $companies,
            'filter_company' => $request->company ?? '',

        ];
    }

    public function getEmployeeLeaveHistory()
    {
        $company_id = currentCompany()->id;
        $employees = Employee::where('company_id', $company_id)
            ->with('user:id,name,avatar')
            ->get();

        return [
            'employees' => $employees,
        ];
    }

    public function getEmployeeLeaveHistoryReport($request)
    {
        $leaveRequest = new LeaveRequest();
        $company_id = currentCompany()->id;
        $employee_id = $request->employee;

        $request->validate([
            'employee' => 'required',
            'date_type' => 'required',
        ]);

        switch ($request->date_type) {
            case 'this_week':
                return $leaveRequest->companyEmployeeReport($company_id, $employee_id)->thisWeek()->latest()->get();
                break;
            case 'last_week':
                return $leaveRequest->companyEmployeeReport($company_id, $employee_id)->lastWeek()->latest()->get();
                break;
            case 'this_month':
                return $leaveRequest->companyEmployeeReport($company_id, $employee_id)->thisMonth()->latest()->get();
                break;
            case 'last_month':
                return $leaveRequest->companyEmployeeReport($company_id, $employee_id)->lastMonth()->latest()->get();
                break;
            case 'last_6_month':
                return $leaveRequest->companyEmployeeReport($company_id, $employee_id)->last6Month()->latest()->get();
                break;
            case 'this_year':
                return $leaveRequest->companyEmployeeReport($company_id, $employee_id)->thisYear()->latest()->get();
                break;
            case 'last_year':
                return $leaveRequest->companyEmployeeReport($company_id, $employee_id)->lastYear()->latest()->get();
                break;
            case 'custom_date':
                $request->validate([
                    'custom_date' => 'required',
                ]);

                return $leaveRequest->companyEmployeeReport($company_id, $employee_id)->customDate($request->custom_date)->latest()->get();
                break;
            case 'custom_range_date':
                $request->validate([
                    'custom_start_date' => 'required',
                    'custom_end_date' => 'required',
                ]);

                return $leaveRequest->companyEmployeeReport($company_id, $employee_id)
                    ->customRangeDate($request->custom_start_date, $request->custom_end_date)->latest()->get();
                break;
        }
    }

    public function getTeamLeaveHistory()
    {
        $company_id = currentCompany()->id;
        $teams = Team::where('company_id', $company_id)
            ->get(['id', 'name']);

        return [
            'teams' => $teams,
        ];
    }

    public function getTeamLeaveHistoryReport($request)
    {
        $leaveRequest = new LeaveRequest();
        $company_id = currentCompany()->id;
        $team_id = $request->team;

        $request->validate([
            'team' => 'required',
            'date_type' => 'required',
        ]);

        switch ($request->date_type) {
            case 'this_week':
                return $leaveRequest->companyTeamReport($company_id, $team_id)->thisWeek()->latest()->get();
                break;
            case 'last_week':
                return $leaveRequest->companyTeamReport($company_id, $team_id)->lastWeek()->latest()->get();
                break;
            case 'this_month':
                return $leaveRequest->companyTeamReport($company_id, $team_id)->thisMonth()->latest()->get();
                break;
            case 'last_month':
                return $leaveRequest->companyTeamReport($company_id, $team_id)->lastMonth()->latest()->get();
                break;
            case 'last_6_month':
                return $leaveRequest->companyTeamReport($company_id, $team_id)->last6Month()->latest()->get();
                break;
            case 'this_year':
                return $leaveRequest->companyTeamReport($company_id, $team_id)->thisYear()->latest()->get();
                break;
            case 'last_year':
                return $leaveRequest->companyTeamReport($company_id, $team_id)->lastYear()->latest()->get();
                break;
            case 'custom_date':
                $request->validate([
                    'custom_date' => 'required',
                ]);

                return $leaveRequest->companyTeamReport($company_id, $team_id)->customDate($request->custom_date)->latest()->get();
                break;
            case 'custom_range_date':
                $request->validate([
                    'custom_start_date' => 'required',
                    'custom_end_date' => 'required',
                ]);

                return $leaveRequest->companyTeamReport($company_id, $team_id)->customRangeDate($request->custom_start_date, $request->custom_end_date)->latest()->get();
                break;
        }
    }
}
