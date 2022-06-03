<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Company;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveTypeSaveRequest;

class LeaveTypeController extends Controller
{
    public function index()
    {

        $leave_query = LeaveType::query();

        if (request('user_id') && request('user_id') != 'all') {
            $leave_query->where('company_id', getCompany(request('user_id'))->id);
        }

        $leave_types = $leave_query->latest()->paginate(10);
        $users = User::roleCompany()->get();

        return inertia('admin/leaveType/index', [
            'leave_types' => $leave_types,
            'users' => $users,
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

        $company->leaveTypes()->create([
            'name' => $request->name,
            'color' => $request->color,
            'balance' => $request->balance,
            'allow_half_day' => $request->allow_half_day ? 1 : 0,
            'auto_approve' => $request->auto_approve ? 1 : 0,
            'status' => $request->status ? 1 : 0,
        ]);

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
            'allow_half_day' => $request->allow_half_day ? 1 : 0,
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
}
