<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_post_has_a_title() {
        $post = $this->createPost(['title' => 'My Title']);
        $this->assertEquals('My Title', $post->title);
    }

    /** @test */
    public function a_post_has_content() {
        $post = $this->createPost(['content' => 'My Content']);
        $this->assertEquals('My Content', $post->content);
    }

    /** @test */
    public function a_post_can_have_comments() {
        $this->signIn();
        $post = $this->createPost();
        $post->addComment(['content' => 'My First Comment']);
        $post->addComment(['content' => 'My Second Comment']);
        $this->assertCount(2, $post->comments()->get());
    }

    /** @test */
    public function a_post_belongs_to_a_user() {
        $post = $this->createPost();
        $this->assertNotEquals(0, $post->owner()->first()->id);
    }

    /** @test */
    public function a_post_will_delete_all_of_its_comments_when_it_is_deleted() {
        $this->signIn();
        $post = $this->createPost();
        $post->addComment(['content' => 'My First Comment']);
        $post->addComment(['content' => 'My Second Comment']);
        $this->assertCount(2, $post->comments()->get());
        $post->delete();
        $this->assertCount(0, $post->comments()->get());
    }
}
