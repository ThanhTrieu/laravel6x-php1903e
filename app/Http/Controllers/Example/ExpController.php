<?php

namespace App\Http\Controllers\Example;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpController extends Controller
{
    public function index()
    {
    	return "This is " . __CLASS__;
    }

    public function demo($idPd, $myAge,$money, Request $request)
    {
    	// Request $request : $request = new Request;
    	//$myMoney = $request->money;
    	$t = $request->query('id'); //$request->input('t','aaaa'); //$request->t;
    	$u = $request->u;
    	$all = $request->all();

    	dd($idPd, $myAge, $money, $t, $u, $all);
    }

    public function login()
    {
    	return view('test_login');
    }

    public function handleLogin(Request $request)
    {
    	//$data = $request->all();
    	$user = $request->query('user'); 
    	// $request->user; 
    	// $request->input('user'); 
    	// $_POST['user']
    	$pass = $request->query('pass'); //$request->pass; //$request->input('pass'); // $_POST['pass']
    	dd($user, $pass);
    }
}
