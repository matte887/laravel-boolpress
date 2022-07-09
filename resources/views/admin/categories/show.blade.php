@extends('layouts.dashboard')

@section('content')
    <h2>Category: {{ $this_category->name }}</h2>
    <div class="my-5">
        @forelse ($posts as $post)
            <h5><a href="{{ route('admin.posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></h5>
        @empty
            <h5>There are no posts in this category :(</h5>
        @endforelse
    </div>
@endsection
