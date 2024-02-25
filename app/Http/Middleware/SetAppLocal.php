<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetAppLocal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $local = request('local', Cookie::get('local', config('locale')));

        App::setLocale($local);
        Cookie::queue('local', $local, 60 * 24);

        URL::defaults([
            'local' => $local,
        ]);

        Route::current()->forgetParameter('local');
        return $next($request);
    }
}
