<?php
namespace App\Services;

use App\Contracts\CategoryServiceInterface;
use App\Models\Category;
use Auth;

class CategoryService implements CategoryServiceInterface
{
    public function __construct(Category $category) 
    {
        $this->category = $category;
    }

    public function createCategory($data) 
    {
        return $this->category ->create($data);
    }

    public function updateCategory($id, $data) 
    {
        return $this->category->findOrFail($id)->update($data);
    }

    public function deleteCategory($id) 
    {
        $delcategory = $this->category->findOrFail($id)->delete();
        return true;
    }

    public function getAllCategories() 
    {
        return $this->category->all();
    }

    public function getCategory($id) 
    {
        return $this->category->findOrFail($id);
    }

    public function securityCategory($id) 
    {
        if (Auth::user()->id == $this->category->findOrFail($id)->user_id) {
          // IF HIS WRITE
            return true;   
        }
    }

    public function getUserCategories() 
    {
        return $this->category->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
    }
}



