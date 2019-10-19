<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    protected $table = 'tags';

    public function post_tag()
    {
    	return $this->hasMany('App\Models\PostTag');
    }

    public function posts()
    {
    	return $this->belongsToMany('App\Models\Post');
    }

    public function getAllDataTags()
    {
    	$data = [];
    	$tags = Tag::all();
    	if($tags){
    		$data = $tags->toArray();
    	}
    	return $data;
    }

    public function getDataTagByPost()
    {
        $data = DB::table('tags AS t')
                ->select('t.*', 'pt.posts_id AS post_id')
                ->join('post_tag AS pt', 't.id', '=', 'pt.tags_id')
                ->get();
        $data = json_decode(json_encode($data),true);

        return $data;
    }
}
