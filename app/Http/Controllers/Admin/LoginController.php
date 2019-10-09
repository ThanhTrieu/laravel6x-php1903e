<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginPost as AdminRequest;
use App\Models\Admin;

class LoginController extends Controller
{
    public function index(Request $request)
    {
    	$data = [];
    	$data['messages'] = $request->session()->get('errorLogin');
    	// load view
    	return view('admin.login.index', $data);
    }

    public function handleLogin(AdminRequest $request, Admin $admin)
    {
    	$email = $request->txtEmail;
    	$password = $request->txtPass;

    	$infoAdmin = $admin->checkAdminLogin($email, $password);
    	if($infoAdmin){
    		// dang nhap thanh cong
    		// cho vao trang dashboard admin
    		$request->session()->put('idSession', $infoAdmin['id']);
    		// $_SESSION['idSession'] = $infoAdmin['id'];
    		$request->session()->put('userSession', $infoAdmin['username']);
    		$request->session()->put('emailSession', $infoAdmin['email']);
    		$request->session()->put('roleSession', $infoAdmin['role']);

    		return redirect()->route('admin.dashboard');
    	} else {
    		// dang nhap khong thanh cong
    		// quay ve form login
    		// luu session flash thong bao loi
    		$request->session()->flash('errorLogin', 'Username or password invaild');
    		return redirect()->route('admin.login');
    	}
    }

    public function logout(Request $request)
    {
    	// xoa het session ma login tao ra
    	$request->session()->forget('idSession');
    	// unset($_SESSION['idSession']);
    	$request->session()->forget('userSession');
    	$request->session()->forget('emailSession');
    	$request->session()->forget('roleSession');
    	return redirect()->route('admin.login');
    }
}
