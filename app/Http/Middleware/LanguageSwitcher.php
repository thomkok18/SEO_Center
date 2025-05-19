<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageSwitcher
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (!Session::has('locale')) {
            Session::put('locale', Language::getLanguageCodeById(auth()->user()->language_id));
        }

        App::setLocale(session('locale'));

        return $next($request);
    }
}
