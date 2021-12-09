<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Level
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $privilege)
    {
        if($privilege == 'admin' && Auth::user()->level == 'admin'){
            return $next($request);
        }else if($privilege == 'user' && Auth::user()->level == 'user'){
            return $next($request);
        }else if($privilege == 'admin&user'){
            if (Auth::user()->level == 'admin') {
                return $next($request);
            }else if(Auth::user()->level == 'user'){
                return $next($request);
            }
        }
        return back();
        
    }
}
