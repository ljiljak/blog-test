@extends('layouts.master')

@section('content')

    <h2 class="blog-post-title">{{ $post->title }}</h2>
    <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }} by <a href="/users/{{ $post->user_id }}">{{ $post->user->name }}</a></p>

    @if (count($post->tags))
        <ul>
            @foreach ($post->tags as $tag)
                <li> 
                    <a href="/posts/tags/{{ $tag->name }}"> {{ $tag->name}} </a> 
                </li>
            @endforeach
        </ul>
    @endif

    <p>{{ $post->body }}</p>

    @foreach($post->comments as $comment)
        <li>
            <strong>{{ $comment->created_at->diffForHumans() }}</strong>
            {{ $comment->body }}
        </li>
    @endforeach

    <hr>

    <h4>Comments</h4>

    <form method="POST" action="/posts/{{ $post->id }}/comment">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control" id="body" name="body"></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>


    @if (count($errors->all()) > 0)

        @foreach($errors->all() as $error)
            <div class="form-group">
                <div class="alert alert-danger">
                    <li>{{ $error }}</li>
                </div>
            </div>
        @endforeach

    @endif

@endsection
