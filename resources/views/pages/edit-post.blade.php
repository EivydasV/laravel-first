@extends('main')
@section('content')

<form action="{{route('update-post', $post->id)}}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  @include('_partials.errors')
    <div class="form-group">
      <label>Title</label>
      <input type="text" name="title" class="form-control" placeholder="Title" value="{{$post->title}}">
    </div>
    <div class="form-group">
      <label>Content</label>
      <textarea name="content" cols="30" rows="10" class="form-control" placeholder="Content">{{$post->content}}</textarea>
    </div>
    <div class="form-group">
      <label for="">Add Image</label>
      <input type="file" name="image" id="">
    </div>
    <div class="form-group mt-2">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>

@endsection