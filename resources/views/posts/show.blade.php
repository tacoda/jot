@extends('layout')

@section('title', 'Show Post')

@section('content')
    <h1 class="title">{{ $post->title }}</h1>

    <div class="content">
        {{ $post->content }}

        <p>
            <a href="/posts/{{ $post->id }}/edit">Edit</a>
        </p>
    </div>

    @if($post->comments->count())
    <div class="box">
        @foreach($post->comments as $comment)
            <div>
                {{ $comment->content }}

                <p>
                    Votes: {{ $comment->votes }}
                </p>
                <form method="POST" action="/comments/{{ $comment->id }}">
                    @method('PATCH')
                    @csrf
                    <button type="submit" class="button is-link" onClick="this.form.submit()" name="vote" value="up">Upvote</button>
                </form>

                <form method="POST" action="/comments/{{ $comment->id }}">
                    @method('PATCH')
                    @csrf
                    <button type="submit" class="button is-danger" onClick="this.form.submit()" name="vote" value="down">Downvote</button>
                </form>
            </div>
        @endforeach
    </div>
    @endif

    <form class="box" method="POST" action="/posts/{{ $post->id }}/comments">
        @csrf
        <div class="field">
            <label class="label" for="content">New Comment</label>

            <div class="control">
                <input type="text" class="input" name="content" placeholder="New Comment" required>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Add Comment</button>
            </div>
        </div>

        @include('errors')
    </form>

@endsection
