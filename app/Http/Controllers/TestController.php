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
        return "done";
    }
}
