@extends('main')
@section('content')
@foreach ($posts as $post)
<div class="col-md-10 col-lg-8 col-xl-7">
    <!-- Post preview-->
    <div class="post-preview">
        <a href="/post/{{$post->id}}">
            <h2 class="post-title">{{$post->title}}</h2>
            <h3 class="post-subtitle">{{$post->content}}</h3>
        </a>
        <p class="post-meta">
            Posted by
            <a href="#!">Start Bootstrap</a>
            {{$post->created_at}}
        </p>
    </div>
    @if ($post->image)
        <img src="{{ asset('storage'.$post->image) }}" class="img-thumbnail"/>
    @endif
    <!-- Divider-->
    <hr class="my-4" />

</div>
@endforeach
<div class="container d-flex justify-content-center mt-2">

    {{ $posts->links() }}
</div>
      
@endsection
