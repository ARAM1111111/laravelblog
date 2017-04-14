@extends('layouts.app')

@section('content')
@if(isset($allPosts))
  <h1>All posts</h1> 
     @foreach($allPosts as $post)
      <hr>
      <h2>{{$post->title}}</h2>
        <h5><span class="glyphicon glyphicon-time"></span> Post by {{$post->user->name}}, {{$post->created_at->format('d M Y')}}.</h5>
        <h5>Category <span class="label label-primary">{{$post->category->name}}</span></h5><br>
        <p>{!! str_limit($post->text,$limit=120,$end='......<a href='.url('show/'.$post->id).'>READ MORE</a>') !!}</p>
        <br><br>
      @endforeach
      <div class="paginate col-md-offset-5">
      {!!$allPosts->links()!!}
    </div>
    @if(!$allPosts->count() > 0)
    <h1>No resoult for showing</h1>
    @endif
@endif
@endsection
