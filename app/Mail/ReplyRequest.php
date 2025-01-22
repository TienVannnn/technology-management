<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReplyRequest extends Mailable
{
    use Queueable, SerializesModels;
    protected $title, $content;

    /**
     * Create a new message instance.
     */
    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function build()
    {
        return $this->subject($this->title)
            ->view('backend.mail.reply_request')
            ->with(['data' => $this->content, 'title' => $this->title]);
    }
}
