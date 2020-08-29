<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Mail;
use App\Mail\WelcomeEmail;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $valueArray = [
            'name' => 'Balakarthikeyan',
            'welcome-greeting' => 'Welcome To Our App',
            'info' => 'You are welcome to our platform.',
            'end-greeting' => 'Thank you',
        ];        
        Mail::to('balakarthikeyan07@gmail.com')->send(new WelcomeEmail($valueArray));
    }
}
