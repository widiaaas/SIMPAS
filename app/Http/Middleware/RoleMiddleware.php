<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Memastikan pengguna telah login dan memiliki peran yang benar
        if (Auth::check() && Auth::user()->hasRole($role)) {
            return $next($request);
        }

        // Jika pengguna tidak memiliki peran yang diperlukan, arahkan ke halaman login
        return redirect()->route('auth.login');
    }

}
