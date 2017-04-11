<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'name', 'title', 'text', 'category_id','user_id'
    ];

    //  public function author(){
    // 	return $this->belongsTo('App\User','author_id');
    // }

     public function categname(){
    	return $this->belongsTo('App\Models\Category','category_id');
    }
}
