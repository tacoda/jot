<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'content', 'owner_id'
    ];

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function owner() {
        return $this->belongsTo(User::class);
    }

    public function addComment($comment) {
        $comment['votes'] = 0;
        $this->comments()->create($comment);
    }
}
