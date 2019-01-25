@extends('layout')

@section('title', 'Edit Post')

@section('content')
    <h1 class="title">Edit Post</h1>

    <form method="POST" action="/posts/{{ $post->id }}" style="margin-bottom: 1em;">
        @method('PATCH')
        @csrf

        <div class="field">
            <label class="label" for="title">Title</label>

            <div class="control">
                <input type="text" class="input" name="title" placeholder="Title" value="{{ $post->title }}">
            </div>
        </div>

        <div class="field">
            <label class="label" for="body">Body</label>

            <div class="control">
                <textarea name="content" class="textarea">{{ $post->content }}</textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Update Post</button>
            </div>
        </div>
    </form>

    <form method="POST" action="/posts/{{ $post->id }}">
        @method('DELETE')
        @csrf

        <div class="field">
            <div class="control">
                <button type="submit" class="button">Delete Post</button>
            </div>
        </div>
    </form>

    @include('errors')
@endsection
