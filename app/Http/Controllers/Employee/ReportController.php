<?php

namespace App\Http\Controllers\Employee;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index(){
        return inertia('employee/reports');
    }

    public function details(Request $request){
        $leaveRequest = new LeaveRequest();
        $employee_id = currentEmployee()->id;

        $request->validate([
            'date_type' => 'required',
        ]);

        switch ($request->date_type) {
            case 'this_week':
                return $leaveRequest->employeeReport($employee_id)->thisWeek()->get();
                break;
            case 'last_week':
                return $leaveRequest->employeeReport($employee_id)->lastWeek()->get();
                break;
            case 'this_month':
                return $leaveRequest->employeeReport($employee_id)->thisMonth()->get();
                break;
            case 'last_month':
                return $leaveRequest->employeeReport($employee_id)->lastMonth()->get();
                break;
            case 'last_6_month':
                return $leaveRequest->employeeReport($employee_id)->last6Month()->get();
                break;
            case 'this_year':
                return $leaveRequest->employeeReport($employee_id)->thisYear()->get();
                break;
            case 'last_year':
                return $leaveRequest->employeeReport($employee_id)->lastYear()->get();
                break;
            case 'custom_date':
                $request->validate([
                    'custom_date' => 'required',
                ]);

                return $leaveRequest->employeeReport($employee_id)->customDate($request->custom_date)->get();
                break;
            case 'custom_range_date':
                $request->validate([
                    'custom_start_date' => 'required',
                    'custom_end_date' => 'required',
                ]);

                return $leaveRequest->employeeReport($employee_id)
                ->customRangeDate($request->custom_start_date, $request->custom_end_date)->get();
                break;
        }
    }
}
