<?php
namespace App\Contracts;

interface PostServiceInterface{

	public function createPost($data);
	public function editPost($id);
	public function updatePost($id,$data);
	public function deletePost($id);
	public function getAllPosts();
	public function getUserPosts();
	public function getOnePost($id);
	public function securityPost($id);
}