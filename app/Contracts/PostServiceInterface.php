<?php
namespace App\Contracts;

interface PostServiceInterface{

	public function createPost($user,$data);
	public function EditPost($id);
	public function UpdatePost($id,$data,$user);
	public function DeletePost($id);
}