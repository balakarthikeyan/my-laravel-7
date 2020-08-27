<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Category;

class AjaxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function ajaxPage()
    {
        $categories = Category::get();
        return view('pages.ajax',compact('categories'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function ajaxPost(Request $request)
    {
        $input = $request->all();
        \Log::info($input);
        return response()->json(['success'=>'Got Simple Ajax Request.']);
    }

    public function charts()
    {
        $users = User::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');
          
        return view('pages.chart', compact('users'));
    }

}
