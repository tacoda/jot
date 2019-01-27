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
//        $this->withoutExceptionHandling();
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

    /** @test */
    public function a_user_can_update_a_post_they_own() {
        $this->signIn();
        $post = $this->createPost(['owner_id' => $this->user->id]);
        $attributes = [
            'title' => 'My New Title',
            'content' => 'My New Content'
        ];
        $this->patch('/posts/' . $post->id, $attributes);
        $this->assertDatabaseHas('posts', $attributes);
    }

    /** @test */
    public function a_user_may_not_update_a_post_they_do_not_own() {
        $this->signIn();
        $otherUser = factory('App\User')->create();
        $post = $this->createPost(['owner_id' => $otherUser->id]);
        $attributes = [
            'title' => 'My New Title',
            'content' => 'My New Content'
        ];
        $response = $this->patch('/posts/' . $post->id, $attributes);
        $response->assertStatus(403);
    }

    /** @test */
    public function a_guest_may_not_update_a_post() {
//        $this->withoutExceptionHandling();
        $post = $this->createPost();
        $attributes = [
            'title' => 'My New Title',
            'content' => 'My New Content'
        ];
        $this->patch('/posts/' . $post->id, $attributes)->assertRedirect('/login');
    }

    /** @test */
    public function a_user_can_delete_a_post_they_own() {
        $this->signIn();
        $post = $this->createPost(['owner_id' => $this->user->id]);
        $this->delete('/posts/' . $post->id);
        $this->assertDatabaseMissing('posts', $post->toArray());
    }

    /** @test */
    public function a_user_may_not_delete_a_post_they_do_not_own() {
        $this->signIn();
        $otherUser = factory('App\User')->create();
        $post = $this->createPost(['owner_id' => $otherUser->id]);
        $response = $this->delete('/posts/' . $post->id);
        $response->assertStatus(403);
    }

    /** @test */
    public function a_guest_may_not_delete_a_post() {
//        $this->withoutExceptionHandling();
        $post = $this->createPost();
        $this->delete('/posts/' . $post->id)->assertRedirect('/login');
    }

    /** @test */
    public function a_post_must_have_a_title_when_it_is_created() {
//        $this->withoutExceptionHandling();
        $this->signIn();
        $attributes = ['content' => 'My Content'];
        $response = $this->post('/posts', $attributes);
        $response->assertStatus(302);
    }

    /** @test */
    public function a_post_must_have_content_when_it_is_created() {
//        $this->withoutExceptionHandling();
        $this->signIn();
        $attributes = ['title' => 'My Title'];
        $response = $this->post('/posts', $attributes);
        $response->assertStatus(302);
    }

    /** @test */
    public function a_post_must_have_a_title_when_it_is_updated() {
//        $this->withoutExceptionHandling();
        $this->signIn();
        $post = $this->createPost(['owner_id' => $this->user->id]);
        $attributes = ['content' => 'My New Content'];
        $response = $this->patch('/posts/' . $post->id, $attributes);
        $response->assertStatus(302);
    }

    /** @test */
    public function a_post_must_have_content_when_it_is_updated() {
//        $this->withoutExceptionHandling();
        $this->signIn();
        $post = $this->createPost(['owner_id' => $this->user->id]);
        $attributes = ['title' => 'My New Title'];
        $response = $this->patch('/posts/' . $post->id, $attributes);
        $response->assertStatus(302);
    }

    /** @test */
    public function a_guest_may_not_like_a_post() {
        $post = $this->createPost();
        $this->patch('/posts/' . $post->id . '/like')->assertRedirect('/login');
    }

    /** @test */
    public function a_guest_may_not_unlike_a_post() {
        $post = $this->createPost();
        $this->patch('/posts/' . $post->id . '/unlike')->assertRedirect('/login');
    }
}
