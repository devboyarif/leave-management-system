<?php

namespace App\Http\Controllers\Company;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Company\HasEmployeeReport;

class ReportController extends Controller
{
    use HasEmployeeReport;

    public function index(){
        return  inertia('company/reports/index');
    }

    public function employeeLeaveBalance(){
        $data = $this->getEmployeeLeaveBalance();

        return inertia('company/reports/employeeLeaveBalance', $data);
    }

    public function employeeLeaveHistory(){
        return inertia('company/reports/employeeLeaveHistory');
    }

    public function teamLeaveBalance(){
        return inertia('company/reports/teamLeaveBalance');
    }

    public function teamLeaveHistory(){
        return inertia('company/reports/teamLeaveHistory');
    }
}
