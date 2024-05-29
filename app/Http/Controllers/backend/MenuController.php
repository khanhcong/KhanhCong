<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {

        // $list = Menu::where('menu.status','!=',0)
        // ->orderBy('menu.created_at','desc')
        // ->get();
        return view("backend.menu.index");
    }

    public function create()
    {
        return view("backend.menu.create");
    }

    // public function store(StoreMenuRequest $request)
    // {
    //     $category = new Category();
    //     $category->name = $request->name;
    //     $category->slug = Str::of($request->name)->slug('-');
    //     $category->parent_id =$request->parent_id;
    //     $category->sort_order =$request->sort_order;
    //     $category->description =$request->description;
    //     $category->created_at =date('Y-m-d H:i:s');
    //     $category->created_by =Auth::id()??1;
    //     $category->status = $request->status;
    //     $category->save();
    //     return redirect()->route('admin.category.index');
    // }
}
