<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_post() {
//        $this->withExceptionHandling();
        // Given I am a user who is logged in
        $this->signIn();
        // When I create a new post
        $attributes = [
            'title' => 'My Title',
            'content' => 'My Content'
        ];
        $this->post('/posts', $attributes);
        // Then there should be a new post
        $this->assertDatabaseHas('posts', $attributes);
    }

    /** @test */
    public function a_guest_may_not_create_a_post() {
//        $this->withoutExceptionHandling();
        $attributes = [
            'title' => 'My Title',
            'content' => 'My Content'
        ];
        $this->post('/posts', $attributes)->assertRedirect('/login');
    }

    // TODO: Authorization tests

    // TODO: Validation tests
}
