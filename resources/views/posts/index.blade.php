@extends('layout')

@section('title', 'Posts')

@section('content')
    <h1 class="title">Posts</h1>

    <ul>
        @foreach($posts as $post)
            <li>
                <a href="/posts/{{ $post->id }}">
                    {{ $post->title }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection