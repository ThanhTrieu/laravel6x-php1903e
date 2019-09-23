<?php

namespace App\Http\Middleware;

use Closure;

class checkAge
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
        
        // $params : bien de nhan gia tri truyen vao tu ben ngoai middleware
        // xu ly logic thong qua tham so nay
        
        // before midlleware
        $myAge = $request->age;  
        //$this->mycheckNumber($myAge);
        
        if($myAge < 18 && $params !== 'admin'){
            return redirect()->route('flim-2');
        }
        // thuc thi tiep request routing
        return $next($request);
    
       
        // after middleware
        /*
        $respone = $next($request);
        $myAge = $request->age;
        if($myAge < 18 && $params !== 'admin'){
            return redirect()->route('flim-2');
        }
        return $respone;
        */
    }

    private function mycheckNumber($n)
    {

    }
}
