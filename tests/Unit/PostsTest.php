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
        factory('App\User')->create();
        $post = factory('App\Post')->create(['title' => 'My Title']);
        $this->assertEquals('My Title', $post->title);
    }

    /** @test */
    public function a_post_has_content() {
        factory('App\User')->create();
        $post = factory('App\Post')->create(['content' => 'My Content']);
        $this->assertEquals('My Content', $post->content);
    }

    /** @test */
    public function a_post_has_votes() {
        factory('App\User')->create();
        $post = factory('App\Post')->create(['votes' => 3]);
        $this->assertEquals(3, $post->votes);
    }

    /** @test */
    public function a_post_starts_with_no_votes() {
        factory('App\User')->create();
        $post = factory('App\Post')->create();
        $this->assertEquals(0, $post->votes);
    }

    /** @test */
    public function a_post_can_have_comments() {
        factory('App\User')->create();
        $post = factory('App\Post')->create();
        $comment1 = ['content' => 'My First Comment'];
        $comment2 = ['content' => 'My Second Comment'];
        $post->addComment($comment1);
        $post->addComment($comment2);
        $this->assertCount(2, $post->comments()->get());
    }

    /** @test */
    public function a_post_belongs_to_a_user() {
        $user = factory('App\User')->create();
        $post = factory('App\Post')->create();
        $this->assertEquals($user->id, $post->owner()->first()->id);
    }

    /** @test */
    public function it_fetches_popular_posts() {
        factory('App\User')->create();
        factory('App\Post', 10)->create();
        factory('App\Post')->create(['votes' => 10]);
        $mostPopular = factory('App\Post')->create(['votes' => 20]);

        $posts = Post::popular();

        $this->assertEquals($mostPopular->id, $posts->first()->id);
        $this->assertCount(10, $posts);
    }
}
