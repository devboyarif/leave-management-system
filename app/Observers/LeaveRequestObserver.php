<?php

namespace App\Observers;

use App\Models\LeaveRequest;
use App\Notifications\Employee\PendingLeaveRequest;
use App\Notifications\Employee\ApprovedLeaveRequest;
use App\Notifications\Employee\RejectedLeaveRequest;

class LeaveRequestObserver
{
    /**
     * Handle the LeaveRequest "created" event.
     *
     * @param  \App\Models\LeaveRequest  $leaveRequest
     * @return void
     */
    public function created(LeaveRequest $leaveRequest)
    {
        if ($leaveRequest->status == 'pending') {
            $leaveRequest->employee->user->notify(new PendingLeaveRequest($leaveRequest));
        } elseif ($leaveRequest->status == 'approved') {
            $leaveRequest->employee->user->notify(new ApprovedLeaveRequest($leaveRequest));

            setting('default_sms');
        } elseif ($leaveRequest->status == 'rejected') {
            $leaveRequest->employee->user->notify(new RejectedLeaveRequest($leaveRequest));
            setting('default_sms');
        }
    }

    /**
     * Handle the LeaveRequest "updated" event.
     *
     * @param  \App\Models\LeaveRequest  $leaveRequest
     * @return void
     */
    public function updated(LeaveRequest $leaveRequest)
    {
        if ($leaveRequest->status == 'pending') {
            $leaveRequest->employee->user->notify(new PendingLeaveRequest($leaveRequest));
        } elseif ($leaveRequest->status == 'approved') {
            $leaveRequest->employee->user->notify(new ApprovedLeaveRequest($leaveRequest));
        } elseif ($leaveRequest->status == 'rejected') {
            $leaveRequest->employee->user->notify(new RejectedLeaveRequest($leaveRequest));
        }
    }

    /**
     * Handle the LeaveRequest "deleted" event.
     *
     * @param  \App\Models\LeaveRequest  $leaveRequest
     * @return void
     */
    public function deleted(LeaveRequest $leaveRequest)
    {
        //
    }

    /**
     * Handle the LeaveRequest "restored" event.
     *
     * @param  \App\Models\LeaveRequest  $leaveRequest
     * @return void
     */
    public function restored(LeaveRequest $leaveRequest)
    {
        //
    }

    /**
     * Handle the LeaveRequest "force deleted" event.
     *
     * @param  \App\Models\LeaveRequest  $leaveRequest
     * @return void
     */
    public function forceDeleted(LeaveRequest $leaveRequest)
    {
        //
    }
}
