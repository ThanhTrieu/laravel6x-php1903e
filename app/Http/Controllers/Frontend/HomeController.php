<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(Post $post)
    {
    	$data = [];
    	$listPost = $post->getListPostsByPublishDate();
    	$data['paginate'] = $listPost;

    	$mainData = json_decode(json_encode($listPost), true);
    	$postDatas = $mainData['data'] ?? [];

    	// lay ra 3 bai silder
    	// lay ra 8 bai lastest

    	return view('frontend.home.index', $data);
    }
}
