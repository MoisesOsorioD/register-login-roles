<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class GuestMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {

            if (Auth::user()->role == 'productor') {
                return redirect('/productor/dashboard');
            }

            return redirect('/cliente/dashboard');
        }

        return $next($request);
    }
}