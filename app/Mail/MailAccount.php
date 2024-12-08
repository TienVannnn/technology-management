<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailAccount extends Mailable
{
    use Queueable, SerializesModels;
    protected $user, $rand;
    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $rand)
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
