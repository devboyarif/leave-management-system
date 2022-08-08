<?php

namespace App\Traits\Company;

use App\Models\Employee;

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
}
