<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LogLastLogin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Simpan waktu login terakhir
            $user = Auth::user();
            $user->last_login = now();
            $user->save();
        }

        return $next($request);
    }
}