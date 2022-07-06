@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h2>{{ $this_post->title }}</h2>
        <p>{{ $this_post->content }}</p>
    </div>
@endsection
