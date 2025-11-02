<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class isResepsionis
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user BELUM login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Ambil role dari session
        $userRole = session('user_role');

        // Cek apakah user adalah admin (role ID = 1)
        if ($userRole === 4) {
            return $next($request);
        }

        // Jika bukan admin, redirect ke home
        return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    }
}
