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
}
