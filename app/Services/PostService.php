<?php
namespace App\Services;

use App\Contracts\PostServiceInterface;
use App\Models\Post;
use Auth;

class PostService implements PostServiceInterface
{
    public function __construct(Post $post)
    {      
       $this->post = $post;
    }

    public function getAllPosts() 
    {
        return $this->post->with(['user','category'])->orderBy('created_at', 'DESC')->paginate(10);
    }

    public function getUserPosts() 
    {
        return $this->post->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
    }

	public function createPost($data)
	{
        return $this->post ->create($data);
	}

    public function editPost($id)
    {
        $postid = $this->post->findOrFail($id);
        return $postid;
    }

    public function updatePost($id, $data)
    {
        return $this->post->findOrFail($id)->update($data);
    }

    public function deletePost($id)
    {
       $delpost = $this->post->findOrFail($id)->delete();
       return true;
    }

    public function getOnePost($id) 
    {
        return $this->post->where('id', $id)->with('category')->first();
    }

    public function securityPost($id)
    {
        if (Auth::user()->id == $this->post->findOrFail($id)->user_id) {
            return true;
        }
    }
}