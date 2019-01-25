<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // NOTE: May need optional typehint (? prefix)
    //if show post as guest because of show view
    public function update(User $user, Post $post) {
        return $post->owner_id == $user->id;
    }
}
