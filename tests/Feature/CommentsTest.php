<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_comment() {
//        $this->withExceptionHandling();
        $post = $this->createPost(['title' => 'My Title']);
        $this->signIn();
        // When I create a new post
        $attributes = ['content' => 'My Content'];
        $this->post("/posts/{$post->id}/comments", $attributes);
        // Then there should be a new post
        $this->assertDatabaseHas('comments', $attributes);
    }

    /** @test */
    public function a_guest_may_not_create_a_comment() {
//        $this->withoutExceptionHandling();
        $post = $this->createPost(['title' => 'My Title']);
        $attributes = ['content' => 'My Content'];
        $this->post("/posts/{$post->id}/comments", $attributes)->assertRedirect('/login');
    }
}
