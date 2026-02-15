<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('loginpage');
        }

        if (Auth::user()->role != 'admin') {
            return redirect()->route('userdashboard');
        }

        return $next($request);
    }
}
