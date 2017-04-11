<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
         'title', 'text', 'category_id','user_id'
    ];

     public function category(){
    	return $this->belongsTo('App\Models\Category');
    } 

    public function user(){
    	return $this->belongsTo('App\User');
    } 
}
