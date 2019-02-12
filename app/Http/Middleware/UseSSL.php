<?php

namespace App\Http\Middleware;

use Closure;

class UseSSL
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
        if(!$request->secure() && env('APP_ENV') === 'local'){
            return Redirect::secure($request->path());
        }
        return $next($request);
    }
}
