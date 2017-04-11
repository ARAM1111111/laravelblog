<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Category;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Contracts\PostServiceInterface;
use App\Contracts\CategoryServiceInterface;

class PostController extends Controller
{
    public function __construct(Post $post){
        $this->post = $post;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $myposts = $this->post->where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(10);
         return view('home',['myposts'=>$myposts,'title'=>'MY POSTS']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category){
        $categories =  $category->all();
       return view('home',['newpost'=>'newpost','categories'=>$categories]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request,Category $category,PostServiceInterface $postservice){
      
        $user = Auth::user()->id; 
        $data = $request->except('_token');
        $postservice->createPost($user,$data);
        return redirect()->route('posts.index')->with('status','NEW POST ADDED');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){          
        $onepost = $this->post->where('id',$id)->with('category')->first(); 
        $onepost['username'] = Auth()->user()->name;
        return view('/home',compact('onepost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,PostServiceInterface $postservice,CategoryServiceInterface $categoryservice){
        $postid = $postservice->EditPost($id);
        $categorias = $categoryservice->GetAllCategories();
        $title = "EDIT POST PAGE";
        return view('/home',compact('postid','title','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id,PostServiceInterface $postservice){
        $user = Auth::user()->id; 
        $data = $request->except('_token');
        $postservice->UpdatePost($id,$data,$user);
        return redirect()->route('posts.index')->with('status','POST UPDATED');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,PostServiceInterface $postservice){
        $postservice->DeletePost($id);
        return redirect()->route('posts.index')->with('status','POST DELETED');
    }
}
