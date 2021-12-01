<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class LimitIP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $ips = explode(',',  config('app.allowed_ip'));

        if (!in_array($request->ip(), $ips)) {

            info($request->ip() . ' tried to access ' . $request->getUri());

            // here instead of checking a single ip address we can do collection of ips
            //address in constant file and check with in_array function
            throw new AccessDeniedHttpException();
        }

        return $next($request);
    }
}
