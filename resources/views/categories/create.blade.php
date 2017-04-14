@extends('layouts.app')

@section('content')
@if(isset($createCategory))
<h4><small>{{$title}}</small></h4>
<div class="row">
	<form method="post" action="{{route('category.store')}}">
		<div class="modal-body">
			<div class="form-group">
				<label for="add">Category name</label>
				{!! csrf_field() !!}
				<input type="text" name="name" class="form-control" id="add">
			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-success" value="ADD">
			<a href="{{route('category.index')}}" class="btn btn-default">Close</a>
		</div>
	</form>
</div>
@endif
@endsection