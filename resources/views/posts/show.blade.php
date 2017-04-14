@extends('layouts.app')

@section('content')
@if(isset($onePost))
      <hr>
      <h2>{{$onePost->title}}</h2>
      <h5><span class="glyphicon glyphicon-time"></span> Post by {{$onePost->user->name}}, {{$onePost->created_at->format('d M Y')}}.</h5>
      <h5>Category <span class="label label-primary">{{$onePost->category->name}}</span></h5><br>
      <p>{{$onePost->text}}</p>
      <br><br>
@endif
@endsection