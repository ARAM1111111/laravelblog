<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
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
    public function index(Post $post, PostServiceInterface $postservice) 
    {
        $allposts = $postservice->getAllPosts();
        return view('home', compact('allposts'));
    }

    public function show($id, PostServiceInterface $postservice) 
    {  
        $onepost = $postservice->getOnePost($id);      
        return view('home', compact('onepost'));
    }
}
