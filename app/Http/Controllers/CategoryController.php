<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('pages.ajax',compact('categories'));
    }

    public function getCategory($category_id)
    {
        $data = SubCategory::where('category_id',$category_id)->get();
        \Log::info($data);
        return response()->json(['data' => $data]);
    }
}
