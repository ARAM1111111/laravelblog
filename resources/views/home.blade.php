@extends('layouts.app')

@section('content')

<div class="container-fluid">
@if(session('status'))
      <div class="alert alert-success">
        {{session('status')}}
      </div>
    @endif
     
    @if(count($errors)>0)
         <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $err)
               <li>{{$err}}</li>
            @endforeach
          </ul>
      </div>
    @endif
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <h4>MY BLOG</h4>
      <ul class="nav nav-pills nav-stacked">
        <li><a href="{{route('home')}}">ALL POSTS</a></li>
        <li><a  href="{{route('posts.index')}}">MY POSTS</a></li>
        <li><a class="" href="{{route('category.index')}}">MY CATEGORIES</a></li>
       
      <div class="col-md-6">
        <img src="{{asset('img/').'/'.Auth::user()->image}}">
      </div>
      </ul><br>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search Blog..">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </div>

    <div class="col-sm-9">
      @include('maincontent')  
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div id="form">
    
      </div>
            </div>  
          </div>       
  </div>
</div>
    </div>
  </div>
</div>

@endsection
