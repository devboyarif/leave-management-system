<?php

namespace App\Notifications\Company;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLeaveRequest extends Notification
{
    use Queueable;

    public $leaveRequest,$company_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($leaveRequest,$company_id)
    {
        $this->leaveRequest = $leaveRequest;
        $this->company_id = $company_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if (checkMailConfig()) {
            return ['database','mail'];
        }else{
            return ['database'];
        }
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line(auth()->user()->name.' send a leave request')
            ->action('View Request', route('company.leaveRequests.index',  ['id' => $this->leaveRequest->id]))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => auth()->user()->name.' send a leave request',
            'url' => route('company.leaveRequests.index',  ['id' => $this->leaveRequest->id]),
            'company_id' => $this->company_id,
        ];
    }
}
