@extends('layouts.default')
@section('content')

    @foreach ($posts as $post)
    <div>
        <span>{{ $post->title }}</span> at <span>{{ $post->created_at }}</span> by {{$post->user->name}}
        <p>{{ $post->body }}</p>
    </div>
    @endforeach

@endsection