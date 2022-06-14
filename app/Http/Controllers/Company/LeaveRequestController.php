<?php

namespace App\Http\Controllers\Company;

use App\Models\User;
use App\Models\Employee;
use App\Models\LeaveType;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\LeaveRequestSaveRequest;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leave_requests = LeaveRequest::with(['employee.user', 'employee.team', 'company.user', 'leaveType'])
            ->where('company_id', currentCompany()->id)
            ->latest()
            ->paginate(10);

        return inertia('company/leaveRequest/index', [
            'leaveRequests' => $leave_requests,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = currentCompany();
        $leaveTypes = $company->leaveTypes;
        $employeesUsers = $company->employees->load('user');

        return inertia('company/leaveRequest/create', [
            'leaveTypes' => $leaveTypes,
            'employeesUsers' => $employeesUsers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LeaveRequestSaveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeaveRequestSaveRequest $request)
    {
        LeaveRequest::create([
            'company_id' => currentCompany()->id,
            'employee_id' => $request->employee_id,
            'leave_type_id' => $request->leave_type_id,
            'start' => $request->start,
            'end' => $request->end,
            'days' => diffBetweenDays($request->start, $request->end),
            'reason' => $request->reason,
            'status' => $request->status,
        ]);

        session()->flash('success', 'Leave request created successfully!');
        return redirect_to('company.leaveRequests.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(LeaveRequest $leaveRequest)
    {
        $company_id = $leaveRequest->company_id;
        $leaveTypes = LeaveType::where('company_id', $company_id)->get(['id', 'name']);
        $employeesUsers = Employee::with('user')->where('company_id', $company_id)->get(['id', 'user_id']);

        return inertia('company/leaveRequest/edit', [
            'leaveRequest' => $leaveRequest,
            'leaveTypes' => $leaveTypes,
            'employeesUsers' => $employeesUsers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LeaveRequestSaveRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LeaveRequestSaveRequest $request, LeaveRequest $leaveRequest)
    {
        $leaveRequest->update([
            'company_id' => currentCompany()->id,
            'employee_id' => $request->employee_id,
            'leave_type_id' => $request->leave_type_id,
            'start' => $request->start,
            'end' => $request->end,
            'days' => diffBetweenDays($request->start, $request->end),
            'reason' => $request->reason,
            'status' => $request->status,
        ]);

        session()->flash('success', 'Leave request updated successfully!');
        return redirect_to('company.leaveRequests.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveRequest $leaveRequest)
    {
        $leaveRequest->delete();

        session()->flash('success', 'Leave Request deleted successfully');
        return back();
    }

    public function statusChange(Request $request)
    {
        $leave_request = LeaveRequest::findOrFail($request->id);
        $leave_request->update([
            'status' => $request->status,
        ]);

        $message = 'Leave Request ' . $request->status . ' successfully';
        session()->flash('success', $message);
        return back();
    }
}
