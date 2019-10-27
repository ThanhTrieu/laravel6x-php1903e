<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Categories;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    public function __construct(Category $cate, Post $post, Tag $tag)
    {
    	$listCate = $cate->getAllDataCategories();
    	$treeCate = Categories::buildTreeCategory($listCate);
    	$popularPost = $post->popularPost();
    	$popularPost = json_decode(json_encode($popularPost),true);
    	$catePost = $cate->getDataCategoriesByPost();
    	$catePost = json_decode(json_encode($catePost),true);

    	// lay tat ca bai viet thuoc vao 1 cate
    	$dataCatePost = [];
    	foreach ($catePost as $k => $val) {
    		$val['list_post'] = [];
    		$dataCatePost[$val['id']]['id_cate'] = $val['id'];
    		$dataCatePost[$val['id']]['name_cate'] = $val['name_cate'];
    		$dataCatePost[$val['id']]['list_post'][$val['post_id']] = $val['post_id'];
    	}

    	// share du lieu cho tat cac cac view
		 View::share('view', [
		 	'treeCate' => $treeCate,
		 	'listCate' => $listCate,
		 	'popularPost' => $popularPost,
		 	'catePost' => $dataCatePost
		 ]);
    }
}
