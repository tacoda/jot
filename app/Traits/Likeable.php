<?php

namespace App\Traits;

use App\Like;

trait Likeable {
    public function likes() {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function like() {
        $this->likes()->create(['user_id' => auth()->id()]);
    }

    public function isLiked() {
        return (bool) $this->likes()->where('user_id', auth()->id())->count();
    }

    public function unlike() {
        $this->likes()->where('user_id', auth()->id())->delete();
    }

    public function likesCount() {
        return $this->likes()->count();
    }
}
