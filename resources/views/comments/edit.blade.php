@extends('layout')

@section('title', 'Edit Comment')

@section('content')
    <h1 class="title">Edit Comment</h1>

    <form method="POST" action="/comments/{{ $comment->id }}" style="margin-bottom: 1em;">
        @method('PATCH')
        @csrf

        <div class="field">
            <label class="label" for="content">Content</label>

            <div class="control">
                <textarea name="content" class="textarea">{{ $comment->content }}</textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Update Comment</button>
            </div>
        </div>
    </form>

    <form method="POST" action="/comments/{{ $comment->id }}">
        @method('DELETE')
        @csrf

        <div class="field">
            <div class="control">
                <button type="submit" class="button">Delete Comment</button>
            </div>
        </div>
    </form>

    @include('errors')
@endsection
