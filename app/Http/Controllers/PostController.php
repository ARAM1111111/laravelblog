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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostServiceInterface $postservice) 
    {
        $myposts = $postservice->getUserPosts();
        return view('home', ['myposts' => $myposts,'title' => 'MY POSTS']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryServiceInterface $categoryservice) 
    {
        $categories = $categoryservice->getAllCategories();
        return view('home', ['newpost' => 'newpost','categories' => $categories]);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, PostServiceInterface $postservice) 
    {  
        $user = Auth::user()->id; 
        $data = $request->except('_token');
        $postservice->createPost($user, $data);
        return redirect()->route('posts.index')->with('status', 'NEW POST ADDED');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, PostServiceInterface $postservice)
    {  
        $onepost = $postservice->getOnePost($id); 
        $onepost['username'] = Auth()->user()->name;
        return view('/home', compact('onepost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, PostServiceInterface $postservice, CategoryServiceInterface $categoryservice) 
    {
        $postid = $postservice->editPost($id);
        $categorias = $categoryservice->getAllCategories();
        $title = "EDIT POST PAGE";
        return view('/home', compact('postid', 'title', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id, PostServiceInterface $postservice) 
    {
        $user = Auth::user()->id; 
        $data = $request->except('_token');
        if ($postservice->securityPost($id)) {
            $postservice->updatePost($id, $data, $user);
            return redirect()->route('posts.index')->with('status', 'POST UPDATED');
        } else {
            redirect()->route('posts.index')->with('status', 'You havent premission'); 
        }      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id, PostServiceInterface $postservice) 
    {
        if ($postservice->securityPost($id)) {
            $postservice->deletePost($id);
            return redirect()->route('posts.index')->with('status', 'POST DELETED');
        } else {    
            redirect()->route('posts.index')->with('status', 'You havent premission');
        }
    }
}
