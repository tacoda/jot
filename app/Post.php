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

    public function deleteAllComments() {
        $this->comments()->get()->each(function($comment) {
            $comment->delete();
        });
    }

    public function delete() {
        $this->deleteAllLikes();
        parent::delete();
    }
}
