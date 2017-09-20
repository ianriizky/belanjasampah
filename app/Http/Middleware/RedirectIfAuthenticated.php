<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (auth()->guard($guard)->check()) {
            if (auth()->user()->hasRole('admin_sistem')) {
                return redirect('/sistem');
            } elseif (auth()->user()->hasRole('admin_koperasi')) {
                return redirect('/koperasi');
            } elseif (auth()->user()->hasRole('admin_bank')) {
                return redirect('/bank');
            }
        }
        return $next($request);
    }
}
