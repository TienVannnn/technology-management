<?php

namespace App\Jobs;

use App\Mail\MailSPRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SupportRequestJob implements ShouldQueue
{
    use Queueable;
    protected $sr;
    /**
     * Create a new job instance.
     */
    public function __construct($sr)
    {
        $this->sr = $sr;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->sr->customer->email)->send(new MailSPRequest($this->sr));
    }
}
