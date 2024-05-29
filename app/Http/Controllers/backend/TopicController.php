<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTopicRequest;
use App\Models\Topic;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function index()
    {

        $list = Topic::where('topic.status','!=',0)
        ->orderBy('topic.created_at','desc')
        ->get();
        return view("backend.topic.index",compact("list"));
    }

    public function create()
    {
        return view("backend.topic.create");
    }

    public function store(StoreTopicRequest $request)
    {
        $topic = new Topic();
        $topic->name = $request->name;
        $topic->slug = Str::of($request->name)->slug('-');
        $topic->sort_order =$request->sort_order;
        $topic->description =$request->description;
        $topic->created_at =date('Y-m-d H:i:s');
        $topic->created_by =Auth::id()??1;
        $topic->status = $request->status;
        $topic->save();
        return redirect()->route('admin.topic.index');
    }
}
