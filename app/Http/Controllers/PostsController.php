<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index() {
        $posts = Post::all();
        return view('posts.index')->with(['posts' => $posts]);
    }

    public function create() {
        return view('posts.create');
    }

    public function store(Request $request) {
        Post::create($request->all());
        return redirect('/posts');
    }

    public function show(Post $post) {
        return view('posts.show')->with(['post' => $post]);
    }

    public function edit(Post $post) {
        return view('posts.edit')->with(['post' => $post]);
    }

    public function update(Request $request, Post $post) {
        $post->update($request->all());
        return redirect('/posts');
    }

    public function destroy(Post $post) {
        $post->delete();
        return redirect('/posts');
    }
}
