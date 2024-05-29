<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    public function index()
    {

        // $list = Banner::where('banner.status','!=',0)
        // ->orderBy('banner.created_at','desc')
        // ->get();
        return view("backend.banner.index");
    }

    public function create()
    {
        $list = Banner::where('banner.status','!=',0)
        ->orderBy('banner.created_at','desc')
        ->get();
        $htmlsortorder = "";
        foreach ($list as $item){
            $htmlsortorder .= "<option value='" . ($item->sort_order+1) . "'>Sau " . $item->name . "</option>";
        }
        return view("backend.banner.create",compact("list","htmlsortorder"));
    }

    public function store(StoreBannerRequest $request)
    {
        $banner=new Banner();
        $banner->name=$request->name; //form
        $banner->link=$request->link;
        $banner->sort_order=$request->sort_order;//form
        $banner->position=$request->position;//form
        $banner->description=$request->description;//form
        $banner->created_at=date('Y-m-d H:i:s');
        $banner->created_by=Auth::id()??1;
        $banner->status=$request->status;//form
        $banner->save();
        return redirect()->route('admin.banner.index');   
     }

   
}
