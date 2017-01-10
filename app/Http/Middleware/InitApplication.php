<?php

namespace App\Http\Middleware;

use App\Helpers\Main;
use Closure;

class InitApplication
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
        if( \Auth::user() !== null && \Auth::user()->hasRole('ban')) abort(403);

        initApplication();
        return $next($request);
    }
}
