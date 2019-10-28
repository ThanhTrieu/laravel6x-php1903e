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

    public function getDataCatePaigation($id)
    {
        $today = date('Y-m-d H:i:s');

        $data = DB::table('posts AS p')
                ->select('c.*','p.title', 'p.id AS post_id', 'p.slug', 'a.fullname','p.count_view','p.avatar','p.publish_date')
                ->join('categories AS c', 'c.id', '=', 'p.categories_id')
                ->join('admins AS a', 'a.id', '=', 'p.admins_id')
                ->where('p.publish_date', '<=', $today)
                ->where('p.status',1)
                ->where('p.categories_id', $id)
                ->paginate(8);
        return $data;
    }
    
}
