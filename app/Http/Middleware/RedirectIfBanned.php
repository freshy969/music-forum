<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class RedirectIfBanned
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
        if (\Auth::check()) {
            if (\Auth::user()->banned) {
                \Auth::logout();
                return new Response(view('auth.banned'));
            }
        }
        return $next($request);
    }
}
