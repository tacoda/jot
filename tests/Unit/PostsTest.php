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
