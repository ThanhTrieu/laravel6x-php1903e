<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Models\Post;

class SearchController extends FrontendController
{
    public function index(Request $request, Post $post)
    {
    	$keyword = $request->s;
    	$keyword = trim($keyword);
    	$data = [];

    	$dataSearch = $post->searchDataPostByKeyword($keyword);
    	$data['paginate'] = $dataSearch;

    	$dataSearch = json_decode(json_encode($dataSearch),true);
    	$listData = $dataSearch['data'] ?? [];
    	$data['listData'] = $listData;
    	$data['keyword'] = $keyword;

    	return view('frontend.search.index',$data);
    }

    public function ajaxSearch(Request $request, Post $post)
    {
        if($request->ajax()){
            
            $keyword = $request->key;
            $dataSearch = $post->searchDataPostByKeyword($keyword);
            $dataSearch = json_decode(json_encode($dataSearch),true);
            $listData = $dataSearch['data'] ?? [];
            $data['listData'] = $listData;

            return view('frontend.search.ajax',$data);
        }
    }
}
