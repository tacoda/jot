<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'content', 'owner_id', 'votes'
    ];

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function owner() {
        return $this->belongsTo(User::class);
    }

    public function addComment($comment) {
//        $comment['votes'] = 0;
        $this->comments()->create($comment);
    }

    public function scopePopular($query, $take = 10) {
        return $query->orderBy('votes', 'desc')->take($take)->get();
    }
}
