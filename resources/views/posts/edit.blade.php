@extends('layouts.app')

@section('content')
@if(isset($postId))
<div class="modal-body">
  <form method="post"  action="{{route('posts.update', $postId->id)}}">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div class="form-group">
          <label for="ptitle">Post title</label>
          <input type="text" name="title" class="form-control" id="ptitle" value="{{$postId->title}}">
          <label for="ptext">Post text</label>
          <textarea name="text" cols="30" rows="10" class="form-control" id="ptext">{{$postId->text}}</textarea><br>
          <label for="ptext">SELECT CATEG</label>
      <select class="form-control" name="category_id">
        @foreach($categorias as $c => $category )
            <option value="{{$category->id}}" name="category" {{($category->id == $postId->category_id)?"selected":""}}>
              {{$category->name}}
            </option>
        @endforeach
      </select>
        </div>   
          <input type="submit" class="btn btn-success" value='UPDATE'>
          <a href="{{route('posts.index')}}" class="btn btn-default" >CANCEL</a>
  </form>
</div>     
@endif
@endsection