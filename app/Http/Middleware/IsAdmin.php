<?php

namespace App\Http\Middleware;

use Closure;
use \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class IsAdmin
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
        if ($request->user() && $request->user()->adm == 1){
            return $next($request);    
        }
        throw new AccessDeniedHttpException("Unauthirized");
        
    }
}
