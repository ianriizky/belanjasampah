<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Koperasi;
use App\Bank;
use App\Role;
use Mail;
use Crypt;
use App\Mail\VerifyEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function registerOption()
    {
        $roles = Role::findOrFail([2, 3]); // ambil data di tabel roles
        return view('auth.register', compact('roles'));
    }

    public function register(Request $request)
    {
        if ($request['roles'] == '2') { // koperasi
            return redirect('/register/koperasi');
        } elseif ($request['roles'] == '3') { // bank
            return redirect('/register/bank');
        } else {
            return abort(404);
        }
    }

    protected function verify()
    {
        if (empty(request('token'))) {
            // jika token tidak tersedia
            return redirect()->route('signup.form');
        }

        // decrypt token as email
        $decryptedId = Crypt::decrypt(request('token'));

        // find user by email
        $user = User::whereId($decryptedId)->first();
        if ($user->active == false) {
            $user->active = true;
            $user->save();
        }

        // autologin
        auth()->loginUsingId($user->id);

        return view('auth.success', compact('user'));
    }

    // register koperasi
    public function getRegisterKoperasi()
    {
        $str = "KOPR";
        $koperasi = Koperasi::latest()->first();
        if (empty($koperasi)) {
            $order_number = 1;
        } else {
            $order_number = $koperasi->order_number+1;
        }

        $koperasi_id =  $str.str_pad($order_number, 6, '0', STR_PAD_LEFT);
        return view('auth.register-koperasi', compact('koperasi_id', 'order_number'));
    }

    public function postRegisterKoperasi(Request $request)
    {
        $this->validatorKoperasi($request->all())->validate();

        event(new Registered($user = $this->createKoperasi($request->all())));

        return view('auth.confirm', compact('request'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorKoperasi(array $data)
    {
        return Validator::make($data, [
            // user
            'id'            => 'required|min:4|max:15|alpha_dash|unique:users,id',
            'email'         => 'required|string|email|max:255|unique:users,email',
            'name'          => 'required|string|max:50',
            'address'       => 'nullable|string',
            'phone_number'  => 'nullable',
            'gender'        => 'nullable',
            'birth_date'    => 'nullable|date|before_or_equal:today',
            'password'      => 'required|string|min:4|confirmed',
            
            // koperasi
            'koperasi_id'       => 'required|unique:koperasis,id',
            'koperasi_name'     => 'required|max:50',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function createKoperasi(array $data)
    {
        if (!isset($data['gender'])) {
            $data['gender'] = NULL;
        }
        // proses ke tabel users
        $user = User::create([
            'id'            => strtolower($data['id']),
            'email'         => $data['email'],
            'name'          => $data['name'],
            'address'       => $data['address'],
            'phone_number'  => str_replace('-', '', $data['phone_number']),
            'gender'        => $data['gender'],
            'birth_date'    => $data['birth_date'],
            'password'      => bcrypt($data['password'])
        ]);

        // proses ke tabel role_user
        $user->attachRole(2);

        // proses ke tabel koperasis
        $koperasi = Koperasi::create([
            'id'            => $data['koperasi_id'],
            'user_id'       => strtolower($data['id']),
            'name'          => $data['koperasi_name'],
            'address'       => $data['koperasi_address'],
            'description'   => $data['koperasi_description'],
            'order_number'  => $data['koperasi_order_number'],
            'active'        => false,
        ]);

        Mail::to($user->email)->send(new VerifyEmail($user));
    }

    // register bank
    public function getRegisterBank()
    {
        $str = "BANK";
        $bank = Bank::latest()->first();
        if (empty($bank)) {
            $order_number = 1;
        } else {
            $order_number = $bank->order_number+1;
        }

        $bank_id =  $str.str_pad($order_number, 6, '0', STR_PAD_LEFT);
        return view('auth.register-bank', compact('bank_id', 'order_number'));
    }

    public function postRegisterBank(Request $request)
    {
        $this->validatorBank($request->all())->validate();

        event(new Registered($user = $this->createBank($request->all())));

        return view('auth.confirm', compact('request'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorBank(array $data)
    {
        return Validator::make($data, [
            // user
            'id'            => 'required|min:4|max:15|alpha_dash|unique:users,id',
            'email'         => 'required|string|email|max:255|unique:users,email',
            'name'          => 'required|max:50',
            'address'       => 'nullable|string',
            'phone_number'  => 'nullable',
            'gender'        => 'nullable',
            'birth_date'    => 'nullable|date|before_or_equal:today',
            'password'      => 'required|string|min:4|confirmed',

            // koperasi
            'bank_id'       => 'required|unique:koperasis,id',
            'bank_name'     => 'required|max:50',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function createBank(array $data)
    {
        if (!isset($data['gender'])) {
            $data['gender'] = NULL;
        }
        // proses ke tabel users
        $user = User::create([
            'id'            => strtolower($data['id']),
            'email'         => $data['email'],
            'name'          => $data['name'],
            'address'       => $data['address'],
            'phone_number'  => str_replace('-', '', $data['phone_number']),
            'gender'        => $data['gender'],
            'birth_date'    => $data['birth_date'],
            'password'      => bcrypt($data['password'])
        ]);

        // proses ke tabel role_user
        $user->attachRole(3);

        // proses ke tabel koperasis
        $koperasi = Bank::create([
            'id'            => $data['bank_id'],
            'user_id'       => strtolower($data['id']),
            'name'          => $data['bank_name'],
            'address'       => $data['bank_address'],
            'description'   => $data['bank_description'],
            'order_number'  => $data['bank_order_number'],
            'active'        => false,
        ]);

        Mail::to($user->email)->send(new VerifyEmail($user));
    }
}
