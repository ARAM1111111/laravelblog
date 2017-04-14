@extends('layouts.app')

@section('content')
@if(isset($myCategory))
	<h4><small>{{$title}}</small></h4>
    <div class="row">
		<table class="table table-bordered">
			<tr>
			   <th>NAME</th>
			   <th style="width: 20%;text-align: center;">Actions</th>
			</tr>
			<a href="{{route('category.create')}}" class="btn btn-info pull-right addcateg">CREATE NEW CATEGORY</a>
			@foreach($myCategory as $k => $category)
			  <tr>
				<td>{{$category->name}}</td>
				<td>
					<form action="{{route('category.destroy',$category->id)}}" method="post">
						{{method_field('delete')}}
						{{csrf_field()}}
						<a href="{{route('category.edit',$category->id)}}" class="btn btn-primary" id="categ">EDIT</a>
						<input type="submit" class="btn btn-danger" onclick="return confirm('ARE YOU SHURE???')" name='name' value='DELETE'>
					</form>		
				</td>
			  </tr>
			@endforeach
		</table>
		<div class="paginate col-md-offset-5">
			{!!$myCategory->links()!!}
		</div>		
	</div>
@endif
@endsection