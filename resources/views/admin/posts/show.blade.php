@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h2>{{ $this_post->title }}</h2>
        <p>{{ $this_post->content }}</p>
        <div class="d-flex">
            <a href="{{ route('admin.posts.edit', ['post' => $this_post->id]) }}" class="btn btn-primary">Edit post</a>
            <form class="ml-3" action="{{ route('admin.posts.destroy', ['post' => $this_post->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete this post</button>
            </form>
        </div>
    </div>
@endsection
