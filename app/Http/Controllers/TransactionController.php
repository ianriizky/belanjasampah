<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Code;
use App\Bank;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        // $transactions = Transaction::with(['code', 'customer.user'])->filter()->paginate(request('limit', 5));
        // $transactions = Bank::with('transactions.customer.user')->filter()->paginate(request('limit', 5));
        $bank         = Bank::where('user_id', auth()->user()->id)->first();
        $transactions = Transaction::with(['customer' => function ($q) use($bank) {
                            $q->where('bank_id', $bank->id)->select('id', 'user_id')->with(['user' => function ($q) {
                                $q->select('id', 'name');
                            }]);
                        }])->with(['code' => function ($q) {
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
        $transaction = Transaction::latest()->first();
        if (empty($transaction)) {
            return response()->json(['id' => 1]);
        } else {
            return response()->json(['id' => $transaction->id+1]);
        }
    }

    public function getHistory()
    {
        $transactions = Transaction::with(['customer' => function ($q) {
                            $q->where('user_id', auth()->user()->id)->select('id', 'user_id')->with(['user' => function ($q) {
                                $q->select('id', 'name');
                            }]);
                        }])->with(['code' => function ($q) {
                            $q->select('id', 'name');
                        }])->filter()->latest()->paginate(request('limit', 5));

        // menambahkan request lain seperti keyword
        if (request()->all()) {
            $transactions->appends(request()->all());
        }

        return $transactions->toJson();
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);
        return $transaction->toJson();
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'id'            => 'required',
                'code_id'       => 'required',
                'customer_id'   => 'required',
                'value'         => 'required|numeric|min:0'
            ]);

            // define type code
            $code = Code::find($request['code_id']);

            // insert into users
            $transaction                = new Transaction;
            $transaction->id            = $request['id'];
            $transaction->code_id       = $request['code_id'];
            $transaction->customer_id   = $request['customer_id'];
            $transaction->value         = $code->type.$request['value'];

            // if success
            if ($transaction->save()) {
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-success',
                    'message' => 'Transaksi berhasil ditambah.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => 'Transaksi gagal ditambah.'
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            if (Transaction::destroy($id)) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-danger',
                    'message' => 'Transaksi dengan ID '.$id.' berhasil dihapus.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => 'Transaksi dengan ID'.$id.' gagal dihapus.'
            ]);
        }
    }
}
