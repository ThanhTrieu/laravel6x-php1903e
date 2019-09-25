<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function index()
    {
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