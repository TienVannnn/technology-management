<?php

namespace App\Jobs;

use App\Mail\MailAccount;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class MailAccountJob implements ShouldQueue
{
    use Queueable;
    protected $user, $rand;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user, $rand)
    {
        $this->user = $user;
        $this->rand = $rand;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new MailAccount($this->user, $this->rand));
    }
}
