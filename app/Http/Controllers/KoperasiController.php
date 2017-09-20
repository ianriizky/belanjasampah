<?php

namespace App\Http\Controllers;

use App\Koperasi;
use Illuminate\Http\Request;

class KoperasiController extends Controller
{
    public function __construct()
    {
        // abort_if(!request()->ajax(), 403, 'Anda dilarang mengakses halaman ini');
    }

    public function index()
    {
        $koperasis    = Koperasi::filter()->paginate(request('limit', 5));

        // menambahkan request lain seperti keyword
        if (request()->all()) {
            $koperasis->appends(request()->all());
        }

        return $koperasis->toJson();
    }

    public function getLastID()
    {
        $str = "KOPR";
        $koperasi = Koperasi::latest()->first();
        if (empty($koperasi)) {
            $order_number = 1;
        } else {
            $order_number = $koperasi->order_number+1;
        }

        $koperasi_id =  $str.str_pad($order_number, 6, '0', STR_PAD_LEFT);
        return response()->json([
            'id'            => $koperasi_id,
            'order_number'  => $order_number
        ]);
    }

    public function getKoperasiID()
    {
        $koperasi       = Koperasi::where('user_id', auth()->user()->id)->first(['id']);

        return response()->json([
            'koperasi_id'      => $koperasi->id,
        ]);
    }

    public function getAuthKoperasi()
    {
       $koperasi       = Koperasi::where('user_id', auth()->user()->id)->with(['user' => function($q) {
                               $q->select('id', 'name');
                           }])->first();

       return $koperasi->toJson();
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
            $koperasi               = new Koperasi;
            $koperasi->id           = $request['id'];
            $koperasi->user_id      = $request['user_id'];
            $koperasi->name         = $request['name'];
            $koperasi->address      = $request['address'];
            $koperasi->description  = $request['description'];
            $koperasi->order_number = $request['order_number'];
            $koperasi->active       = $request['active'];

            // if success
            if ($koperasi->save()) {
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
        $koperasi = Koperasi::with(['user' => function($q) {
                        $q->select('id', 'name');
                    }])->findOrFail($id);
        return $koperasi->toJson();
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
            $koperasi               = Koperasi::find($id);
            $koperasi->name         = $request['name'];
            $koperasi->address      = $request['address'];
            $koperasi->description  = $request['description'];
            $koperasi->active       = $request['active'];

            // if success
            if ($koperasi->save()) {
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
            if (Koperasi::destroy($request['id'])) {
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

    public function activate(Koperasi $koperasi)
    {
        try {            
            // insert into database
            $koperasi->active   = true;

            // if success
            if ($koperasi->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-success',
                    'message' => $koperasi->name.' berhasil diaktifkan.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => $koperasi->name.' gagal diaktifkan.'
            ]);
        }
    }

    public function deactivate(Koperasi $koperasi)
    {
        try {            
            // insert into database
            $koperasi->active   = false;

            // if success
            if ($koperasi->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-warning',
                    'message' => $koperasi->name.' berhasil dinonaktifkan.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => $koperasi->name.' gagal dinonaktifkan.'
            ]);
        }
    }
}
