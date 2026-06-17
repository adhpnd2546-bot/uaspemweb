<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->session()->has('user_role')) {
            return redirect()->route('login')->with('error', 'Akses ditolak. Silakan masuk terlebih dahulu.');
        }

        if ($request->session()->get('user_role') !== $role) {
            return redirect()->route('login')->with('error', 'Akses ditolak. Anda tidak memiliki izin untuk halaman ini.');
        }

        return $next($request);
    }
}
