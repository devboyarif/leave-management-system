<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Admin\HasCompanyReport;

class ReportController extends Controller
{
    use HasCompanyReport;

    public function index()
    {
        return inertia('admin/reports/index');
    }

    public function employeeLeaveBalance(Request $request)
    {
        $data = $this->getEmployeeLeaveBalance($request);

        return inertia('admin/reports/employeeLeaveBalance', $data);
    }

    public function employeeLeaveHistory()
    {
        $data = $this->getEmployeeLeaveHistory();

        return inertia('admin/reports/employeeLeaveHistory', $data);
    }

    public function employeeLeaveHistoryReport(Request $request)
    {
        return $this->getEmployeeLeaveHistoryReport($request);
    }

    public function teamLeaveBalance()
    {
        $data = $this->getTeamLeaveBalance();

        return inertia('admin/reports/teamLeaveBalance', $data);
    }

    public function teamLeaveHistory()
    {
        $data = $this->getTeamLeaveHistory();

        return inertia('admin/reports/teamLeaveHistory', $data);
    }

    public function teamLeaveHistoryReport(Request $request)
    {
        return $this->getTeamLeaveHistoryReport($request);
    }
}
