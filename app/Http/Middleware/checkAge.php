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
    public function handle($request, Closure $next)
    {
        $myAge = $request->age;
        $this->mycheckNumber($myAge);
        
        if($myAge < 18){
            return redirect()->route('flim-2');
        }
        // thuc thi tiep request routing
        return $next($request);
    }

    private function mycheckNumber($n)
    {

    }
}
