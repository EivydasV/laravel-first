@extends('main')
@section('content')

<form action="{{route('store')}}" method="POST" enctype="multipart/form-data">
  @csrf
  @include('_partials.errors')
    <div class="form-group">
      <label>Title</label>
      <input type="text" name="title" class="form-control" placeholder="Title">
    </div>
    <div class="form-group">
      <label>Content</label>
      <textarea name="content" cols="30" rows="10" class="form-control" placeholder="Content"></textarea>
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