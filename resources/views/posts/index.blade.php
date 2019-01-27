@extends('layout')

@section('title', 'Posts')

@section('content')
    <h1 class="title">Posts</h1>

    @foreach($posts as $post)
        <div class="box">
            <a href="/posts/{{ $post->id }}">
                <h3>{{ $post->title }}</h3>
            </a>
        </div>
    @endforeach
@endsection