<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        // If the user is authenticated, redirect to home or another page
        if (auth()->check()) {
            return redirect('/home'); // Or wherever you want to redirect authenticated users
        }

        return $next($request);
    }
}
