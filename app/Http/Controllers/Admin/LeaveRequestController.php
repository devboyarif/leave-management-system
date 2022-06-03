<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LeaveType;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return request('leave_type_id');
        // return $request->all();
        $leave_query = LeaveRequest::query();

        if (request('user_id') && request('user_id') != 'all') {
            $leave_query->where('company_id', getCompany(request('user_id'))->id);
        }

        $leave_requests = $leave_query->with('employee.{user,team}', 'leaveType')->latest()->paginate(10);

        $users = User::roleCompany()->get();

        return inertia('admin/leaveRequest/index', [
            'users' => $users,
            'leaveRequests' => $leave_requests,
            'filterRequest' => [
                'user_id' => request('user_id'),
            ],
        ]);




        return $leave_requests = LeaveRequest::latest()->paginate(10);

        return inertia('admin/leaveRequest/index', [
            'leave_requests' => $leave_requests,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
