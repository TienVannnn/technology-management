<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailSPRequest extends Mailable
{
    use Queueable, SerializesModels;
    protected $sr;
    /**
     * Create a new message instance.
     */
    public function __construct($sr)
    {
        $this->sr = $sr;
    }

    public function build()
    {
        return $this->view('backend.mail.mail_confirmSR')->with('sr', $this->sr);
    }
}
