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
            // Détection automatique basée sur le navigateur
            $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
            $supported = ['fr', 'ar', 'en'];
            App::setLocale(in_array($locale, $supported) ? $locale : config('app.locale'));
        }

        return $next($request);
    }
}