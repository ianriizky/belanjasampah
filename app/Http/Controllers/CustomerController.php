<?php

namespace App\Http\Controllers;

use App\User;
use App\Customer;
use App\Bank;
use Illuminate\Http\Request;
use Crypt;

class CustomerController extends Controller
{
    public function __construct()
    {
        // abort_if(!request()->ajax(), 403, 'Anda dilarang mengakses halaman ini');
    }

    public function index()
    {
        $bank       = Bank::where('user_id', auth()->user()->id)->first();
        $customers  = Customer::with(['user' => function ($q) {
                            $q->select('id', 'name');
                        }])->where('bank_id', $bank->id)->filter()->paginate();

        // $customers = Bank::where('user_id', auth()->user()->id)->get(['id'])->with('customers.user')->filter()->paginate();

        // menambahkan request lain seperti keyword
        if (request()->all()) {
            $customers->appends(request()->all());
        }

        return $customers->toJson();
    }

    public function get()
    {
        $bank       = Bank::where('user_id', auth()->user()->id)->first();
        $customers  = Customer::select('id', 'user_id')
                        ->with(['user' => function ($q) {
                            $q->select('id', 'name');
                        }])->where('bank_id', $bank->id)
                            ->where('active', true)
                            ->get();

        return $customers->toJson();
    }

    public function getBalance()
    {
        $customer = Customer::where('user_id', auth()->user()->id)->first();
        return response()->json(['balance' => $customer->balance]);
    }

    public function getLastID()
    {
        $customer = Customer::latest()->first();
        if (empty($customer)) {
            return response()->json(['id' => 1]);
        } else {
            return response()->json(['id' => $customer->id+1]);
        }
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                // users
                'user_id'            => 'required|min:4|max:15|alpha_dash|unique:users,id',
                'user_email'         => 'required|string|email|max:255|unique:users,email',
                'user_name'          => 'required|string|max:50',
                'user_address'       => 'nullable|string',
                'user_phone_number'  => 'nullable|numeric|digits_between:11,15',
                'user_gender'        => 'nullable',
                'user_birth_date'    => 'nullable|date|before_or_equal:today',
                'user_password'      => 'required|string|min:4|confirmed',
                // customers
                'customer_family_member'    => 'required|numeric|min:0',
            ]);

            // insert into users
            $user               = new User;
            $user->id           = strtolower($request['user_id']);
            $user->email        = $request['user_email'];
            $user->name         = $request['user_name'];
            $user->address      = $request['user_address'];
            $user->phone_number = str_replace('-', 'replace', $request['user_phone_number']);
            $user->gender       = $request['user_gender'];
            $user->birth_date   = $request['user_birth_date'];
            $user->password     = bcrypt($request['user_password']);
            $user->active       = $request['user_active'];

            // if success
            if ($user->save()) {
                $user->attachRole(4);
                // insert into customers
                $customer                   = new Customer;
                $customer->id               = $request['customer_id'];
                $customer->user_id          = $user->id;
                $customer->bank_id          = $request['customer_bank_id'];
                $customer->family_member    = $request['customer_family_member'];
                $customer->active           = $request['customer_active'];

                if ($customer->save()) {
                    return response()->json([
                        'success' => true,
                        'alert'   => 'alert-success',
                        'message' => $user->id.' berhasil ditambah.'
                    ]);
                }
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => $request['name'].' gagal ditambah.'
            ]);
        }
    }

    public function show($id)
    {
        $customer = Customer::with(['user', 'transactions.code'])->find($id);
        return $customer->toJson();
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request, $id)
    {
        try {
            if (User::destroy($id)) {
                if (Customer::where('user_id', $id)->delete()) {
                    // return as JSON
                    return response()->json([
                        'success' => true,
                        'alert'   => 'alert-danger',
                        'message' => $request['name'].' berhasil dihapus.'
                    ]);
                }
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => $request['name'].' gagal dihapus.'
            ]);
        }
    }

    public function activate(User $user)
    {
        try {
            // $user->active           = true;
            $user->customer->active = true;

            // if success
            if ($user->customer->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-success',
                    'message' => $user->name.' berhasil diaktifkan.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => true,
                'alert'   => 'alert-danger',
                'message' => $user->name.' gagal diaktifkan.'
            ]);
        }
    }

    public function deactivate(User $user)
    {
        try {
            // $user->active           = false;
            $user->customer->active = false;

            // if success
            if ($user->customer->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-warning',
                    'message' => $user->name.' berhasil dinonaktifkan.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => $user->name.' gagal diaktifkan.'
            ]);
        }
    }

    public function reset(User $user)
    {
        try {
            // insert into database
            $user->password   = bcrypt('123456');

            // if success
            if ($user->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-danger',
                    'message' => $user->name.' berhasil direset passwordnya (password: 123456).'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => $user->name.' gagal direset passwordnya.'
            ]);
        }
    }
}
