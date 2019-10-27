<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    // lay ra 5 cate co bai viet nhieu nhat
    public function getDataCategoriesByPost()
    {
        $data = DB::table('categories AS c')
                ->select('c.*','p.id AS post_id')
                ->join('posts AS p', 'p.categories_id', '=', 'c.id')
                ->get();
        return $data;

    }
    
}
