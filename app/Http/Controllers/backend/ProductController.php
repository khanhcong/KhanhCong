<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use illuminate\Support\Str;
use illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Product::where('product.status','!=',0)
        ->join('category','category.id','=','product.category_id')
        ->join('brand','brand.id','=','product.brand_id')
        ->select('product.id','product.id','product.name','product.image','category.name as categoryname','brand.name as brandname')
        ->orderBy('product.created_at','desc')
        ->get();
        return view("backend.product.index", compact("list"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Product::where('product.status','!=',0)
        ->join('category','category.id','=','product.category_id')
        ->join('brand','brand.id','=','product.brand_id')
        ->select('product.id','product.id','product.name','product.image','category.name as categoryname','brand.name as brandname')
        ->orderBy('product.created_at','desc')
        ->get();
        return view("backend.product.create", compact("list"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::of($request->name)->slug('-');
        $product->category_id =$request->category_id;
        $product->brand_id =$request->brand_id;
        $product->detail =$request->detail;

        $product->price =$request->price;
        $product->pricesale =$request->pricesale;
        
        $product->qty =$request->qty;

        $product->description =$request->description;
        $product->created_at =date('Y-m-d H:i:s');
        $product->created_by =Auth::id()??1;
        $product->status = $request->status;
        $product->save();
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
