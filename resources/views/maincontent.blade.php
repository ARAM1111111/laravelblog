{{-- =============== All POSTS ============== --}}
@if(isset($allPosts))
	<h1>IN SITE {{$allPosts->count()}} POSTS</h1>	
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
@endif
{{-- ================= END ALL POSTS ============= --}}

{{-- =============== SHOW MY CATEGORIAS ============== --}}
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

{{-- =============== END SHOW MY CATEGORIAS ============== --}}

{{-- ==================== CREAT MY CATEGORY =============  --}}
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
{{-- ==================== END CREAT MY CATEGORY =============  --}}

{{-- =============== UPDATE MY CATEGORY ============== --}}
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
{{-- =============== END UPDATE MY CATEGORy ============== --}}

{{-- =============== UPDATE MY POST ============== --}}
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
{{-- =============== END UPDATE MY POST ============== --}}


{{-- ======================= SHOW MY POSTS ===================== --}}
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

{{-- =======================END SHOW MY POSTS ===================== --}}


{{-- ============ SHOW POST DESCRIPTION ============================ --}}
@if(isset($onePost))
  	  <hr>
      <h2>{{$onePost->title}}</h2>
      <h5><span class="glyphicon glyphicon-time"></span> Post by {{$onePost->user->name}}, {{$onePost->created_at->format('d M Y')}}.</h5>
      <h5>Category <span class="label label-primary">{{$onePost->category->name}}</span></h5><br>
      <p>{{$onePost->text}}</p>
      <br><br>

@endif

{{-- ============END SHOW POST DESCRIPTION ============================ --}}


{{-- ================ CREATE NEW POST ================================ --}}
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

{{-- ================END CREATE NEW POST ================================ --}}
