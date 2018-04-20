<p>Hello {{ $post->user->name }}</p>

<p>You have new comment on your post <a href="{{ url('posts/' . $post->id) }}">{{ $post->title }}</a></p>
