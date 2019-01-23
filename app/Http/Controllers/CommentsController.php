<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Request $request, Post $post) {
        $attributes = $request->validate([
            'content' => 'required'
        ]);
        $post->addComment($attributes);
        return back();
    }

    public function update(Request $request, Comment $comment) {
        $comment->update([
            'votes' => $request->get('vote') === 'up' ? $comment->votes + 1 : $comment->votes - 1
        ]);
        return back();
    }
}
