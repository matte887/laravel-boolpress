@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h2>{{ $this_post->title }}</h2>
        <p>{{ $this_post->content }}</p>
        <a href="{{ route('admin.posts.edit', ['post' => $this_post->id]) }}" class="btn btn-primary">Edit post</a>
    </div>
@endsection
