<?php

namespace App\Traits\Employee;

use App\Models\Company;
use App\Models\LeaveBalance;

trait HasLeaveBalance
{
    public function employeeLeaveBalanceCreate($company_id, $employee_id)
    {
        $company = Company::find($company_id);
        $leave_types = $company->leaveTypes;

        foreach ($leave_types as $leave_type) {
            LeaveBalance::create([
                'employee_id' => $employee_id,
                'leave_type_id' => $leave_type->id,
                'total_days' => $leave_type->balance,
                'used_days' => 0,
            ]);
        }

        return true;
    }

    public function attachLeaveTypeToAllEmployees($company, $leave_type)
    {
        $employees = $company->employees;

        foreach ($employees as $employee) {
            LeaveBalance::create([
                'employee_id' => $employee->id,
                'leave_type_id' => $leave_type->id,
                'total_days' => $leave_type->balance,
                'used_days' => 0,
            ]);
        }

        return true;
    }
}
