<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);

        return inertia('admin/others/blog/index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('admin/others/blog/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'long_description' => 'required|string'
        ]);

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $request->validate(['thumbnail' => 'image|mimes:jpeg,png,jpg,svg|max:5120']);
            $url = uploadFileToPublic('thumbnail', $request->thumbnail);
            $thumbnail = $url;
        }

        Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'thumbnail' => $thumbnail ?? '',
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
        ]);

        session()->flash('success', 'Post created successfully!');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return inertia('admin/others/blog/edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'long_description' => 'required|string'
        ]);

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $request->validate(['thumbnail' => 'image|mimes:jpeg,png,jpg,svg|max:5120']);
            $url = uploadFileToPublic('thumbnail', $request->thumbnail);
            $thumbnail = $url;
        }

        $post->update([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'thumbnail' => $thumbnail ?? '',
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
        ]);

        session()->flash('success', 'Post updated successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        session()->flash('success', 'Post deleted successfully!');
        return back();
    }
}
