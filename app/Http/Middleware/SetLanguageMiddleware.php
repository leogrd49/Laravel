<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLanguageMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('post') && $request->has('language')) {
            $language = $request->input('language');
            if (in_array($language, ['en', 'fr'])) {
                session()->put('locale', $language);
                App::setLocale($language);
                return redirect()->back();
            }
        }

        if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }

        return $next($request);
    }
}
