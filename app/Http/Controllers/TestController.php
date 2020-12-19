<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\TestMiddleware;

use App\User;
use App\Rules\UpperCase;
use App\Http\Requests\TestControllerRequest;
use App\Jobs\SendWelcomeEmail;
use Facades\App\Services\UserService;
use Illuminate\Support\Facades\Storage;

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

    public function saveroutes(){
        $routes = []; // an empty array of stored permission IDs
        // iterate though all routes
        foreach (\Route::getRoutes()->getRoutes() as $key => $route)
        {
            // get route action
            $action = $route->getActionname();
            // separating controller and method
            $_action = explode('@',$action);
            
            $controller = $_action[0];
            $method = end($_action);
         
            // check if this permission is already exists
            $permission_check = \App\Routes::where(['controller'=>$controller,'method'=>$method])->first();
            if(!$permission_check){
                $permission = new \App\Routes;
                $permission->controller = $controller;
                $permission->method = $method;
                $permission->save();
                // add stored permission id in array
                $routes[] = $permission;
            }
        }
        // Retrieving All Session Data
        // echo "<pre>"; print_r($routes); echo "</pre>";          
        return view('pages.index', $routes); 
    }  
    
    public function processQueue()
    {
        $emailJob = new SendWelcomeEmail();
        // $emailJob = new SendWelcomeEmail()->delay(\Carbon\Carbon::now()->addMinutes(5));
        dispatch($emailJob);
        return dd("Done");
    }

    public function searchindex()
    {
        return view('pages.user');
    }

    public function searchusers(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
        ]);
       
        try {
            $user = UserService::search($request->input('user_id'));
        } catch (UserNotFoundException $exception) {
            report($exception);
            // return back()->withError('User not found by ID ' . $request->input('user_id'))->withInput();
            return back()->withError($exception->getMessage())->withInput();
        }              
        
        return view('pages.search', compact('user'));
    } 
    
    public function tests3list()
    {
        $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
        $images = [];
        $files = Storage::disk('s3')->files('images');
            foreach ($files as $file) {
                $images[] = [
                    'name' => str_replace('images/', '', $file),
                    'src' => $url . $file
                ];
            }
        
        return view('pages.s3', compact('images'));
    }
    public function tests3store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|max:2048'
        ]);
  
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . $file->getClientOriginalName();
            $filePath = 'images/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
        }
  
        return back()->withSuccess('Image uploaded successfully');
    }
  
    public function tests3destroy($image)
    {
        Storage::disk('s3')->delete('images/' . $image);
  
        return back()->withSuccess('Image was deleted successfully');
    }    
}