<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Company;
use App\Models\LeaveType;
use App\Models\LeaveBalance;
use Illuminate\Http\Request;
use App\Traits\HasSubscription;
use App\Http\Controllers\Controller;
use App\Traits\Employee\HasLeaveBalance;
use App\Http\Requests\LeaveTypeSaveRequest;

class LeaveTypeController extends Controller
{
    use HasSubscription, HasLeaveBalance;

    public function index()
    {
        $leave_query = LeaveType::query();

        if (request('company')) {
            $leave_query->where('company_id', request('company'));
        }

        $leave_types = $leave_query->latest()->paginate(10);

        $companies = Company::with('user:id,name')->get();

        return inertia('admin/leaveType/index', [
            'leave_types' => $leave_types,
            'companies' => $companies,
            'filters' => request()->only('company'),
        ]);
    }

    public function create()
    {
        $users = User::roleCompany()->get();

        return inertia('admin/leaveType/create', [
            'users' => $users,
        ]);
    }

    public function store(LeaveTypeSaveRequest $request)
    {
        $company = Company::where('user_id', $request->user_id)->firstOrFail();

        // Check if the user is limited to create employees
        if ($this->checkLeaveTypeLimitation($company)) {
            session()->flash('error', __("You have reached the maximum number of leave types"));
            return back();
        }

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
        return redirect_to('leaveTypes.index');
    }

    public function edit(LeaveType $leaveType)
    {
        $users = User::roleCompany()->get();
        $leaveType->load('company');

        return inertia('admin/leaveType/edit', [
            'users' => $users,
            'leaveType' => $leaveType,
        ]);
    }

    public function update(LeaveTypeSaveRequest $request, LeaveType $leaveType)
    {
        $company = Company::where('user_id', $request->user_id)->firstOrFail();

        $company->leaveTypes()->update([
            'name' => $request->name,
            'color' => $request->color,
            'balance' => $request->balance,
            'auto_approve' => $request->auto_approve ? 1 : 0,
            'status' => $request->status ? 1 : 0,
        ]);

        session()->flash('success', 'Leave type updated successfully!');
        return redirect_to('leaveTypes.index');
    }

    public function destroy(LeaveType $leaveType)
    {
        $leaveType->delete();

        session()->flash('success', 'Leave type deleted successfully!');
        return redirect_to('leaveTypes.index');
    }

    public function leaveTypeBalance(Request $request)
    {
        $leave_balance = LeaveBalance::where('employee_id', $request->employee_id)
            ->where('leave_type_id', $request->leave_type_id)
            ->first();

        return $leave_balance;
    }
}
