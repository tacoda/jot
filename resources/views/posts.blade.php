@extends('layout')

@section('title', 'Posts')

@section('content')
    <h1>Posts!</h1>

    <h1>Tasks</h1>
    <ul>
        @foreach($tasks as $task)
            <li>{{ $task }}</li>
        @endforeach
    </ul>
@endsection
