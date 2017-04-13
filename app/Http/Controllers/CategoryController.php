<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\CategoryRequest;
use App\Contracts\CategoryServiceInterface;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryServiceInterface $categoryService) 
    {      
        $myCategory = $categoryService->getUserCategories();
        return view('home',['myCategory' => $myCategory,'title' => 'MY CATEGORY']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home', ['createCategory' => true, 'title' => "Create new Category"]); 
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, CategoryServiceInterface $categoryService) 
    {
        $user = Auth::user()->id; 
        $data = $request->except('_token');
        if ($categoryService->createCategory($user, $data)) {
            return redirect()->route('category.index')->with('status', 'NEW CATEGORY ADDED');
        } else {
            return redirect()->route('category.index')->with('status', 'CATEGORY DONT CREATED');    
        }
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
    public function edit($id, CategoryServiceInterface $categoryService) 
    {
        $categoryId  = $categoryService->getCategory($id);
        $title = "EDIT CATEGORY PAGE";
        return view('/home',compact('categoryId', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id, CategoryServiceInterface $categoryService)
    {
        $user = Auth::user()->id; 
        $data = $request->except('_token');
        if ($categoryService->securityCategory($id)) {
            $categoryService->updateCategory($id, $data, $user); 
            return redirect()->route('category.index')->with('status', 'CATEGORY UPDATED');
        } else { 
            redirect()->route('category.index')->with('status', 'You havent premission'); 
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, CategoryServiceInterface $categoryService) 
    {
        if ($categoryService->securityCategory($id)) {
            $categoryService->deleteCategory($id);
            return redirect()->route('category.index')->with('status', 'CATEGORY DELETED');
        } else { 
            redirect()->route('category.index')->with('status', 'You havent premission'); 
        }   
    }
}
