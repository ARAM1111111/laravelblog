<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Contracts\CategoryServiceInterface;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, CategoryServiceInterface $categoryService){
        //dd($categoryService->createCategory());
        $allposts =$post->with(['user','category'])->orderBy('created_at','DESC')->paginate(10);
        return view('home',compact('allposts'));
    }

    public function show($id){
       
        $onepost = Post::findOrFail($id);      
        return view('home',compact('onepost'));
    }
}
