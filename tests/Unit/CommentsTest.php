<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_comment_has_content() {
        $comment = $this->createComment(['content' => 'My Content']);
        $this->assertEquals('My Content', $comment->content);
    }

    /** @test */
    public function a_comment_belongs_to_a_post() {
        $this->signIn();
        $post = $this->createPost();
        $comment = $this->createComment(['post_id' => $post->id]);
        $this->assertEquals($post->id, $comment->post()->first()->id);
    }

    /** @test */
    public function a_comment_belongs_to_a_user() {
        $comment = $this->createComment();
        $this->assertNotEquals(0, $comment->owner()->first()->id);
    }
}
