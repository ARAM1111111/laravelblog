<?php
namespace App\Contracts;

interface CategoryServiceInterface{

	public function createCategory($data);
	public function updateCategory($id,$data);
	public function deleteCategory($id);
	public function getAllCategories();
	public function getCategory($id);
	public function securityCategory($id);
}