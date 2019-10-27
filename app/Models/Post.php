<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    protected $table = 'posts';

    // tao 1 ham dinh nghia moi quan he voi bang categories
    public function categories()
    {
    	return $this->belongsTo('App\Models\Category');
    }

    public function post_tag()
    {
    	return $this->hasMany('App\Models\PostTag');
    }

    public function tags()
    {
    	return $this->belongsToMany('App\Models\Tag');
    }

    public function post_contents()
    {
        return $this->hasOne('App\Models\PostContent');
    }

    public function insertDataPost($data)
    {
        DB::table('posts')->insert($data);
        // lay ra id vua insert
        $id = DB::getPdo()->lastInsertId();
        return $id;
    }

    public function getAllDataPosts($keyword = '')
    {
        $data = DB::table('posts AS p')
                        ->select('p.*','c.name_cate','a.fullname')
                        ->join('categories AS c','p.categories_id', '=', 'c.id')
                        ->join('admins AS a', 'p.admins_id', '=', 'a.id')
                        ->where('p.title', 'like', '%'.$keyword.'%')
                        ->orWhere('p.sapo', 'like', '%'.$keyword.'%')
                        ->paginate(5); // 5 bai viet tren mot trang

        return $data;
    }

    public function deletePostById($id)
    {
        $del = DB::table('posts')
                    ->where('id', $id)
                    ->delete();
        return $del;
    }

    public function getInfoDatPostById($id)
    {
        $data = DB::table('posts AS p')
                ->select('p.*', 'pc.content_web')
                ->join('post_contents AS pc', 'pc.posts_id', '=', 'p.id')
                ->where('p.id', $id)
                ->first();
        $data = json_decode(json_encode($data),true);
        return $data;
    }

    public function updateDataPostById($data, $id)
    {
        $up = DB::table('posts')
                ->where('id', $id)
                ->update($data);
                
        return $up;
    }


    /*********** For frontend ***********/
    public function getListPostsByPublishDate()
    {
        $today = date('Y-m-d H:i:s');
        $data = DB::table('posts AS p')
            ->select('p.*', 'c.name_cate', 'c.parent_id', 'a.fullname')
            ->join('categories AS c', 'c.id', '=', 'p.categories_id')
            ->join('admins AS a', 'a.id', '=', 'p.admins_id')
            ->where('p.publish_date', '<=', $today)
            ->where('p.status', 1)
            ->orderBy('p.publish_date', 'DESC')
            ->paginate(11);

        return $data;
    }

    // lay ra 3 bai viet co luot xem cao nhat
    public function popularPost()
    {
        $today = date('Y-m-d H:i:s');
        $data = DB::table('posts AS p')
            ->select('p.*')
            ->where('p.publish_date', '<=', $today)
            ->where('p.status', 1)
            ->orderBy('p.count_view', 'DESC')
            ->limit(3)
            ->get();
        return $data;
    }

}
