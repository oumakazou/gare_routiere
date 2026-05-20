<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LanguageController extends Controller
{
    public function switch(Request $request, string $locale): RedirectResponse
    {
        $available = config('app.available_locales', []);

        if (! in_array($locale, $available, true)) {
            return redirect()->back();
        }

        session(['locale' => $locale]);
        Cookie::queue(Cookie::forever('app_locale', $locale));

        $redirect = $request->query('redirect');

        if (is_string($redirect) && $redirect !== '') {
            $appUrl = rtrim(config('app.url'), '/');
            $requestRoot = rtrim($request->getSchemeAndHttpHost(), '/');

            if (
                str_starts_with($redirect, '/')
                || str_starts_with($redirect, $appUrl)
                || str_starts_with($redirect, $requestRoot)
            ) {
                return redirect()->to($redirect);
            }
        }

        return redirect()->back();
    }
}
