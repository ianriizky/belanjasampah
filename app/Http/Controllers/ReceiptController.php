<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receipt;
use App\Detailreceipt;
use App\Koperasi;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $transactions = Transaction::with(['code', 'customer.user'])->filter()->paginate(request('limit', 5));
        // $transactions = Bank::with('transactions.customer.user')->filter()->paginate(request('limit', 5));
        $koperasi       = Koperasi::where('user_id', auth()->user()->id)->first();
        $receipts       = Receipt::where('koperasi_id', $koperasi->id)->with('detailreceipts.good')->with(['customer' => function ($q) {
                            $q->select('id', 'user_id')->with(['user' => function ($q) {
                                $q->select('id', 'name');
                            }]);
                        }])->filter()->latest()->paginate(request('limit', 5));

        // menambahkan request lain seperti keyword
        if (request()->all()) {
            $receipts->appends(request()->all());
        }

        return $receipts->toJson();
    }

    public function cetak()
    {
        $koperasi       = Koperasi::where('user_id', auth()->user()->id)->first();
        $receipts       = Receipt::where('koperasi_id', $koperasi->id)->with('detailreceipts.good')->with(['customer' => function ($q) {
                            $q->select('id', 'user_id')->with(['user' => function ($q) {
                                $q->select('id', 'name');
                            }]);
                        }])->filter()->latest()->paginate(request('limit', 5));

        // menambahkan request lain seperti keyword
        if (request()->all()) {
            $receipts->appends(request()->all());
        }

        // return $receipts->toJson();
        return view('cetak.index', compact('receipts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $receipt = Receipt::find($id);
        return $receipt->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (Receipt::destroy($id)) {
                Detailreceipt::where('receipt_id', $id)->delete();
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

    public function activate(Receipt $receipt)
    {
        try {
            // $user->active           = true;
            $receipt->status = 'verified';

            // if success
            if ($receipt->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-success',
                    'message' => $receipt->id.' berhasil diaktifkan.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => true,
                'alert'   => 'alert-danger',
                'message' => $receipt->id.' gagal diaktifkan.'
            ]);
        }
    }

    public function deactivate(Receipt $receipt)
    {
        try {
            // $user->active           = false;
            $receipt->status = 'processed';

            // if success
            if ($receipt->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-warning',
                    'message' => $receipt->id.' berhasil dinonaktifkan.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => $receipt->id.' gagal diaktifkan.'
            ]);
        }
    }
}
