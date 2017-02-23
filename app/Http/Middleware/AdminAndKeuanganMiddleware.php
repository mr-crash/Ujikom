<?php

namespace App\Http\Middleware;

use Closure;

class AdminAndKeuanganMiddleware
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
        if (auth()->check()&&$request->user()->type_user=='admin'||auth()->check()&&$request->user()->type_user=='bendahara')
        {
            return $next($request);
        }
            return redirect('error/404');
    }
}
