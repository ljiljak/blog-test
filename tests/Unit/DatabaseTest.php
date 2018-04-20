<?php

namespace Tests\Unit;

use App\Comment;
use App\Post;
use App\User;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostsTableTest()
    {
        $post = factory(Post::class)->create();

        $user = factory(User::class)->create();

        $post->user_id = $user->id;
        $post->save();
        $this->assertDatabaseHas('posts', [
            'title' => $post->title
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCommentsTableTest()
    {
        $post = factory(Post::class)->create();
        $post->comments()->saveMany(factory(Comment::class, 6)->make());

        $user = factory(User::class)->create();
        $post->user_id = $user->id;
        $post->save();

        $this->assertEquals(6, $post->comments->count());
    }
}
