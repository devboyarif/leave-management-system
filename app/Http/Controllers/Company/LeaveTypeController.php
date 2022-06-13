<?php

namespace App\Http\Controllers\Company;

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
        $request->validate(['name' => 'required|string|max:255']);

        $company = currentCompany();

        $company->leaveTypes()->create([
            'name' => $request->name,
            'color' => $request->color,
            'balance' => $request->balance,
            'allow_half_day' => $request->allow_half_day ? 1 : 0,
            'auto_approve' => $request->auto_approve ? 1 : 0,
            'status' => $request->status ? 1 : 0,
        ]);

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

        $leaveType->update([
            'name' => $request->name,
            'color' => $request->color,
            'balance' => $request->balance,
            'allow_half_day' => $request->allow_half_day ? 1 : 0,
            'auto_approve' => $request->auto_approve ? 1 : 0,
            'status' => $request->status ? 1 : 0,
        ]);

        session()->flash('success', 'Leave type updated successfully!');
        return redirect_to('company.leaveTypes.index');
    }

    public function destroy(LeaveType $leaveType)
    {
        $leaveType->delete();

        session()->flash('success', 'Leave type deleted successfully!');
        return redirect_to('company.leaveTypes.index');
    }
}
