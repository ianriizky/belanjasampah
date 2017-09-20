<?php

namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function __construct()
    {
        // abort_if(!request()->ajax(), 403, 'Anda dilarang mengakses halaman ini');
    }

    public function index()
    {
        $banks    = Bank::filter()->paginate(request('limit', 5));

        // menambahkan request lain seperti keyword
        if (request()->all()) {
            $banks->appends(request()->all());
        }

        return $banks->toJson();
    }

    public function getLastID()
    {
        $str = "BANK";
        $bank = Bank::latest()->first();
        if (empty($bank)) {
            $order_number = 1;
        } else {
            $order_number = $bank->order_number+1;
        }

        $bank_id =  $str.str_pad($order_number, 6, '0', STR_PAD_LEFT);
        return response()->json([
            'id'            => $bank_id,
            'order_number'  => $order_number
        ]);
    }

    public function getBankID()
    {
        $bank       = Bank::where('user_id', auth()->user()->id)->first(['id']);

        return response()->json([
            'bank_id'      => $bank->id,
        ]);
    }

    public function getAuthBank()
    {
       $bank       = Bank::where('user_id', auth()->user()->id)->with(['user' => function($q) {
                               $q->select('id', 'name');
                           }])->first();

       return $bank->toJson();
    }

    public function store(Request $request)
    {
        try {
            // validate request
            $this->validate($request, [
                'id'       => 'required|unique:koperasis,id',
                'user_id'  => 'required',
                'name'     => 'required|max:50',
            ]);
            
            // insert into database
            $bank               = new Bank;
            $bank->id           = $request['id'];
            $bank->user_id      = $request['user_id'];
            $bank->name         = $request['name'];
            $bank->address      = $request['address'];
            $bank->description  = $request['description'];
            $bank->order_number = $request['order_number'];
            $bank->active       = $request['active'];

            // if success
            if ($bank->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-success',
                    'message' => $request['name'].' berhasil ditambah.'
                ]);
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
        $bank = Bank::with(['user' => function($q) {
                   $q->select('id', 'name');
               }])->findOrFail($id);
        return $bank->toJson();
    }

    public function update(Request $request, $id)
    {
        try {
            // validate request
            $this->validate($request, [
                'name'          => 'required|string|max:50',
                'address'       => 'nullable|string',
                'description'   => 'nullable|string',
                'active'        => 'required'
            ]);
            
            // update into database
            $bank               = Bank::find($id);
            $bank->name         = $request['name'];
            $bank->address      = $request['address'];
            $bank->description  = $request['description'];
            $bank->active       = $request['active'];

            // if success
            if ($bank->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-info',
                    'message' => $request['name'].' berhasil diubah.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => $request['name'].' gagal diubah.'
            ]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            if (Bank::destroy($request['id'])) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-danger',
                    'message' => $request['name'].' berhasil dihapus.'
                ]);
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

    public function activate(Bank $bank)
    {
        try {            
            // insert into database
            $bank->active   = true;

            // if success
            if ($bank->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-success',
                    'message' => $bank->name.' berhasil diaktifkan.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => $bank->name.' gagal diaktifkan.'
            ]);
        }
    }

    public function deactivate(Bank $bank)
    {
        try {            
            // insert into database
            $bank->active   = false;

            // if success
            if ($bank->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-warning',
                    'message' => $bank->name.' berhasil dinonaktifkan.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => $bank->name.' gagal dinonaktifkan.'
            ]);
        }
    }
}
