<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function index()
    {
        $dataPost = DB::table('posts')->get();
        dd($dataPost);

    	// do du lieu tu controller ra view
    	$name = "LPHP1903E";
    	$data = [];
    	$data['myName'] = $name;
    	$data['age'] = 20;
    	$data['address'] = 'Ha Noi';

    	//return view('admin.posts.index')->with('myName', $name);
    	return view('admin.posts.index', $data);
    }
}
