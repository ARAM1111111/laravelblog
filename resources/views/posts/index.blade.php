@extends('layouts.app')

@section('content')
@if(isset($myPosts))
<h4><small>{{$title}}</small></h4>
<div class="row">
		<table class="table table-bordered">
			<tr>
				<th>TITLE</th>
				<th>TEXT</th>
				<th>CREATED_AT</th>
				<th style="width: 15%;text-align: center;">Actions</th>
			</tr>
			<a href="{{route('posts.create')}}" class="btn btn-info pull-right addcateg" >CREATE NEW POST</a>
			{{-- {{route('category.create')}} --}}
			@foreach($myPosts as $k=>$post)
				<tr>
				<td>{{$post->title}}</td>
				<td>{!! str_limit($post->text, $limit=90, $end='......<a href='.route('posts.show',$post->id).'>READ MORE</a>') !!}</td>
				<td>{{$post->created_at->format('d M Y')}}</td>
				<td>
					<form action="{{route('posts.destroy', $post->id)}}" method="post">
						{{method_field('delete')}}
						{{csrf_field()}}
						<a href="{{route('posts.edit', $post->id)}}" class="btn btn-primary" id="categ">EDIT</a>
						<input type="submit" class="btn btn-danger" onclick="return confirm('ARE YOU SHURE???')" name='name' value='DELETE'>
					</form>		
				</td>
			</tr>
			@endforeach
		</table>
		<div class="paginate col-md-offset-5">
			{!!$myPosts->links()!!}
		</div>	
	</div>
@endif
@endsection