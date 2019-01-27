<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Comment;

class CommentsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function store(Request $request, Post $post) {
        $attributes = $this->validateComment();
        $post->addComment($attributes);
        return back();
    }

    public function edit(Comment $comment) {
        $this->authorize('update', $comment);
        return view('comments.edit')->with(['comment' => $comment]);
    }

    public function update(Comment $comment) {
        $this->authorize('update', $comment);
        $attributes = $this->validateComment();
        $comment->update($attributes);
        $postId = $comment->post()->first()->id;
        return redirect('/posts/' . $postId);
    }

    public function destroy(Comment $comment) {
        $this->authorize('update', $comment);
        $postId = $comment->post()->first()->id;
        $comment->delete();
        return redirect('/posts/' . $postId);
    }

    public function like(Comment $comment) {
        if(! $comment->isLiked()) {
            $comment->like();
        }
        return back();
    }

    public function unlike(Comment $comment) {
        if($comment->isLiked()) {
            $comment->unlike();
        }
        return back();
    }

    private function validateComment() {
        return request()->validate([
            'content' => ['required', 'min:3']
        ]);
    }
}
