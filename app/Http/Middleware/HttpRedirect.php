<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
 
class HttpRedirect
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
        if (!$request->secure() && env('APP_ENV') !== 'local') {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}