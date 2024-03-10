<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SingleSessionMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $currentSessionId = Auth::user()->session_id;
            if ($currentSessionId != Session::getId()) {
                Auth::logout();
                return redirect('/login')->withErrors(['Your account is logged in from another device.']);
            }
        }

        return $next($request);
    }
}
