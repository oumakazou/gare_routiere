<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            $browserLocale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
            $supported = ['en', 'fr', 'ar'];
            $locale = in_array($browserLocale, $supported) ? $browserLocale : config('app.fallback_locale', 'fr');
            App::setLocale($locale);
            Session::put('locale', $locale);
        }

        return $next($request);
    }
}