@extends('layout')

@section('title', 'Show Post')

@section('content')
    <h1 class="title">{{ $post->title }}</h1>

    <p class="paragraph">
        {{ $post->body }}
    </p>

    <p>
        <a href="/posts/{{ $post->id }}/edit">Edit</a>
    </p>
@endsection
