<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_own_a_post() {
//        $this->withoutExceptionHandling();
        $user = factory('App\User')->create();
        $user->posts()->create([
            'title' => 'New Title',
            'content' => 'New Content'
        ]);
        $this->assertEquals('New Title', $user->posts()->first()->title);
    }

    /** @test */
    public function a_user_can_own_a_comment() {
        $user = factory('App\User')->create();
        factory('App\Comment')->create([
            'owner_id' => $user->id,
            'content' => 'New Content'
        ]);
        $this->assertEquals('New Content', $user->comments()->first()->content);
    }
}
