<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class HomeController extends FrontendController
{
    public function index(Post $post)
    {
    	$data = [];
    	$listPost = $post->getListPostsByPublishDate();
    	$data['paginate'] = $listPost;

    	$mainData = json_decode(json_encode($listPost), true);
    	$postDatas = $mainData['data'] ?? [];

    	// lay ra 3 bai silder
        $slider = array_slice($postDatas, 0, 3);
    	// lay ra 8 bai lastest
        $lastest = array_slice($postDatas, 4, 8); 
        $data['slider'] = $slider;
        $data['lastest'] = $lastest;

    	return view('frontend.home.index', $data);
    }
}
