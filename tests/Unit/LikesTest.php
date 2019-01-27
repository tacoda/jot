<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikesTest extends TestCase
{
    use RefreshDatabase;

    protected $post;

    public function setUp() {
        parent::setUp();
        $this->post = $this->createPost();
        $this->signIn();
    }

    /** @test */
    public function a_user_can_like_a_post() {
        $this->post->like();
        $this->assertDatabaseHas('likes', [
            'user_id' => $this->user->id,
            'likeable_id' => $this->post->id,
            'likeable_type' => get_class($this->post)
        ]);
        $this->assertTrue($this->post->isLiked());
    }

    /** @test */
    public function a_user_can_unlike_a_post() {
        $this->post->like();
        $this->post->unlike();
        $this->assertDatabaseMissing('likes', [
            'user_id' => $this->user->id,
            'likeable_id' => $this->post->id,
            'likeable_type' => get_class($this->post)
        ]);
        $this->assertFalse($this->post->isLiked());
    }

    /** @test */
    public function a_post_knows_how_many_likes_it_has() {
        $this->post->like();
        $this->assertEquals(1, $this->post->likesCount());
    }
}
