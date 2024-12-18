<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailAccount extends Mailable
{
    use Queueable, SerializesModels;
    protected $user, $rand;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $rand)
    {
        $this->user = $user;
        $this->rand = $rand;
    }

    public function build()
    {
        return $this->view('backend.mail.mailaccount')->with(
            [
                'email' => $this->user->email,
                'pass' => $this->rand
            ]
        );
    }
}
