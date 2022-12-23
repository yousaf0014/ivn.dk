<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class AdminMiddleware
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
        if(empty(Auth::user())){
            return redirect('/login');
        }

        if(Auth::user()->user_type !== 'admin') {
            return redirect('/');
        }
        return $next($request);
    }
}
