<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAkses
{
    public function handle(Request $request, Closure $next, ...$roles): Response
{
    // Jika user sudah login dan mencoba akses halaman login, arahkan ke dashboard
    if (auth()->check() && $request->is('login')) {
        return redirect()->route('dashboard.'.auth()->user()->role);
    }

    // Jika user memiliki peran yang sesuai, lanjutkan request
    if (in_array(auth()->user()->role, $roles)) {
        return $next($request);
    }

    // Redirect berdasarkan role jika user tidak punya akses
    switch (auth()->user()->role) {
        case 'admin':
            return redirect('/dashboard/admin');
        case 'guru':
            return redirect('/dashboard/guru');
        case 'siswa':
            return redirect('/dashboard/siswa');
        default:
            return redirect('/');
    }
}

}

