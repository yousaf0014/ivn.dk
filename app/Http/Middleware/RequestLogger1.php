<?php
namespace App\Http\Middleware;

use Closure;
use Auth;

class RequestLogger
{
    public function handle( $request, Closure $next )
    {
        echo '<pre>';
        print_r($request->path());
        print_r($request->route()->getName());
        exit;
        return $response;
    }
}