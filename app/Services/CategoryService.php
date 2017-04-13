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

    public function createCategory($user, $data) 
    {
        $this->category ->create([
            'name' => $data['add_name'],
            'user_id' => $user,
        ]);
    }

    public function updateCategory($id, $data, $user) 
    {
        $updat = $this->category->findOrFail($id);
        $updat->name = $data['add_name'];
        $updat->user_id = $user;
        $updat->save();
    }

    public function deleteCategory($id) 
    {
        $delcategory = $this->category->findOrFail($id);
        $delcategory->delete();
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
          // ETE IRA GRACI HETA MANIPULIACIANER ANUM
            return true;   
        }
    }

    public function getUserCategories() 
    {
        return $this->category->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
    }
}



