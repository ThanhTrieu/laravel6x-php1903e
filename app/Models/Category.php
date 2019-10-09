<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    // tao 1 ham dinh nghia moi quan he voi bang posts
    public function posts()
    {
    	return $this->hasMany('App\Models\Post');
    }

    public function getAllDataCategories()
    {
    	$data = [];
    	$cate = Category::all();
    	if($cate){
    		$data = $cate->toArray();
    	}
    	return $data;
    }
}
