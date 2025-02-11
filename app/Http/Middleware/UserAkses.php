<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAkses
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // If user is authenticated and tries to access the login page, redirect them
        if (auth()->check() && $request->is('login')) {
            return redirect('/home'); // Or wherever you want to redirect authenticated users
        }

        // Continue with the role check for other routes
        if (in_array(auth()->user()->role, $roles)) {
            return $next($request);
        }

        // Redirect based on user role
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

