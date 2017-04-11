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
    public function index(Category $category) {
      
        $mycategory = $category->where('user_id',Auth::user()->id)->orderBy('id','desc')->paginate(10);
       
        return view('home',['mycategory'=>$mycategory,'title'=>'MY CATEGORY']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }
   //dd($categoryService->createCategory());
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
         $categoryid = Category::findOrFail($id);
         $title = "EDIT CATEGORY PAGE";
        return view('/home',compact('categoryid','title'));

        //return redirect()->route('category.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id){
        $user = Auth::user()->id; 
        $data = $request->except('_token');  
        $updat = Category::findOrFail($id);
        $updat->name = $data['updcategname'];
        $updat->user_id = $user;
        $updat->save();
        return redirect()->route('category.index')->with('status','CATEGORY UPDATED');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $delcategory = Category::findOrFail($id);
        $delcategory->delete();
        return redirect()->route('category.index')->with('status','CATEGORY DELETED');
    }


    public function add(CategoryRequest $request, Category $category){
        if($request->method('post'))
        {       
            $user = Auth::user()->id; 
            $data = $request->except('_token');
            $category->create([
                'name'=>$data['add_name'],
                'user_id'=>$user,
            ]);
            return redirect()->route('category.index')->with('status','NEW CATEGORY ADDED');
        }
    }
}
