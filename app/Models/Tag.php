<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
