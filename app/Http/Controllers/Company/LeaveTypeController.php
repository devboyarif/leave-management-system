<?php

namespace App\Http\Controllers\Company;

use App\Models\LeaveType;
use App\Models\LeaveBalance;
use Illuminate\Http\Request;
use App\Traits\HasSubscription;
use App\Http\Controllers\Controller;
use App\Traits\Employee\HasLeaveBalance;

class LeaveTypeController extends Controller
{
    use HasSubscription, HasLeaveBalance;

    public function index()
    {
        $leave_types = LeaveType::where('company_id', currentCompany()->id)->latest()->paginate(10);

        return inertia('company/leaveType/index', [
            'leave_types' => $leave_types,
        ]);
    }

    public function create()
    {
        return inertia('company/leaveType/create');
    }

    public function store(Request $request)
    {
        // Check if the user is limited to create employees
        if ($this->checkLeaveTypeLimitation()) {
            session()->flash('error', __("You have reached the maximum number of leave types"));
            return back();
        }

        $request->validate(['name' => 'required|string|max:255']);

        $company = currentCompany();

        $leave_type = $company->leaveTypes()->create([
            'name' => $request->name,
            'color' => $request->color,
            'balance' => $request->balance,
            'auto_approve' => $request->auto_approve ? 1 : 0,
            'status' => $request->status ? 1 : 0,
        ]);

        // Create leave balance for the employee
        $this->attachLeaveTypeToAllEmployees($company, $leave_type);

        session()->flash('success', 'Leave type created successfully!');
        return redirect_to('company.leaveTypes.index');
    }

    public function edit(LeaveType $leaveType)
    {
        $leaveType->load('company');

        return inertia('company/leaveType/edit', [
            'leaveType' => $leaveType,
        ]);
    }

    public function update(Request $request, LeaveType $leaveType)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $is_changed_leave_balance = $leaveType->balance != $request->balance;

        $leaveType->update([
            'name' => $request->name,
            'color' => $request->color,
            'balance' => $request->balance,
            'auto_approve' => $request->auto_approve ? 1 : 0,
            'status' => $request->status ? 1 : 0,
        ]);

        // Update leave balance for the employee
        if ($is_changed_leave_balance) {
            $leaveType->leaveBalances()->update([
                'total_days' => $request->balance,
            ]);
        }

        session()->flash('success', 'Leave type updated successfully!');
        return redirect_to('company.leaveTypes.index');
    }

    public function destroy(LeaveType $leaveType)
    {
        $leaveType->delete();

        session()->flash('success', 'Leave type deleted successfully!');
        return redirect_to('company.leaveTypes.index');
    }

    public function leaveTypeBalance(Request $request)
    {
        $leave_balance = LeaveBalance::where('employee_id', $request->employee_id)
            ->where('leave_type_id', $request->leave_type_id)
            ->first();

        return $leave_balance;
    }
}
