<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::user()->role === $role) {
            return $next($request);
        }

        return redirect('/'); // Redirect ke halaman lain jika role tidak cocok
    }
}
