<?php

namespace App\Http\Middleware;

use Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (Auth::guard('petugas')->check()) {
            return route('home');
        }

        if (Auth::guard('masyarakat')->check()) {
            return route('app.index');
        }

        return $request->expectsJson() ? null : route('login.view.masyarakat');
    }
}
