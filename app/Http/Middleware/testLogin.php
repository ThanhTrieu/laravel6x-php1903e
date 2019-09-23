<?php

namespace App\Http\Middleware;

use Closure;

class testLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $params = null)
    {
        $username = $request->user;
        if(!$this->checkUserLogin($username) && $params !== 'admin'){
            // login ko thanh cong
            return redirect()->route('exp.index');
        }
        return $next($request);
    }

    private function checkUserLogin($user)
    {
        if($user === 'admin'){
            return true;
        }
        return false;
    }
}
