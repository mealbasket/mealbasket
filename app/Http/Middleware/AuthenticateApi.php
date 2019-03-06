<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateApi
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
        if ($request->input('apikey')==env('scraper_api_key')) {
            return $next($request);
        }        
        return redirect()->route('index');
    }
}
