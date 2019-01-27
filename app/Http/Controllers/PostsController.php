<?php

namespace App\Http\Controllers;

use App\Events\PostWasCreated;
use App\Post;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index() {
        $posts = Post::all();
//        dump($posts);
        return view('posts.index')->with(['posts' => $posts]);
    }

    public function create() {
        return view('posts.create');
    }

    public function store() {
        $attributes = $this->validatePost();
        auth()->user()->posts()->create($attributes);
//        $attributes['owner_id'] = auth()->id();
//        $post = Post::create($attributes);
//        event(new PostWasCreated($post));
        session()->flash('message', 'Post created!');
        return redirect('/posts');
    }

    public function show(Post $post) {
        return view('posts.show')->with(['post' => $post]);
    }

    public function edit(Post $post) {
        $this->authorize('update', $post);
        return view('posts.edit')->with(['post' => $post]);
    }

    public function update(Post $post) {
        $this->authorize('update', $post);
        $attributes = $this->validatePost();
        $post->update($attributes);
        session()->flash('message', 'Post updated!');
        return redirect('/posts/' . $post->id);
    }

    public function destroy(Post $post) {
        $this->authorize('update', $post);
        $post->delete();
        return redirect('/posts');
    }

    public function like(Post $post) {
        if(! $post->isLiked()) {
            $post->like();
        }
        return back();
    }

    public function unlike(Post $post) {
        if($post->isLiked()) {
            $post->unlike();
        }
        return back();
    }

    private function validatePost() {
        return request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'content' => ['required', 'min:3']
        ]);
    }
}
