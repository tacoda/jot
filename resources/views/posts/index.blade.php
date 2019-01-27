@extends('layout')

@section('title', 'Posts')

@section('content')
    <h1 class="title">Posts</h1>

    @foreach($posts as $post)
        <div class="box">
            <div class="columns">
                <div class="column is-one-quarter">
                    <p>
                        <i class="fas fa-thumbs-up"></i> {{ $post->likesCount() }}
                    </p>
                </div>
                <div class="column">
                    <h3>
                        <a href="/posts/{{ $post->id }}">
                            {{ $post->title }}
                        </a>
                    </h3>
                    <h3>{{ $post->owner()->first()->name }}</h3>
                </div>
            </div>
        </div>
    @endforeach
@endsection