<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Likeable;

class Comment extends Model
{
    use Likeable;

    protected $fillable = ['content'];

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
