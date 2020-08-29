<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\TestMiddleware;

use App\Rules\UpperCase;
use App\Http\Requests\TestControllerRequest;
use App\Jobs\SendWelcomeEmail;

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
        \Event::fire(new \App\Events\SendMail(2));
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
            \Mail::to('balakarthikeyan07@gmail.com')->send(new \App\Mail\TestEmail($valueArray));
            echo 'Mail send successfully';
        } catch (\Exception $e) {
            echo 'Error - '.$e;
        }
    } 

    public function testnotify(Request $request)
    {
        $user = \App\User::find(6);
        $details = [
                'greeting' => 'Hi Artisan',
                'body' => 'This is our example notification tutorial',
                'thanks' => 'Thank you for visiting our website.',
        ];
        $user->notify(new \App\Notifications\TestNotification($details));
        // \Notification::send($user, new \App\Notifications\TestNotification($details));
        return dd("Done");
    }

    public function testform(Request $request)
    {
        // Validate incoming request
        // $validator = $request->validated();

        $validator = \Validator::make($request->all(), [
            'test-field' => ['required','max:255', new UpperCase],
        ]);

        if ($validator->fails()) {
            \Session::flash('message', $validator->messages()->first());
            return redirect()->back()->withInput();
        }

        if($validator->passes()){
            \Session::put('my_session', $request->all());
            \Session::flash('message', "Form Submitted Successfully !!");
            // echo "<pre>"; print_r($request->session()->all()); echo "</pre>";
            return redirect()->route('test-page');
        }
    }

    public function processQueue()
    {
        $emailJob = new SendWelcomeEmail();
        // $emailJob = new SendWelcomeEmail()->delay(\Carbon\Carbon::now()->addMinutes(5));
        dispatch($emailJob);
        return dd("Done");
    }
}