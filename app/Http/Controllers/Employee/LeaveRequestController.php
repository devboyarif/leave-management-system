<?php

namespace App\Http\Controllers\Employee;

use App\Models\LeaveType;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LeaveBalance;
use App\Notifications\Company\NewLeaveRequest;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $status = request('status') ?? '';
        $leave_type = request('leave_type') ?? '';

        $employee = currentEmployee();

        $leave_requests = LeaveRequest::with(['employee.user', 'employee.team', 'company.user', 'leaveType'])
            ->where('employee_id', $employee->id)
            ->where('company_id', $employee->company_id)
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($leave_type, function ($query, $leave_type) {
                $query->where('leave_type_id', $leave_type);
            })
            ->latest()
            ->paginate(10);

        $leave_types = LeaveType::where('company_id', $employee->company_id)->get(['id', 'name']);

        return inertia('employee/leaveRequest/index', [
            'leaveRequests' => $leave_requests ?? [],
            'leaveTypes' => $leave_types ?? [],
            'filters' => [
                'status' => $status ?? '',
                'leave_type' => $leave_type ?? '',
            ],
        ]);
    }

    public function create()
    {
        $employee = currentEmployee();
        $leaveTypes = LeaveType::where('company_id', $employee->company_id)->get();
        $leaveTypeBalances = LeaveBalance::with('leaveType')->where('employee_id', $employee->id)->get();

        return inertia('employee/leaveRequest/create', [
            'leaveTypes' => $leaveTypes,
            'leaveTypeBalances' => $leaveTypeBalances,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'start' => 'required',
            'end' => 'required',
            'leave_type_id' => 'required',
            'reason' => 'required',
        ], [
            'leave_type_id.required' => 'Leave type is required',
        ]);

        $employee = currentEmployee();

        LeaveRequest::create([
            'company_id' => $employee->company_id,
            'employee_id' => $employee->id,
            'leave_type_id' => $request->leave_type_id,
            'start' => $request->start,
            'end' => $request->end,
            'days' => diffBetweenDays($request->start, $request->end),
            'reason' => $request->reason,
        ]);

        // Notification for company
        $user = $employee->company->user ?? null;
        isset($user) ? $user->notify(new NewLeaveRequest()) : '';


        session()->flash('success', 'Leave request sent successfully!');
        return back();
    }

    public function edit(LeaveRequest $leave_request)
    {
        $leave_types = LeaveType::where('company_id', currentUser()->employee->company_id)->get();

        return inertia('employee/leaveRequest/edit', [
            'leaveRequest' => $leave_request,
            'leaveTypes' =>  $leave_types
        ]);
    }

    public function update(Request $request, LeaveRequest $leave_request)
    {
        $request->validate([
            'start' => 'required',
            'end' => 'required',
            'leave_type_id' => 'required',
            'reason' => 'required',
        ], [
            'leave_type_id.required' => 'Leave type is required',
        ]);

        $leave_request->update([
            'leave_type_id' => $request->leave_type_id,
            'start' => $request->start,
            'end' => $request->end,
            'days' => diffBetweenDays($request->start, $request->end),
            'reason' => $request->reason,
        ]);

        session()->flash('success', 'Leave request updated successfully!');
        return redirect_to('employee.leave.request.index');
    }

    public function destroy(LeaveRequest $leave_request)
    {
        $leave_request->delete();

        session()->flash('success', 'Leave Request deleted successfully');
        return back();
    }

    public function leaveTypeBalance(LeaveType $leaveType)
    {
        $leave_balance = LeaveBalance::where('employee_id', currentEmployee()->id)
            ->where('leave_type_id', $leaveType->id)
            ->first();

        return $leave_balance;
    }
}
