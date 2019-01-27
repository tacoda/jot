<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Post;

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
        $post = $this->createPost();
        $comment1 = ['content' => 'My First Comment'];
        $comment2 = ['content' => 'My Second Comment'];
        $post->addComment($comment1);
        $post->addComment($comment2);
        $this->assertCount(2, $post->comments()->get());
    }

    /** @test */
    public function a_post_belongs_to_a_user() {
        $post = $this->createPost();
        $this->assertNotEquals(0, $post->owner()->first()->id);
    }

    // TODO: Post like relation?

    // TODO: Fix this test using likes instead of votes
    /** @test */
//    public function it_fetches_popular_posts() {
//        factory('App\User')->create();
//        factory('App\Post', 10)->create();
//        factory('App\Post')->create(['votes' => 10]);
//        $mostPopular = factory('App\Post')->create(['votes' => 20]);
//
//        $posts = Post::popular();
//
//        $this->assertEquals($mostPopular->id, $posts->first()->id);
//        $this->assertCount(10, $posts);
//    }
}
