<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        if (auth()->user()->hasRole('admin_sistem')) {
            flash()->overlay('Selamat, anda berhasil login!', 'Sukses');
            $url = '/sistem';
        } elseif (auth()->user()->hasRole('admin_koperasi')) {
            flash()->overlay('Selamat, anda berhasil login!', 'Sukses');
            $url = '/koperasi';
        } elseif (auth()->user()->hasRole('admin_bank')) {
            flash()->overlay('Selamat, anda berhasil login!', 'Sukses');
            $url = '/bank';
        } elseif (auth()->user()->hasRole('nasabah')) {
            flash()->overlay('Selamat, anda berhasil login!', 'Sukses');
            $url = '/';
        }
        return $url;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'id';
    }
}