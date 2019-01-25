<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index() {
        $posts = Post::all();
//        $posts = Post::where('owner_id', auth()->id())->get();
        return view('posts.index')->with(['posts' => $posts]);
    }

    public function create() {
        return view('posts.create');
    }

    public function store(Request $request) {
        $attributes = $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'content' => ['required', 'min:3']
        ]);
        $attributes['owner_id'] = auth()->id();
        Post::create($attributes);
//        Post::create($request->all());
        return redirect('/posts');
    }

    public function show(Post $post) {
        return view('posts.show')->with(['post' => $post]);
    }

    public function edit(Post $post) {
        $this->authorize('update', $post);
        return view('posts.edit')->with(['post' => $post]);
    }

    public function update(Request $request, Post $post) {
        $this->authorize('update', $post);
        // TODO: Validation
        $post->update($request->all());
        return redirect('/posts');
    }

    public function destroy(Post $post) {
        $this->authorize('update', $post);
        $post->delete();
        return redirect('/posts');
    }
}
