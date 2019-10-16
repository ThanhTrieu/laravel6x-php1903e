<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostContent extends Model
{
    protected $table = 'post_contents';

    public function posts()
    {
    	return $this->belongsTo('App\Models\Post');
    }

    public function insertDataContentPost($data)
    {
    	$insert = DB::table('post_contents')->insert($data);
    	if($insert){
    		return true;
    	}
    	return false;
    }
}
