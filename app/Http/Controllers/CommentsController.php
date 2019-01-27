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

//    public function update(Request $request, Comment $comment) {
//        $request->get('vote') === 'up' ? $comment->upvote() : $comment->downvote();
//        return back();
//    }

    // TODO: Authorization for edit and delete
    // TODO: Validation for edit

    private function validateComment() {
        return request()->validate([
            'content' => ['required', 'min:3']
        ]);
    }
}
