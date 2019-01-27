<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $user;

    public function signIn($user = null) {
        if(! $user) {
            $user = factory('App\User')->create();
        }
        $this->user = $user;
        $this->actingAs($this->user);
        return $this;
    }

    public function createPost($attributes = []) {
        return factory('App\Post')->create($attributes);
    }

    public function createComment($attributes = []) {
        return factory('App\Comment')->create($attributes);
    }
}
