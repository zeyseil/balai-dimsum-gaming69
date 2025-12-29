<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login sebagai admin
        if (!session('admin_logged_in')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman admin');
        }

        return $next($request);
    }
}
