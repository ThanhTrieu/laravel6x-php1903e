<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function index()
    {
    	return "this is function " . __FUNCTION__ ;
    }

    public function test()
    {
    	return "This is test";
    }
}
