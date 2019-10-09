<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class checkAdminLgoin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$this->checkLogin()){
            // quay ve trang dang nhap
            return redirect()->route('admin.login');
        }
        return $next($request);
    }

    private function getIdSessionAdmin()
    {
        $id = Session::get('idSession');
        return (is_numeric($id) && $id > 0 ) ? $id : 0;
    }

    private function getEmailSessionAdmin()
    {
        $email = Session::get('emailSession');
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return $email;
        }
        return null;
    }

    private function checkLogin()
    {
        $id = $this->getIdSessionAdmin();
        $email = $this->getEmailSessionAdmin();
        if($id > 0 && $email){
            return true;
        }
        return false;
    }
}
