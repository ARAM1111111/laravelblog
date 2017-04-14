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
        return view('categories.index',['myCategory' => $myCategory,'title' => 'My category']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create', ['createCategory' => true, 'title' => "Create new category"]); 
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, CategoryServiceInterface $categoryService) 
    {
        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id; 
        if ($categoryService->createCategory($data)) {
            return redirect()->route('category.index')->with('success', 'New category added');
        } else {
            return redirect()->route('category.index')->with('warning', 'Category dont added');    
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
        $title = "Edit category page";
        return view('categories.edit',compact('categoryId', 'title'));
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
        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id; 
        if ($categoryService->securityCategory($id) & $categoryService->updateCategory($id, $data)) {  
            return redirect()->route('category.index')->with('success', 'Category updated');        
        } else { 
            redirect()->route('category.index')->with('warning', 'Problem cant update'); 
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
        if ($categoryService->securityCategory($id) & $categoryService->deleteCategory($id)) {        
            return redirect()->route('category.index')->with('success', 'Category deleted');           
        } else { 
            redirect()->route('category.index')->with('warning', 'Problem cant delete'); 
        }   
    }
}
