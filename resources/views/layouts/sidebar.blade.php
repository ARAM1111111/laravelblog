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