<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // ← TAMBAH INI

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // kalau belum login atau bukan admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak punya akses ke halaman ini.');
            // atau bisa redirect()->route('dashboard'); terserah kebutuhan
        }

        return $next($request);
    }
}
