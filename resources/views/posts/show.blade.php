@extends('layout')

@section('title', 'Show Post')

@section('content')
    <h1 class="title">{{ $post->title }}</h1>

    <div class="content">
        {{ $post->content }}

        @can('update', $post)
        <p>
            <a href="/posts/{{ $post->id }}/edit">Edit</a>
        </p>
        @endcan
    </div>

    @if($post->comments->count())
        @foreach($post->comments as $comment)
            <div class="box">
                <div>
                    <p>
                        {{ $comment->owner()->first()->name }} commented:
                    </p>
                    <p>
                        {{ $comment->content }}
                    </p>

                    <p>
                        Likes: {{ $comment->likesCount() }}
                    </p>

                    @can('update', $comment)
                    <p>
                        <a href="/comments/{{ $comment->id }}/edit">Edit</a>
                    </p>
                    @endcan
                    @if(auth()->check())
                        @if(! $comment->isLiked())
                        <form method="POST" action="/comments/{{ $comment->id }}/like">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="button is-link" onClick="this.form.submit()"><i class="fas fa-thumbs-up"></i></button>
                        </form>
                        @else
                        <form method="POST" action="/comments/{{ $comment->id }}/unlike">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="button is-danger" onClick="this.form.submit()"><i class="fas fa-thumbs-down"></i></button>
                        </form>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    @endif

    @if(auth()->check())
    <form class="box" method="POST" action="/posts/{{ $post->id }}/comments">
        @csrf
        <div class="field">
            <label class="label" for="content">New Comment</label>

            <div class="control">
                <textarea name="content" class="textarea" placeholder="Post Comment" required></textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Add Comment</button>
            </div>
        </div>

        @include('errors')
    </form>
    @endif

@endsection
