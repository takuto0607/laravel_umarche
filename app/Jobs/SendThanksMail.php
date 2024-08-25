<?php

namespace App\Jobs;

use App\Mail\TestMail;
use App\Mail\ThanksMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendThanksMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $products;
    public $user;

    /**
     * Create a new job instance.
     */
    public function __construct($products, $user)
    {
        $this->products = $products;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Mail::to('test@example.com')->send(new TestMail());
        Mail::to($this->user)->send(new ThanksMail($this->products, $this->user));
    }
}
