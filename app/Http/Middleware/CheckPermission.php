<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle($request, Closure $next)
    {
        // Redirect to login if not authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Fetch permissions stored in session
        $userPermissions = session('user_permission', []);

        // If session is empty or not an array, log out user
        if (!is_array($userPermissions) || empty($userPermissions)) {
            Auth::logout();
            session()->flush();
            return redirect()->route('login');
        }
        return $next($request);
    }
}
