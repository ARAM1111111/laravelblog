<?php
namespace App\Services;

use App\Contracts\PostServiceInterface;
use App\Models\Post;
use Auth;

class PostService implements PostServiceInterface{

    public function __construct(Post $post){
        
       $this->post  = $post;
   }


	public function createPost($user,$data)
	{
	    $this->post->create([
            'title'=>$data['ptitle'],
            'text'=>$data['ptext'],
            'category_id'=>$data['category'],
            'user_id'=>$user,
        ]);
	}

    public function EditPost($id)
    {
        $postid = $this->post->findOrFail($id);
        return $postid;
    }

    public function UpdatePost($id,$data,$user)
    {
        $this->post = Post::findOrFail($id);
        $this->post->title = $data['ptitle'];
        $this->post->text = $data['ptext'];
        $this->post->category_id = $data['category'];
        $this->post->user_id = $user;
        $this->post->update(); 
    }

    public function DeletePost($id)
    {
       $delpost = $this->post->findOrFail($id);
       $delpost->delete();

    }

    public function SecurityPost($id)
    {
        if(Auth::user()->id == $this->post->findOrFail($id)->user_id) {

          return true;

        }
    }
}