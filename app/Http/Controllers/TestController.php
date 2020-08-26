<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\TestMiddleware;

use Event;
use App\Events\SendMail;
use App\Mail\TestMail;

class TestController extends Controller
{
    public function __construct()
    {
        // Our Middleware
        // $this->middleware(TestMiddleware::class); 
        $this->middleware('testing');
    }

    public function index()
    {
        return "Testing Middleware";
    }
    
    public function testevent()
    {
        Event::fire(new SendMail(2));
        return "Testing Events";
    }

    public function sendmail(Request $request)
    {
        $valueArray = [
            'name' => 'Balakarthikeyan',
            'info' => 'Web Developer'
        ];

        try {
            \Mail::to('balakarthikeyan07@gmail.com')->send(new \App\Mail\SendMail($valueArray));
            echo 'Mail send successfully';
        } catch (\Exception $e) {
            echo 'Error - '.$e;
        }
    } 

    public function testmail(Request $request)
    {
        $valueArray = [
        	'name' => 'balakarthikeyan',
        ];
        
        try {
            \Mail::to('balakarthikeyan07@gmail.com')->send(new TestMail($valueArray));
            echo 'Mail send successfully';
        } catch (\Exception $e) {
            echo 'Error - '.$e;
        }
    } 

    public function testnotify(Request $request)
    {
        $user = \App\User::find(1);
        $details = [
                'greeting' => 'Hi Artisan',
                'body' => 'This is our example notification tutorial',
                'thanks' => 'Thank you for visiting our website.',
        ];
        $user->notify(new \App\Notifications\TestNotification($details));
        return dd("Done");
    }
}
