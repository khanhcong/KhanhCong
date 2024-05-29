<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::join('topic', 'post.topic_id', '=', 'topic.id')
            ->where('post.status', '!=', '0')
            ->orderBy('post.created_at', 'desc')
            ->select("post.*", "topic.name as topic_name")
            ->get();
        $title = 'Tất Cả  Bài Viết';
        return view("backend.post.index", compact('post', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm Bài Viết';
        $list = Topic::where('status', '!=', '0')
            ->get();
        $html_topic_id = "";
        foreach ($list as $item) {
            $html_topic_id .= "<option value='" . $item->id . "'" . (($item->id == old('topic_id')) ? ' selected ' : ' ') . ">" . $item->name . "</option>";
        }
        return view("backend.post.create", compact('title', 'html_topic_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title, '-');
        $post->metakey = $request->metakey;
        $post->metadesc = $request->metadesc;
        $post->detail = $request->detail;
        $post->status = $request->status;
        $post->topic_id = $request->topic_id;
        $post->type = 'post';
        $post->created_at = date('Y-m-d H:i:s');
        $post->created_by = Auth::guard('admin')->user()->id;
        //upload file

        if ($request->hasFile('image')) {
            $path = 'images/post/';
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $post->slug . '.' . $extension;
            $file->move($path, $filename);
            $post->image = $filename;
        }
        if ($post->save()) {
            return redirect()->route('post.index')->with('message', ['type' => 'success', 'msg' => 'Thêm thành công!']);
        }
        return redirect()->route('post.create')->with('message', ['type' => 'danger', 'msg' => 'Thêm thất bại!!']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::find($id);
        if ($post == null) {
            return redirect()->route('post.index')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
        }
$title = 'Chi Tiết Bài Viết';
        return view("backend.post.show", compact('title', 'post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'Sửa Bài Viết';
        $post = Post::where([['status', '!=', 0], ['id', '=', $id]])->first();
        if ($post == null) {
            return redirect()->route('post.index')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
        }
        $list_topic = Topic::where('status', '!=', 0)->get();
        $html_topic_id = "";
        foreach ($list_topic as $topic) {
            $html_topic_id .= "<option value='" . $topic->id . "'" . (($topic->id == old('topic_id', $post->topic_id)) ? ' selected ' : ' ') . ">" . $topic->name . "</option>";
        }
        return view("backend.post.edit", compact('title', 'html_topic_id', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $request->validate([
            'title' => [
                Rule::unique('post', 'title')->ignore($id),
                Rule::unique('product', 'name'),
                Rule::unique('brand', 'name'),
                Rule::unique('category', 'name'),
                Rule::unique('topic', 'name'),
            ]
        ], [
            'name.unique' => 'Tên đã được sử dụng. Vui lòng chọn tên khác.'
        ]);
        $post = Post::find($id);
        $post->title = $request->title;
        $post->slug = Str::slug($request->title, '-');
        $post->metakey = $request->metakey;
        $post->metadesc = $request->metadesc;
        $post->detail = $request->detail;
        $post->status = $request->status;

        $post->updated_at = date('Y-m-d H:i:s');
        $post->updated_by = Auth::guard('admin')->user()->id;
        //upload file

        if ($request->hasFile('image')) {
            $path = 'images/post/';
            if (File::exists(public_path($path . $post->image))) {
                File::delete(public_path($path . $post->image));
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $post->slug . '.' . $extension;
            $file->move($path, $filename);
            $post->image = $filename;
        }
        if ($post->save()) {

            return redirect()->route('post.index')->with('message', ['type' => 'success', 'msg' => 'Cập nhật thành công!']);
        }
        return redirect()->route('post.edit')->with('message', ['type' => 'danger', 'msg' => 'Cập nhật thất bại!!']);
    }

    /**
     * Remove the specified resource from storage.
}