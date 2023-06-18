<?php

namespace App\Jobs;

use App\Mail\VerificationEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class VerifyEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $details;

    /**
     * Create a new job instance.
     */
    public function __construct($details)
    {
        $this->details=$details;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Mail::to($this->user->email)->send(new CustomerEmail($this->user));
        Mail::to($this->details['email'])->send(new VerificationEmail($this->details));
    }
}