@extends('layout')

@section('title', 'Create Post')

@section('content')
    <h1>Create a New Post</h1>

    <form method="POST" action="/posts">
        {{ csrf_field() }}

        <div>
            <input type="text" name="title" placeholder="Post Title">
        </div>

        <div>
            <textarea name="body" placeholder="Post Body"></textarea>
        </div>

        <div>
            <button type="submit">Create Post</button>
        </div>
    </form>
@endsection