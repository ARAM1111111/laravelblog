@extends('layouts.app')

@section('content')
@if(isset($categoryId))
<h4><small>{{$title}}</small></h4>
<div class="row">
	<form method="post" class="col-md-6" action="{{route('category.update', $categoryId->id)}}">
      {{csrf_field()}}
      {{method_field('PUT')}}
      <div class="form-group">
            <label for="updcategname">Edit category name</label>
            <input type="text" name="name" class="form-control" id="updcategname" value="{{$categoryId->name}}">
      </div>
			<input type="submit" class="btn btn-success" value="UPDATE">
        <a href="{{route('category.index')}}" class="btn btn-default" >CANCEL</a>
	</form>
</div>
@endif
@endsection