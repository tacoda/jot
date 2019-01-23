<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content', 'votes'];

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
