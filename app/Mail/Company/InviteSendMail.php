<?php

namespace App\Mail\Company;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteSendMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $url, $company, $team;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invite)
    {
        $this->url = route('company.invite.accept', $invite->token);
        $this->company = currentCompany();
        $this->team = $invite->team;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Invite to join ' . $this->company->company_name)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->markdown('mails.company.invite_send_mail');
    }
}
