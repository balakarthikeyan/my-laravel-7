<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ProductController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('products.index',compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->can('create')) {
            $request->validate([
                'name' => 'required',
                'detail' => 'required',
            ], 
            [
                'name.required' => 'Name is required',
                'detail.required' => 'Kindly provide  product details as it is required'
            ]);
            Product::create($request->all());
            return redirect()->route('products.index')->with('success','Product created successfully.');
        } else {
            return redirect()->route('products.index')->with('success','Unauthorized to access');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
        $product->update($request->all());
        return redirect()->route('products.index') ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted successfully');
    }

    
    public function ajaxlist() 
    {
        if(request()->ajax()) {
            // return datatables()->of(\DB::table('products')->select('*'))->make(true);
            return datatables()->of(Product::select('*'))->addColumn('action', 'products.action')->rawColumns(['action'])->addIndexColumn()->make(true);    
        }
        return view('products.table');
    }

    public function ajaxstore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        if ($validator->passes()) {
            // Product::updateOrCreate(condition, array);
            if($request->product_id == 0) {
                Product::create($request->all());
                return response()->json(['success'=>'Product created successfully.']);
            } else if($request->product_id > 0) {
                Product::where('id', $request->product_id)->update(['name' => $request->name, 'detail' => $request->detail]);
                return response()->json(['success','Product updated successfully.']);   
            }       
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function ajaxedit($product_id)
    {   
        $where = array('id' => $product_id);
        $product  = Product::where($where)->first();
        \Log::info($product);
        return response()->json($product);
    }

    public function ajaxdelete($product_id)
    {
        $product = Product::where('id', $product_id)->delete();      
        return response()->json(['success','Product deleted successfully.']);
    }            
}