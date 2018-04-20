<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
    	$posts = $tag->posts()->with('user')->latest()->paginate(10);

    	return view('posts.index', compact('posts'));
    }
}
