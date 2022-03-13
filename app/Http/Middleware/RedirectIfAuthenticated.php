<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $role = auth()->user()->livello_utenza;

            switch ($role) {
                case '4':
                    return redirect('/admin');
                    break;
                case '2':
                    return redirect('/user');
                    break;
                case '3':
                    return redirect('/org');
                    break;
                default: return redirect('/');
            };
        }
        return $next($request);
    }
}
