@extends('layouts.app')

@section('content')
@if(isset($newPost))
<div class="modal-body">
	<form method="post"  action="{{route('posts.store')}}">
        {{csrf_field()}}
      <div class="form-group">
      	<input type="hidden" name="userid" value="{{Auth::user()->id}}">
        <label for="ptitle">Post title</label>
        <input type="text" name="title" class="form-control" id="ptitle">
        <label for="ptext">Post text</label>
        <textarea name="text" cols="30" rows="10" class="form-control" id="ptext"></textarea><br>
        <label for="ptext">SELECT CATEG</label>
		<select class="form-control" name="category_id">
			 @foreach($categories as $category )
			  	<option value="{{$category->id}}">{{$category->name}}</option>
			 @endforeach
		</select>
      </div>
         <input type="submit" class="btn btn-success" value='ADD'>
         <a href="{{route('posts.index')}}" class="btn btn-default" >CANCEL</a>
    </form>
</div>              
@endif
@endsection