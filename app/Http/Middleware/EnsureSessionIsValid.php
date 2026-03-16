<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureSessionIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role_user && Auth::user()->role_user->role_id == 1 || Auth::user()->staff && Auth::user()->staff->role_id == 2) {
            return $next($request);
        } else if (Auth::check() && Auth::user()->staff && Auth::user()->staff->role_id == 2 && session()->has('branch') && session('branch_id') == null) {

            Auth::logout();
            return redirect()->route('login')->with('error', __('Your account has been deactivated. Please contact your administrator.'));
        } else if (session()->has('shop') && session('shop_id') == null) {
            Auth::logout();
            return redirect()->route('login')->with('error', __('Your account has been deactivated. Please contact your administrator.'));
        }

        return $next($request);
    }
}
