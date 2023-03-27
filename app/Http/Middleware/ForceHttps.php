<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceHttps
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
		if ($request->ajax() && !$request->secure()) {
			
			 return redirect()->secure($request->getRequestUri());
          //  return response('HTTPS is required for AJAX calls.', 400);
        }
        return $next($request);
    }
}
