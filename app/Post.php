<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Likeable;

class Post extends Model
{
    use Likeable;

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
        $comment['owner_id'] = auth()->id();
        $this->comments()->create($comment);
    }

    public function scopePopular($query, $take = 10) {
        return $query->orderBy('votes', 'desc')->take($take)->get();
    }
}
