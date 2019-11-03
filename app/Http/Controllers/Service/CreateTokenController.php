<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Firebase\JWT\JWT;

class CreateTokenController extends Controller
{
	const API_KEY = 'lphp1903e';

    public function index()
    {
    	// du lieu can ma hoa
    	$token = array(
		    "iss" => "php",
		    "aud" => "vccorp",
		    "iat" => 1356999524, // quy dinh thoi gian song
		    "nbf" => 1357000000
		);
		// ma hoa
		return JWT::encode($token, self::API_KEY);
    }

    public function decodeToken($token)
    {
    	$decode = JWT::decode($token, self::API_KEY, array('HS256'));
    	dd($decode); 
    }
}
