<?php
namespace App\Contracts;

interface CategoryServiceInterface{

	public function createCategory($user,$data);
	public function UpdateCategory($id,$data,$user);
	public function DeleteCategory($id);
	public function GetAllCategories();
	public function GetCategory($id);
	public function SecurityCategory($id);
}