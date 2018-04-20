<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Mail\CommentReceived;

class CommentsController extends Controller
{
    public function store($id)
    {
        $this->validate(request(), [
            'body' => 'required|min:2'
        ]);

        $post = Post::find($id);

        $post->addComment(request('body'));

		\Mail::to($post->user)->send(new CommentReceived($post));

        return back();
    }
}
