@extends('layout')

@section('title', 'Show Post')

@section('content')
    <h1 class="title">{{ $post->title }}</h1>
    <h3 class="post-author">{{ $post->owner()->first()->name }}</h3>
    <hr />

    <div class="content">
        <p class="paragraph">
            {{ $post->content }}
        </p>

        <p>
            <i class="fas fa-thumbs-up"></i> {{ $post->likesCount() }}
        </p>

        @if(auth()->check())
            @can('update', $post)
                <p>
                    <a href="/posts/{{ $post->id }}/edit">Edit</a>
                </p>
            @endcan
            @if(! $post->isLiked())
                <form method="POST" action="/posts/{{ $post->id }}/like">
                    @method('PATCH')
                    @csrf
                    <button type="submit" class="button is-link" onClick="this.form.submit()"><i class="fas fa-thumbs-up"></i></button>
                </form>
            @else
                <form method="POST" action="/posts/{{ $post->id }}/unlike">
                    @method('PATCH')
                    @csrf
                    <button type="submit" class="button is-danger" onClick="this.form.submit()"><i class="fas fa-thumbs-down"></i></button>
                </form>
            @endif
        @endif
    </div>

    @if($post->comments->count())
        <hr />
        <h1 class="title">Comments</h1>
        @foreach($post->comments as $comment)
            <div class="box">
                <div class="columns">
                    <div class="column is-one-quarter">
                        <p class="comment-author">
                            {{ $comment->owner()->first()->name }}
                        </p>
                        <p>
                            <i class="fas fa-thumbs-up"></i> {{ $comment->likesCount() }}
                        </p>
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
                    <div class="column comment-content">
                        <p class="paragraph">
                            {{ $comment->content }}
                        </p>
                        @if(auth()->check())
                            @can('update', $comment)
                                <p>
                                    <a href="/comments/{{ $comment->id }}/edit">Edit</a>
                                </p>
                            @endcan
                        @endif
                    </div>
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
