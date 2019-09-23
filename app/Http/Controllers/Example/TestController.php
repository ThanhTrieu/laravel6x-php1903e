<?php

namespace App\Http\Controllers\Example;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
	public function __construct()
	{
		// goi middleware
		// tat ca cac phuong thuc nam trong controller se bi middleware chi phoi
		//$this->middleware('check.login');
		
		// chi muon middleware chi phoi - tac dong vao 1 hay nhieu method action nao do
		//$this->middleware('check.login')->only(['index','viewData']);
		
		// loai tru
		//$this->middleware('check.login:admin')->except('demoData');
	}

    public function index()
    {
    	return "pass midlleware - This is " . __CLASS__;
    }

    public function viewData()
    {
    	return "this is function " . __FUNCTION__;
    }

    public function demoData()
    {
    	return "this is function " . __FUNCTION__;
    }
}
