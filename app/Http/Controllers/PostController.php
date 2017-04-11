<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\Category;
use App\Models\Post;
use App\Http\Requests\PostRequest;
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
    public function index(Category $category){
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
    public function store(PostRequest $request,Category $category){

        $user = Auth::user()->id; 
        $data = $request->except('_token');
        $this->post->create([
            'title'=>$data['ptitle'],
            'text'=>$data['ptext'],
            'category_id'=>$data['category'],
            'user_id'=>$user,
        ]);
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
    public function edit($id){
        $postid = Post::findOrFail($id);
        $categorias = Category::all(); 
        $title = "EDIT POST PAGE";
        // dump($postid);
        return view('/home',compact('postid','title','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id){
        $user = Auth::user()->id; 
        $data = $request->except('_token');
        $post = Post::findOrFail($id);
        $post->title = $data['ptitle'];
        $post->text = $data['ptext'];
        $post->category_id = $data['category'];
        $post->user_id = $user;
        $post->update();
        return redirect()->route('posts.index')->with('status','POST UPDATED');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
       $delpost = Post::findOrFail($id);
       $delpost->delete();
       return redirect()->route('posts.index')->with('status','POST DELETED');
    }
}
