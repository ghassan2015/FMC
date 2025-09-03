<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = $request->header('lang', config('app.locale')); // Or use a query parameter: $request->query('lang')


        if (auth('sanctum')->check()) {
            // Ensure the language is valid (ar, en, hi)

            $lang = auth('sanctum')->user()->lang;
            if (in_array($lang, ['ar', 'en'])) {

                App::setLocale($lang); // Set application locale
            }
        }

        return $next($request);
    }
}
