<?php

namespace App\Http\Controllers;

use App\Code;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function __construct()
    {
        // abort_if(!request()->ajax(), 403, 'Anda dilarang mengakses halaman ini');
    }

    public function index()
    {
        $codes = Code::filter()->orderBy('id')->paginate(request('limit', 5));

        // menambahkan request lain seperti keyword
        if (request()->all()) {
            $codes->appends(request()->all());
        }

        return $codes->toJson();
    }

    public function getSetoran()
    {
        $codes = Code::orderBy('id')->whereActive(true)->whereType('+')->get(['id', 'name']);

        return $codes->toJson();
    }

    public function getPenarikan()
    {
        $codes = Code::orderBy('id')->whereActive(true)->whereType('-')->get(['id', 'name']);

        return $codes->toJson();
    }

    public function getLastID()
    {
        $code = Code::orderBy('id', 'desc')->first();
        if (empty($code)) {
            return response()->json(['id' => 1]);
        } else {
            return response()->json(['id' => $code->id+1]);
        }
    }

    public function show($id)
    {
        $code = Code::find($id);
        return $code->toJson();
    }

    public function store(Request $request)
    {
        try {
            // validate request
            $this->validate($request, [
                'name'          => 'required|string|unique:codes',
                'description'   => 'nullable|string'
            ]);
            
            // insert into database
            $code               = new Code;
            $code->id           = $request['id'];
            $code->name         = $request['name'];
            $code->description  = $request['description'];
            $code->type         = $request['type'];
            $code->active       = $request['active'];

            // if success
            if ($code->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-success',
                    'message' => 'Kode transaksi '.$request['name'].' berhasil ditambah.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => 'Kategori barang '.$request['name'].' gagal ditambah.'
            ]);
        }
    }

    public function update(Request $request)
    {
        try {
            // validate request
            $this->validate($request, [
                'name'          => 'required|string',
                'description'   => 'nullable|string'
            ]);
            
            // update into database
            $code               = Code::find($request['id']);
            $code->name         = $request['name'];
            $code->description  = $request['description'];
            $code->type         = $request['type'];
            $code->active       = $request['active'];

            // if success
            if ($code->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-info',
                    'message' => 'Kode transaksi '.$request['name'].' berhasil diubah.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => 'Kategori barang '.$request['name'].' gagal diubah.'
            ]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            if (Code::destroy($request['id'])) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-danger',
                    'message' => 'Kode transaksi '.$request['name'].' berhasil dihapus.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => 'Kode transaksi '.$request['name'].' gagal dihapus.'
            ]);
        }        
    }
}
