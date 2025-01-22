<?php

namespace App\Jobs;

use App\Mail\ReplyRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class ReplyRequestJob implements ShouldQueue
{
    use Queueable;
    protected $title, $email, $content;
    /**
     * Create a new job instance.
     */
    public function __construct($title, $email, $content)
    {
        $this->title = $title;
        $this->email = $email;
        $this->content = $content;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new ReplyRequest($this->title, $this->content));
    }
}
