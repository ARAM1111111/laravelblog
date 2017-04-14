<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\CategoryServiceInterface;
use App\Contracts\PostServiceInterface;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(PostServiceInterface $postService) 
    {
        $allPosts = $postService->getAllPosts();
        return view('home', compact('allPosts'));
    }

    public function show($id, PostServiceInterface $postService) 
    {  
        if ($postService->getOnePost($id)) {
            $onePost = $postService->getOnePost($id); 
            $onePost['username'] = Auth()->user()->name;
            return view('posts.show', compact('onePost'));    
        } else {
            return view('/home')->with('warning', 'Cant find post'); 
        }
    }

    public function execute() 
    {
        return view('welcome');
    }
}
