<?php

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PlanPurchase extends Notification
{
    use Queueable;

    public $admin_name, $company_name, $plan_name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($admin_name, $company_name, $plan_name)
    {
        $this->admin_name = $admin_name;
        $this->company_name = $company_name;
        $this->plan_name = $plan_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
            ->subject(ucfirst($this->company_name) . ' has subscribed the ' . ucfirst($this->plan_name) . ' plan!')
            ->greeting('Hello, ' . $this->admin_name)
            ->line(ucfirst($this->company_name) . ' has subscribed the ' . ucfirst($this->plan_name) . ' Plan!')
            ->line('Regards,')
            ->salutation(config('app.name'));
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
            'message' => ucfirst($this->company_name) . ' has purchased the ' . ucfirst($this->plan_name) . ' plan!',
            'url' => url('/'),
        ];
    }
}
