<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Koperasi;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        // $transactions = Transaction::with(['code', 'customer.user'])->filter()->paginate(request('limit', 5));
        // $transactions = Bank::with('transactions.customer.user')->filter()->paginate(request('limit', 5));
        $koperasi     = Koperasi::where('user_id', auth()->user()->id)->first();
        $transactions = Stock::with(['good' => function ($q) use($koperasi) {
                            $q->where('koperasi_id', $koperasi->id)->select('id', 'name');
                        }])->with(['user' => function ($q) {
                            $q->select('id', 'name');
                        }])->filter()->latest()->paginate(request('limit', 5));

        // menambahkan request lain seperti keyword
        if (request()->all()) {
            $transactions->appends(request()->all());
        }

        return $transactions->toJson();
    }

    public function getLastID()
    {
        $stock = Stock::latest()->first();
        if (empty($stock)) {
            return response()->json(['id' => 1]);
        } else {
            return response()->json(['id' => $stock->id+1]);
        }
    }

    public function show($id)
    {
        $stock = Stock::find($id);
        return $stock->toJson();
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'id'            => 'required',
                'good_id'       => 'required',
                'user_id'       => 'required',
                'value'         => 'required|numeric|min:0'
            ]);

            // insert into users
            $stock                = new Stock;
            $stock->id            = $request['id'];
            $stock->good_id       = $request['good_id'];
            $stock->user_id       = $request['user_id'];
            $stock->value         = $request['type'].$request['value'];

            // if success
            if ($stock->save()) {
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-success',
                    'message' => 'Stok berhasil ditambah.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => 'Stok gagal ditambah.'
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            if (Stock::destroy($id)) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-danger',
                    'message' => 'Stok dengan ID '.$id.' berhasil dihapus.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => 'Stok dengan ID'.$id.' gagal dihapus.'
            ]);
        }
    }
}
