<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::guard($guards)->guest()) {
            return redirect()->route('login'); // Sesuaikan dengan route login Anda
        }

        return $next($request);
    }
}
