<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class SetLocale
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
        $localeFromCookie = $request->cookie('locale');
        $langPath = resource_path('lang/' . $localeFromCookie);

        App::setLocale($localeFromCookie);

        View::share('locale', collect(File::allFiles($langPath))->flatMap(function ($file) {
            return [
                ($locale = $file->getBasename('.php')) => trans($locale),
            ];
        })->toJson());

        return $next($request);
    }
}
