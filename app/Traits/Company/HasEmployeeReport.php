<?php

namespace App\Traits\Company;

use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\Team;

trait HasEmployeeReport
{
    public function getEmployeeLeaveBalance()
    {

        $leave_types = currentCompany()->leaveTypes;
        $employees = Employee::where('company_id', currentCompany()->id)
        ->with('user:id,name,avatar','leaveBalances')
        ->get();

        return [
            'leave_types' => $leave_types,
            'employees' => $employees,
        ];
    }

    public function getTeamLeaveBalance()
    {
        $leave_types = currentCompany()->leaveTypes;
        $team_employees = Employee::where('company_id', currentCompany()->id)
        ->with('team:id,name','user:id,name,avatar','leaveBalances')
        ->get()
        ->groupBy('team_id');

        return [
            'team_employees' => $team_employees,
            'leave_types' => $leave_types,
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
                return $leaveRequest->companyEmployeeReport($company_id,$employee_id)->thisWeek()->get();
                break;
            case 'last_week':
                return $leaveRequest->companyEmployeeReport($company_id,$employee_id)->lastWeek()->get();
                break;
            case 'this_month':
                return $leaveRequest->companyEmployeeReport($company_id,$employee_id)->thisMonth()->get();
                break;
            case 'last_month':
                return $leaveRequest->companyEmployeeReport($company_id,$employee_id)->lastMonth()->get();
                break;
            case 'last_6_month':
                return $leaveRequest->companyEmployeeReport($company_id,$employee_id)->last6Month()->get();
                break;
            case 'this_year':
                return $leaveRequest->companyEmployeeReport($company_id,$employee_id)->thisYear()->get();
                break;
            case 'last_year':
                return $leaveRequest->companyEmployeeReport($company_id,$employee_id)->lastYear()->get();
                break;
            case 'custom_date':
                $request->validate([
                    'custom_date' => 'required',
                ]);

                return $leaveRequest->companyEmployeeReport($company_id,$employee_id)->customDate($request->custom_date)->get();
                break;
            case 'custom_range_date':
                $request->validate([
                    'custom_start_date' => 'required',
                    'custom_end_date' => 'required',
                ]);

                return $leaveRequest->companyEmployeeReport($company_id,$employee_id)
                ->customRangeDate($request->custom_start_date, $request->custom_end_date)->get();
                break;
        }
    }

    public function getTeamLeaveHistory()
    {
        $company_id = currentCompany()->id;
        $teams = Team::where('company_id', $company_id)
        ->get(['id','name']);

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
                return $leaveRequest->companyTeamReport($company_id,$team_id)->thisWeek()->get();
                break;
            case 'last_week':
                return $leaveRequest->companyTeamReport($company_id,$team_id)->lastWeek()->get();
                break;
            case 'this_month':
                return $leaveRequest->companyTeamReport($company_id,$team_id)->thisMonth()->get();
                break;
            case 'last_month':
                return $leaveRequest->companyTeamReport($company_id,$team_id)->lastMonth()->get();
                break;
            case 'last_6_month':
                return $leaveRequest->companyTeamReport($company_id,$team_id)->last6Month()->get();
                break;
            case 'this_year':
                return $leaveRequest->companyTeamReport($company_id,$team_id)->thisYear()->get();
                break;
            case 'last_year':
                return $leaveRequest->companyTeamReport($company_id,$team_id)->lastYear()->get();
                break;
            case 'custom_date':
                $request->validate([
                    'custom_date' => 'required',
                ]);

                return $leaveRequest->companyTeamReport($company_id,$team_id)->customDate($request->custom_date)->get();
                break;
            case 'custom_range_date':
                $request->validate([
                    'custom_start_date' => 'required',
                    'custom_end_date' => 'required',
                ]);

                return $leaveRequest->companyTeamReport($company_id,$team_id)->customRangeDate($request->custom_start_date, $request->custom_end_date)->get();
                break;
        }
    }
}
