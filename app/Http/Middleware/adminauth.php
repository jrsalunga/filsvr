<?php

namespace App\Http\Middleware;

use Closure;

class adminauth
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if(\Auth::check())
        {
           if(\Auth::user()->user_type == "admin")
           {
            return $next($request);
           }
           return redirect("redirect");
        }
        return redirect("redirect");      
    }
}
