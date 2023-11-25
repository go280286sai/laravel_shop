<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class LangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Cache::has('lang')) {
            app()->setLocale(Cache::get('lang'));
        } else {
            if (Cookie::has('lang')) {
                $lang = Cookie::get('lang');
            } else {
                $lang = app()->getLocale();
                Cookie::queue('lang', $lang, 3600 * 24 * 7);
            }
            Cache::put('lang', $lang);
        }

        return $next($request);
    }
}
