<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content', 'votes'];

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function upvote() {
        $this->update(['votes' => $this->votes + 1]);
    }

    public function downvote() {
        $this->update(['votes' => $this->votes - 1]);
    }
}
