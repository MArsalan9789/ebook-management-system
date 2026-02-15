<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('loginpage');
        }

        if (Auth::user()->role != 'user') {
            return redirect()->route('admindashboard');
        }

        return $next($request);
    }
}
