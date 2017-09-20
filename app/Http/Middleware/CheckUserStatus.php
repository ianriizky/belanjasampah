<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (auth()->guard($guard)->check() && !auth()->user()->active == true) {
            auth()->logout();
            flash()->overlay('Akun anda belum aktif. Silahkan cek email anda atau hubungi admin untuk melakukan proses konfirmasi.', 'Pemberitahuan');
            return redirect('/');
        }
        return $next($request);
    }
}
