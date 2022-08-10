<?php

namespace App\Http\Controllers\Company;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use App\Traits\Company\HasEmployeeReport;

class ReportController extends Controller
{
    use HasEmployeeReport;

    public function index(){
        return inertia('company/reports/index');
    }

    public function employeeLeaveBalance(){
        $data = $this->getEmployeeLeaveBalance();

        return inertia('company/reports/employeeLeaveBalance', $data);
    }

    public function employeeLeaveHistory(){
        $data = $this->getEmployeeLeaveHistory();

        return inertia('company/reports/employeeLeaveHistory',$data);
    }

    public function employeeLeaveHistoryReport(Request $request){
       return $this->getEmployeeLeaveHistoryReport($request);
    }

    public function teamLeaveBalance(){
        $data = $this->getTeamLeaveBalance();

        return inertia('company/reports/teamLeaveBalance', $data);
    }

    public function teamLeaveHistory(){
        $data = $this->getTeamLeaveHistory();

        return inertia('company/reports/teamLeaveHistory', $data);
    }

    public function teamLeaveHistoryReport(Request $request){
       return $this->getTeamLeaveHistoryReport($request);
    }
}
