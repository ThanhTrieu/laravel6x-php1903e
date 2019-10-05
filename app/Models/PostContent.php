<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostContent extends Model
{
    protected $table = 'post_contents';

    public function posts()
    {
    	return $this->belongsTo('App\Models\Post');
    }
}
