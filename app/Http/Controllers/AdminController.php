<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;
use App\Koperasi;
use App\Customer;

class AdminController extends Controller
{
    public function __construct()
    {
    	
    }

    public function index()
    {
    	# code...
    }

    public function sistem()
    {
    	$color = 'indigo';
        return view('admin.admin', compact('color'));
    }

    public function koperasi()
    {
        $color = 'red';
        $koperasi = Koperasi::where('user_id', auth()->user()->id)->first(['active']);
        if (empty($koperasi)) {
            flash()->overlay('Koperasi anda tidak ditemukan. Silahkan hubungi admin untuk tindakan selanjutnya.', 'Pemberitahuan');
            auth()->logout();
            return redirect('/');
        } else {
            if ($koperasi->active != 1) { // jika koperasi tidak aktif, vuejs tidak bisa diakses
                flash()->overlay('Koperasi anda masih dalam tahap verifikasi. Silahkan menunggu konfirmasi dari admin untuk tindakan selanjutnya.', 'Pemberitahuan');
                return view('admin.admin-unactive', compact('color', 'koperasi'));
            } else {
                return view('admin.admin', compact('color', 'koperasi'));
            }
        }
    }

    public function bank()
    {
        $color = 'green';
        $bank = Bank::where('user_id', auth()->user()->id)->first(['active']);
        if (empty($bank)) {
            flash()->overlay('Bank anda tidak ditemukan. Silahkan hubungi admin untuk tindakan selanjutnya.', 'Pemberitahuan');
            auth()->logout();
            return redirect('/');
        } else {
            if ($bank->active != 1) { // jika bank tidak aktif, vuejs tidak bisa diakses
                flash()->overlay('Bank anda masih dalam tahap verifikasi. Silahkan menunggu konfirmasi dari admin untuk tindakan selanjutnya.', 'Pemberitahuan');
                return view('admin.admin-unactive', compact('color', 'bank'));
            } else {
                return view('admin.admin', compact('color', 'bank'));
            }
        }
    }

    public function nasabah()
    {
        $color = 'blue-grey';
        $nasabah = Customer::where('user_id', auth()->user()->id)->first(['active']);
        if (empty($nasabah)) {
            flash()->overlay('Akun anda tidak ditemukan. Silahkan hubungi admin untuk tindakan selanjutnya.', 'Pemberitahuan');
            auth()->logout();
            return redirect('/');
        } else {
            if ($nasabah->active != 1) { // jika nasabah tidak aktif, vuejs tidak bisa diakses
                flash()->overlay('Akun anda masih dalam tahap verifikasi. Silahkan menunggu konfirmasi dari admin untuk tindakan selanjutnya.', 'Pemberitahuan');
                return view('admin.admin-unactive', compact('color', 'nasabah'));
            } else {
                return view('admin.admin', compact('color', 'nasabah'));
            }
        }
    }
}
