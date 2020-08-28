<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->user();
        // $result = $user->givePermission('create'); // will return permission, if not null
        // $result = $user->removePermission('edit');
        // $result = $user->modifyPermission('edit');
        // $result = $user->hasRole('developer');    //will return true, if user has role 
        // $result = $user->hasPermission('create');    //will return true, if role has permission
        // $result = $user->can('create'); // will return true, if user has permission  
        // dd( $result );           
        return view('home');
    }   
}
