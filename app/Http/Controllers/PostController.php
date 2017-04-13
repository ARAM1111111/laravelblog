<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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
    public function index(PostServiceInterface $postService) 
    {
        $myPosts = $postService->getUserPosts();
        return view('home', ['myPosts' => $myPosts,'title' => 'MY POSTS']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryServiceInterface $categoryService) 
    {
        $categories = $categoryService->getAllCategories();
        return view('home', ['newPost' => 'newPost','categories' => $categories]);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, PostServiceInterface $postService) 
    {  
        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id; 
        if ($postService->createPost($data)) {
            return redirect()->route('posts.index')->with('success', 'NEW POST ADDED');
        } else {
            return redirect()->route('posts.index')->with('warning', 'POST DONT ADDED');
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, PostServiceInterface $postService)
    {  
        if ($postService->getOnePost($id)) {
            $onePost = $postService->getOnePost($id); 
            $onePost['username'] = Auth()->user()->name;
            return view('/home', compact('onePost'));    
        } else {
            return view('/home')->with('warning', 'CANT FIND POST'); 
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, PostServiceInterface $postService, CategoryServiceInterface $categoryService) 
    {
        $postId = $postService->editPost($id);
        $categorias = $categoryService->getAllCategories();
        $title = "EDIT POST PAGE";
        return view('/home', compact('postId', 'title', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id, PostServiceInterface $postService) 
    {
        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id; 
        if ($postService->securityPost($id)) {
            if ($postService->updatePost($id, $data)) {
                return redirect()->route('posts.index')->with('success', 'POST UPDATED');
            } else {
                return redirect()->route('posts.index')->with('warning', 'POST DONT UPDATED');
            }     
        } else {
            redirect()->route('posts.index')->with('warning', 'YOU HAVENT PREMISSION'); 
        }      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id, PostServiceInterface $postService) 
    {
        if ($postService->securityPost($id)) {
            if ($postService->deletePost($id)) {
                return redirect()->route('posts.index')->with('success', 'POST DELETED');    
            } else {
                return redirect()->route('posts.index')->with('warning', 'POST DONT DELETED');
            }       
        } else {    
            redirect()->route('posts.index')->with('warning', 'YOU HAVENT PREMISSION');
        }
    }
}
