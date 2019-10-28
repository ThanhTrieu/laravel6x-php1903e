<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Models\Post;
use App\Models\Tag;

class DetailBlogController extends FrontendController
{
    public function index($slug, Request $request, Post $post, Tag $tag)
    {
    	$infoPost = $post->getDataPostBySlug($slug);
    	$infoPost = json_decode(json_encode($infoPost),true);
    	if($infoPost){
    		// lay tags theo bai viet nay
    		$lstTags = $tag->getDataTagByIdPost($infoPost['id']);
    		// lay ra 3 bai viet cung cate voi bai viet dang xem
    		$lstPost = $post->getDataPostByCateId($infoPost['categories_id'], $infoPost['id']);

    		$data = [];
    		$data['info'] = $infoPost;
    		$data['lstTags'] = $lstTags;
    		$data['related'] = $lstPost;

    		return view('frontend.blog.detail', $data);

    	} else {
    		abort(404);
    	}
    }

    public function updateCountView(Request $request, Post $post)
    {
    	$idPost = $request->id;
    	$idPost = is_numeric($idPost) && $idPost > 0 ? $idPost : 0;
    	$infoPost = $post->getInfoDatPostById($idPost);
    	// lay ra luot view truoc khi update - sau do update tang len 1 don vi
    	if($infoPost){
    		$view = $infoPost['count_view'];
    		$up = $post->updateView($idPost, $view);
    		if($up){
    			echo "ok";
    		} else {
    			echo "err";
    		}
    	}
    }
}
