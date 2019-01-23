@extends('layout')

@section('title', 'Create Post')

@section('content')
    <h1 class="title">Create a New Post</h1>

    <form method="POST" action="/posts">
        @csrf

        <div class="field">
            <label class="label" for="title">Title</label>

            <div class="control">
                <input type="text" class="input {{ $errors->has('title') ? 'is-danger' : '' }}" name="title" value="{{ old('title') }}" placeholder="Post Title" required>
            </div>
        </div>

        <div class="field">
            <label class="label" for="body">Body</label>

            <div class="control">
                <textarea name="content" class="textarea {{ $errors->has('content') ? 'is-danger' : '' }}" placeholder="Post Content" required>{{ old('body') }}</textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Create Post</button>
            </div>
        </div>

        @include('errors')
    </form>
@endsection
