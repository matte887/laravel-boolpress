@extends('layouts.dashboard')

@section('content')
    <h2>Edit this post</h2>
    <form action="{{ route('admin.posts.update', ['post' => $this_post->id]) }}" method="POST">
        @method('PUT')
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title"
                value="{{ old('title') ? old('title') : $this_post->title }}">
        </div>
        <div class="mb-3">
            <label for="category_id">Type</label>
            <select class="form-control" id="category_id" name="category_id">
                <option value="">Nessuna</option>
                @foreach ($categories as $category)
                    {{-- <option value="{{ $category->id }}" {{ $this_post->category && $this_post->category->id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option> --}}
                    {{-- Per usare old, si usa una funzionalità di laravel -> old('value', 'default') --}}
                    <option value="{{ $category->id }}"
                        {{ $this_post->category && old('category_id', $this_post->category->id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach

            </select>
        </div>

        <div class="my-4">
            <p>Select tags</p>
            @foreach ($tags as $tag)
                <div class="form-check">
                    <input name="tags[]" class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                        id="tag-{{ $tag->id }}"
                        {{ $this_post->tags->contains($tag) || in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $tag->id }}">
                        {{ $tag->name }}
                    </label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="10">{{ old('content') ? old('content') : $this_post->content }}</textarea>
        </div>

        @if ($this_post->cover)
            <img src="{{ asset('storage/' . $this_post->cover) }}" alt="">
        @endif
        <div class="form-group">
            <label for="cover_img">Sostituisci/carica immagine</label>
            <input type="file" class="form-control-file" id="cover_img" name="image">
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Commit changes</button>
    </form>
@endsection
