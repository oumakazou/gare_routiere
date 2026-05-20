<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $availableLocales = config('app.available_locales', []);
        $default = config('app.locale');

        $locale = session('locale', $request->cookie('app_locale', $default));

        if (! is_string($locale) || ! in_array($locale, $availableLocales, true)) {
            $locale = $default;
        }

        App::setLocale($locale);

        if (! session()->has('locale')) {
            session(['locale' => $locale]);
        }

        return $next($request);
    }
}
