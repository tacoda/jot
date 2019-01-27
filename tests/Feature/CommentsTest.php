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
//        $this->withoutExceptionHandling();
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

    /** @test */
    public function a_user_can_update_a_comment_they_own() {
        $this->signIn();
        $comment = $this->createComment(['owner_id' => $this->user->id]);
        $attributes = ['content' => 'My New Content'];
        $this->patch('/comments/' . $comment->id, $attributes);
        $this->assertDatabaseHas('comments', $attributes);
    }

    /** @test */
    public function a_user_may_not_update_a_comment_they_do_not_own() {
        $this->signIn();
        $otherUser = factory('App\User')->create();
        $comment = $this->createComment(['owner_id' => $otherUser->id]);
        $attributes = ['content' => 'My New Content'];
        $response = $this->patch('/comments/' . $comment->id, $attributes);
        $response->assertStatus(403);
    }

    /** @test */
    public function a_guest_may_not_update_a_comment() {
//        $this->withoutExceptionHandling();
        $comment = $this->createComment();
        $attributes = ['content' => 'My New Content'];
        $this->patch('/comments/' . $comment->id, $attributes)->assertRedirect('/login');
    }

    /** @test */
    public function a_user_can_delete_a_comment_they_own() {
        $this->signIn();
        $comment = $this->createComment(['owner_id' => $this->user->id]);
        $this->delete('/comments/' . $comment->id);
        $this->assertDatabaseMissing('posts', $comment->toArray());
    }

    /** @test */
    public function a_user_may_not_delete_a_comment_they_do_not_own() {
        $this->signIn();
        $otherUser = factory('App\User')->create();
        $comment = $this->createComment(['owner_id' => $otherUser->id]);
        $response = $this->delete('/comments/' . $comment->id);
        $response->assertStatus(403);
    }

    /** @test */
    public function a_guest_may_not_delete_a_comment() {
//        $this->withoutExceptionHandling();
        $comment = $this->createComment();
        $this->delete('/comments/' . $comment->id)->assertRedirect('/login');
    }

    /** @test */
    public function a_comment_must_have_content_when_it_is_created() {
//        $this->withoutExceptionHandling();
        $post = $this->createPost(['title' => 'My Title']);
        $this->signIn();
        $response = $this->post("/posts/{$post->id}/comments");
        $response->assertStatus(302);
    }

    /** @test */
    public function a_comment_must_have_content_when_it_is_updated() {
//        $this->withoutExceptionHandling();
        $this->signIn();
        $comment = $this->createComment(['owner_id' => $this->user->id]);
        $response = $this->patch('/comments/' . $comment->id);
        $response->assertStatus(302);
    }

    /** @test */
    public function a_guest_may_not_like_a_comment() {
        $comment = $this->createComment();
        $this->patch('/comments/' . $comment->id . '/like')->assertRedirect('/login');
    }

    /** @test */
    public function a_guest_may_not_unlike_a_comment() {
        $comment = $this->createComment();
        $this->patch('/comments/' . $comment->id . '/unlike')->assertRedirect('/login');
    }
}
