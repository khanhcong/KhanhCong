<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function index()
    {

        // $list = Brand::where('brand.status','!=',0)
        // ->orderBy('brand.created_at','desc')
        // ->get();
        return view("backend.brand.index");
    }

    public function create()
    {
        $list = Brand::where('brand.status','!=',0)
        ->orderBy('brand.created_at','desc')
        ->get();
        $htmlsortorder = "";
        foreach ($list as $item){
            $htmlsortorder .= "<option value='" . ($item->sort_order+1) . "'>Sau " . $item->name . "</option>";
        }
        return view("backend.brand.create",compact("list","htmlsortorder"));
    }

    public function store(StoreBrandRequest $request)
    {
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::of($request->name)->slug('-');
        //$brand->image = $request->name;
        $brand->sord_order = $request->sord_order;
        $brand->description = $request->description;
        $brand->created_at = date('Y-m-d H:i:s');
        $brand->updated_at = $request->updated_at;
        $brand->created_by = Auth::id()??1;
        $brand->updated_by = $request->updated_by;
        $brand->status = $request->status;
        $brand->save();
        return redirect()->route('admin.brand.index');
    }
}
