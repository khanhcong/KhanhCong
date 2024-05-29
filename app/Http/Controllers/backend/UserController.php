<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index()
    {

        // $list = Menu::where('menu.status','!=',0)
        // ->orderBy('menu.created_at','desc')
        // ->get();
        return view("backend.user.index");
    }

    public function create()
    {

        return view("backend.menu.create");
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->slug = Str::of($request->name)->slug('-');
        $user->username = $request->username;
        $user->password = $request->password;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->email =$request->email;
        $user->role =$request->role;
        $user->address =$request->address;
        $user->created_at =date('Y-m-d H:i:s');
        $user->created_by =Auth::id()??1;
        $user->status = $request->status;
        $user->save();
        return redirect()->route('admin.user.index');
    }
}
