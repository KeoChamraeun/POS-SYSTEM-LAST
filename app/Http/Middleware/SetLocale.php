<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        //$locale = Session::get('locale', config('app.locale'));

        //App::setLocale($locale);
        $locale = $request->route('locale') ?: Session::get('locale');

        if ($locale) {
            App::setLocale($locale);

            /**
             * We need to store the locale in the session because we don't want to pass it to each component we create.
             * Also because we fetch the locale from the route but the url for the Livewire API endpoint only
             * contains the component name.
             */
            Session::put('locale', $locale);
        }

        return $next($request);

        //return $next($request);
    }
}
