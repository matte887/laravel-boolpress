@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h2>Recipe categories</h2>
        <ul>
            @foreach ($categories as $category)
                <li><a href="{{ route('admin.categories.show', ['slug' => $category->slug]) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection