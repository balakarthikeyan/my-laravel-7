<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class AdminController extends Controller
{
    /**
     * This trait has all the login throttling functionality.
     */
    use ThrottlesLogins;

    /**
     * Max login attempts allowed.
     */
    public $maxAttempts = 5;

    /**
     * Number of minutes to lock the login.
     */
    public $decayMinutes = 3;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Username used in ThrottlesLogins trait
     * 
     * @return string
     */
    public function username(){
      return 'email';
    }

    /**
     * Show Admin Dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin.index');
    }

    /**
     * Show the login form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm() 
    {
      return view('admin.login',[
        'title' => 'Admin Login',
        'loginRoute' => 'admin.login.submit',
        'forgotPasswordRoute' => 'admin.password.request',
      ]);
    }

    /**
     * Login the admin.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
      // Validate the form data
      $this->validator($request);

      //check if the user has too many login attempts.
      if ($this->hasTooManyLoginAttempts($request)){
        //Fire the lockout event.
        $this->fireLockoutEvent($request);
        //redirect the user back after lockout.
        return $this->sendLockoutResponse($request);
      }

      // Attempt to log the user in
      if (\Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
        //update last login
        $user = \Auth::guard('admin')->user();
        $user->last_login = Carbon::now();
        $user->save(); 
        // if successful, then redirect to their intended location       
        return redirect()->intended(route('admin.dashboard'))->with('status','You are Logged in as Admin!');
      } 
      // if unsuccessful, then redirect back to the login with the form data
      return $this->loginFailed();
    }

    /**
     * Logout the admin.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
      \Auth::guard('admin')->logout();
      return redirect()->route('admin.login')->with('status','Admin has been logged out!');
    }

    /**
     * Validate the form data.
     * 
     * @param \Illuminate\Http\Request $request
     * @return 
     */
    private function validator(Request $request)
    {
      //validation rules.
      $rules = [
          'email'    => 'required|email|exists:admins|min:5|max:255',
          'password' => 'required|string|min:6|max:255',
      ];

      //custom validation error messages.
      $messages = [
          'email.exists' => 'These credentials do not match our records.',
      ];

      //validate the request.
      $request->validate($rules, $messages);
    }

    /**
     * Redirect back after a failed login.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginFailed(Request $request)
    {
      return redirect()
      ->back()
      ->withInput($request->only('email', 'remember'))
      ->with('error','Login failed, please try again!');
    }    
}
