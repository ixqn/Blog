<?php

namespace App\Http\Middleware;

use Closure;

class Login
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
        if(!session('admin')){
         return redirect('admin/login')->with('errors','请到登录页进行登录!!!');
        }
        return $next($request);
    }
}
