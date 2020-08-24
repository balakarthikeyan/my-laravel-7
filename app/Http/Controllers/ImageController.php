<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        $input['image'] = $imageName;
        request()->image->move(public_path('images'), $imageName);

        // $file = $request->file('file');
        // $input['file'] = $file->getClientOriginalName();
        // $file->move(public_path('upload'),$file->getClientOriginalName());
        // Image::create(['file' => $input['file']]);

        Image::create($input);
        return redirect()->route('image.create') ->with('success','Image Upload Successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajax(Request $request)
    {
        $input = $request->all();

        $validator = \Validator::make($request->all(), [
            'image' => 'required',
        ]);

        if($validator->passes()){
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            $input['image'] = $imageName;
            request()->image->move(public_path('photos'), $imageName);

            Image::create($input);

            return Response()->json(["success"=>"Image Upload Successfully"]);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }
}
