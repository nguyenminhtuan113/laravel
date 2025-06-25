<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class LanguageMiddleware
{
    public function handle($request, Closure $next)
    {
        // Kiểm tra nếu có tham số 'lang' trong URL hoặc session
        $locale = $request->session()->get('locale', config('app.locale'));

        if ($request->has('lang')) {
            $locale = $request->get('lang');
            $request->session()->put('locale', $locale);
        }

        // Thiết lập ngôn ngữ
        App::setLocale($locale);

        return $next($request);
    }
}
