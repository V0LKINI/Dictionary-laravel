<?php

namespace App\ViewComposer;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class LocaleComposer
{
    public function compose(View $view)
    {
        $localeFromCookie = Cookie::get('locale');
        $langPath = resource_path('lang/' . $localeFromCookie);

        $view->with('locale', collect(File::allFiles($langPath))->flatMap(function ($file) {
            return [
                ($locale = $file->getBasename('.php')) => trans($locale),
            ];
        })->toJson());
    }
}