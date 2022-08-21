<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use App\Models\LeaveType;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\Employee\PendingLeaveRequest;
use App\Http\Requests\Admin\LeaveRequestSaveRequest;
use App\Notifications\Employee\ApprovedLeaveRequest;
use App\Notifications\Employee\RejectedLeaveRequest;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = request('company') ?? '';
        $status = request('status') ?? '';

        $leave_query = LeaveRequest::query();

        if ($company) {
            $leave_query->where('company_id', $company);
        }
        if ($status) {
            $leave_query->where('status', $status);
        }

        $leave_requests = $leave_query->with(['employee.user', 'leaveType'])->latest()->paginate(10)->withQueryString();

        $companies = Company::with('user:id,name')->get();


        return inertia('admin/leaveRequest/index', [
            'companies' => $companies,
            'leaveRequests' => $leave_requests,
            'filters' => [
                'company' => $company ?? '',
                'status' => $status ?? '',
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
        // return config('kodebazar.twilio_active');
        // return config('kodebazar.vonage_active');
        // return $request;
        $company = getCompany($request->user_id);
        $final_days_count = sumFinalDays($company->id, $request->start, $request->end) ?? diffBetweenDays($request->start, $request->end);

        $leave_request = LeaveRequest::create([
            'company_id' => $company->id,
            'employee_id' => $request->employee_id,
            'leave_type_id' => $request->leave_type_id,
            'start' => $request->start,
            'end' => $request->end,
            'days' => $final_days_count,
            'reason' => $request->reason,
            'status' => $request->status,
        ]);

        if ($request->status == 'approved') {
            $leave_balance = LeaveBalance::where('leave_type_id', $leave_request->leave_type_id)
                ->where('employee_id', $leave_request->employee_id)
                ->first();

            $diffDays = $final_days_count;
            $leave_balance->increment('used_days', $diffDays);
        }

        // Notification and mail sending
        if ($leave_request->status == 'pending') {
            $leave_request->employee->user->notify(new PendingLeaveRequest($leave_request));
            $message = "Your leave request has been submitted. Please wait for approval.";
        } elseif ($leave_request->status == 'approved') {
            $leave_request->employee->user->notify(new ApprovedLeaveRequest($leave_request));
            $message = "Your leave request has been approved";
        } elseif ($leave_request->status == 'rejected') {
            $leave_request->employee->user->notify(new RejectedLeaveRequest($leave_request));
            $message = "Your leave request has been rejected";
        }

        // Sms sending
        $to = $leave_request->employee->phone;
        sendSms('twilio', $to, $message);
        sendSms('vonage', $to, $message);

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
        $company = getCompany($request->user_id);
        $final_days_count = sumFinalDays($company->id, $request->start, $request->end) ?? diffBetweenDays($request->start, $request->end);

        $leaveRequest->update([
            'company_id' => getCompany($request->user_id)->id,
            'employee_id' => $request->employee_id,
            'leave_type_id' => $request->leave_type_id,
            'start' => $request->start,
            'end' => $request->end,
            'days' => $final_days_count,
            'reason' => $request->reason,
            'status' => $request->status,
        ]);

        // Notification and mail sending
        if ($leaveRequest->status == 'pending') {
            $leaveRequest->employee->user->notify(new PendingLeaveRequest($leaveRequest));
            $message = "Your leave request has been submitted. Please wait for approval.";
        } elseif ($leaveRequest->status == 'approved') {
            $leaveRequest->employee->user->notify(new ApprovedLeaveRequest($leaveRequest));
            $message = "Your leave request has been approved";
        } elseif ($leaveRequest->status == 'rejected') {
            $leaveRequest->employee->user->notify(new RejectedLeaveRequest($leaveRequest));
            $message = "Your leave request has been rejected";
        }

        // Sms sending
        $to = $leaveRequest->employee->phone;
        sendSms('twilio', $to, $message);
        sendSms('vonage', $to, $message);

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
        $final_days_count = sumFinalDays($leave_request->company_id, $leave_request->start, $leave_request->end) ?? diffBetweenDays($leave_request->start, $leave_request->end);

        if ($leave_request->status == 'pending' && $request->status == 'approved') {
            $leave_balance = LeaveBalance::where('leave_type_id', $leave_request->leave_type_id)
                ->where('employee_id', $leave_request->employee_id)
                ->first();

            $diffDays = $final_days_count;
            $leave_balance->increment('used_days', $diffDays);
        }

        $leave_request->update([
            'status' => $request->status,
        ]);

        session()->flash('success', 'Leave Request ' . $request->status . ' successfully');
        return back();
    }
}
