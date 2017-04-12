<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\Category;
use App\Models\Post;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Contracts\CategoryServiceInterface;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category) 
    {      
        $mycategory = $category->where('user_id',Auth::user()->id)->orderBy('id','desc')->paginate(10);
        return view('home',['mycategory'=>$mycategory,'title'=>'MY CATEGORY']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) 
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,CategoryServiceInterface $categoryService) 
    {
        $categoryid  =$categoryService->GetCategory($id);
        $title = "EDIT CATEGORY PAGE";
        return view('/home',compact('categoryid','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id,CategoryServiceInterface $categoryService)
    {
        $user = Auth::user()->id; 
        $data = $request->except('_token');
        if ($categoryService->SecurityCategory($id)) {
            $categoryService->UpdateCategory($id,$data,$user); 
            return redirect()->route('category.index')->with('status','CATEGORY UPDATED');
        } else { 
            redirect()->route('category.index')->with('status','You havent premission'); 
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,CategoryServiceInterface $categoryService) 
    {
        if ($categoryService->SecurityCategory($id)) {
            $categoryService->DeleteCategory($id);
            return redirect()->route('category.index')->with('status','CATEGORY DELETED');
        } else { 
            redirect()->route('category.index')->with('status','You havent premission'); 
        }
        
    }

    public function add(CategoryRequest $request, Category $category,CategoryServiceInterface $categoryService)
    {
        if ($request->method('post')) {       
            $user = Auth::user()->id; 
            $data = $request->except('_token');
            $categoryService->createCategory($user,$data);   
            return redirect()->route('category.index')->with('status','NEW CATEGORY ADDED');
        }
    }
}
