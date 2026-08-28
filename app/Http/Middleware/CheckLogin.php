<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna belum login (session 'user' tidak ada)
        if (!$request->session()->has('user')) {
            return redirect('/login')->withErrors(['email' => 'Silakan login terlebih dahulu untuk mengakses halaman ini!']);
        }

        return $next($request);
    }
}