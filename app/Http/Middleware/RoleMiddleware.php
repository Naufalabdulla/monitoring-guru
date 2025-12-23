<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role) {
if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();
    
    // Pastikan pengecekan role sesuai dengan string di database
    if ($user->role !== $role) {
        // Redirect ke dashboard masing-masing, JANGAN ke login lagi jika sudah login
        return $user->role === 'admin' 
            ? redirect()->route('admin.dashboard') 
            : redirect()->route('guru.dashboard');
    }

    return $next($request);
}
}
