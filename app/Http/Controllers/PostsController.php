<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);

        return view('posts.index', ['posts' => $posts]);
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        $tags = Tag::all();

        return view('posts.create', compact('tags'));
    }

    public function store()
    {

        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required',
            'tags' => 'required|array',
        ]);

        $post = new Post;
        $post->title = request('title');
        $post->body = request('body');
        $post->user_id = auth()->user()->id;
        $post->published = false;

        $post->save();

        $post->tags()->attach(request('tags'));


        return redirect('/posts');

    }
}
