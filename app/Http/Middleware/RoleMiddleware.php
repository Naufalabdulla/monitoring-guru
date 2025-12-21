<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Auth;

>>>>>>> origin/main

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
<<<<<<< HEAD
    public function handle(Request $request, Closure $next, $role) {
    if (auth()->check() && auth()->user()->role === $role) {
        return $next($request);
    }
    abort(403, 'Anda tidak memiliki akses.');
}
=======
    public function handle(Request $request, Closure $next, $role): Response
    {
       if (Auth::check() && Auth::user()->role === $role) {
        return $next($request);
    }

    return abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
>>>>>>> origin/main
}
