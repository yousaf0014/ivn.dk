<?php

namespace App\Http\Middleware;

use Closure;

class BusinessMiddleware
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
        //Check if user is admin
        if (Auth::user()->user_type !== 'Business') {
            return redirect('/');
        }
        
        return $next($request);
    }
}
