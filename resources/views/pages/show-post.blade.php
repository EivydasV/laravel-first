@extends('main')
@section('content')

<div class="container">
    <h1 class="mt-4">{{$post->title}}</h1>
    <p>{{$post->content}}</p>
    <img src="{{ asset('storage'.$post->image) }}" class="img-thumbnail"/>
    <div class="mt-2">
        <h3>Post controll</h3>
        <ul>
            <li><a href="{{route('edit-post', $post->id)}}">Edit</a></li>
            <li><a onclick="return confirm('Are you sure?')" href="{{route('destroy-post', $post->id)}}">Delete</a></li>

        </ul>
    </div>
</div>
@endsection