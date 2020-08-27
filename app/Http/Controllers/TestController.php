<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\TestMiddleware;

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
        // Adding Value to Session Array
        // $request->session()->put('my_session', $request->all());
        \Session::put('my_session', $request->all());
        
        /*
        // Regenerate session IDs
        echo "<pre>Session ID : ".$request->session()->regenerate()."</pre>";  

        // Retrieve Session Values           
        echo "<pre>Added to Session : <br/>"; print_r($request->session()->get('my_session')); echo "</pre>"; 
        echo "<pre>From Global Session : <br/>"; print_r(session('my_session')); echo "</pre>";

        // Specifying a default value...
        $request->session()->get('my_session.test-consent', false);

        if (!$request->session()->has('my_session.test-consent')) {
            // Pushing To Array Session Values
            $request->session()->push('my_session.test-consent', true);
        }

        // Retrieving & Deleting An Item
        $request->session()->pull('my_session.test-consent', true);

        // Remove an item from the session
        $request->session()->forget('my_session.test-consent');

        // Store items in the session only for the next request.
        $request->session()->flash('status', 'Added successfully!');

        // Remove all values from session
        $request->session()->flush();
        */

        // Retrieving All Session Data
        echo "<pre>"; print_r($request->session()->all()); echo "</pre>";

        // return View::make('pages.index')->with(compact('content', 'session', 'message'));
        return view('pages.index', $request->all());
    }    
      
}
