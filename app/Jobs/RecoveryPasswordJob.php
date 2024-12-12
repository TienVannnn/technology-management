<?php

namespace App\Jobs;

use App\Mail\RecoveryPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class RecoveryPasswordJob implements ShouldQueue
{
    use Queueable;
    protected $email, $token;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new RecoveryPassword($this->email, $this->token));
    }
}
