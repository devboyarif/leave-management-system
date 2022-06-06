<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Employee;
use App\Models\LeaveType;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LeaveRequestSaveRequest;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $leave_query = LeaveRequest::query();

        if (request('user_id') && request('user_id') != 'all') {
            $leave_query->where('company_id', getCompany(request('user_id'))->id);
        }

        $leave_requests = $leave_query->with(['employee.user', 'employee.team', 'company.user', 'leaveType'])->latest()->paginate(10);

        $users = User::roleCompany()->get();

        return inertia('admin/leaveRequest/index', [
            'users' => $users,
            'leaveRequests' => $leave_requests,
            'filterRequest' => [
                'user_id' => request('user_id'),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::roleCompany()->get();

        return inertia('admin/leaveRequest/create', [
            'users' => $users,
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
            'company_id' => getCompany($request->user_id)->id,
            'employee_id' => $request->employee_id,
            'leave_type_id' => $request->leave_type_id,
            'start' => $request->start,
            'end' => $request->end,
            'days' => diffBetweenDays($request->start, $request->end),
            'reason' => $request->reason,
            'status' => $request->status,
        ]);

        session()->flash('success', 'Leave request created successfully!');
        return redirect_to('leaveRequests.index');
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
        $users = User::roleCompany()->get();
        $leaveRequest['user_id'] = getUserByCompanyId($leaveRequest->company_id)->id;

        return inertia('admin/leaveRequest/edit', [
            'leaveRequest' => $leaveRequest,
            'users' => $users,
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
            'company_id' => getCompany($request->user_id)->id,
            'employee_id' => $request->employee_id,
            'leave_type_id' => $request->leave_type_id,
            'start' => $request->start,
            'end' => $request->end,
            'days' => diffBetweenDays($request->start, $request->end),
            'reason' => $request->reason,
            'status' => $request->status,
        ]);

        session()->flash('success', 'Leave request updated successfully!');
        return redirect_to('leaveRequests.index');
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

        session()->flash('error', 'Leave Request ' . $request->status . ' successfully');
        return back();
    }
}
