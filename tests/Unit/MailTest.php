<?php

namespace Tests\Feature;

use App\Mail\CommentReceived;
use App\Post;
use App\User;
use Tests\TestCase;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class MailTest extends TestCase
{
    public function testCommentReceived()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();

        $post->user_id = $user->id;
        $post->save();

        Mail::fake();

        $this->post('/posts/' . $post->id . '/comment', ['body' => 'test body for mail sending']);

        Mail::assertSent(CommentReceived::class, function ($mail) use ($post) {
            return $mail->post->id === $post->id;
        });

        // Assert a message was sent to the given users...
        Mail::assertSent(CommentReceived::class, function ($mail) use ($post) {
            return $mail->hasTo($post->user);
        });

    }
    public function testCommentReceivedNotSent()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();

        $post->user_id = $user->id;
        $post->save();

        Mail::fake();

        Mail::assertNotSent(CommentReceived::class);

    }
}