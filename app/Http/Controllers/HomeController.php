<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Good;
use App\Koperasi;
use App\Bank;
use App\Category;
use App\Receipt;
use App\Detailreceipt;
use App\Transaction;
use App\Customer;
use App\Stock;
use App\Code;

class HomeController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $goods_high     = Good::wherePriority('high')->get();
        // dd($goods_high);
        $goods_standard = Good::wherePriority('standard')->latest()->get();
        $koperasis      = Koperasi::get(['id', 'name']);
        $banks          = Bank::get(['id', 'name']);
        return view('home.index', compact('goods_high', 'goods_standard', 'koperasis', 'banks'));
    }

    public function categoryIndex()
    {
        $categories = Category::whereActive(true)->get(['id', 'name'])->toArray();
        $goods = Good::latest()->get();
        return view('category.index', compact('categories', 'goods'));
    }

    public function categoryShow($id)
    {
        try {
            $categories = Category::whereActive(true)->find($id)->get(['id', 'name'])->toArray();
            $goods = Good::latest()->where('category_id', $id)->get();
            return view('category.index', compact('categories', 'goods'));
        } catch (ModelNotFoundException $e) {
            return abort(404, 'Kategori tidak ditemukan');
        }
    }

    public function product($id)
    {
        try {
            $good = Good::with('koperasi')->findOrFail($id);
            return view('product.index', compact('good'));
        } catch (ModelNotFoundException $e) {
            return abort(404, 'Produk tidak ditemukan');
        }
    }

    public function transaction(Request $request)
    {
        try {
            if (!auth()->check() || !auth()->user()->hasRole('nasabah')) {
                flash()->overlay('Silahkan login sebagai nasabah untuk bisa mengakses sistem', 'Pemberitahuan');
                return redirect('/');
            } else {
                $good       = Good::findOrFail($request['good_id']);
                $quantity   = $request['good_quantity'];
                $subtotal   = $good->price * $quantity;
                return view('product.transaction', compact('good', 'quantity', 'subtotal'));
            }
        } catch (ModelNotFoundException $e) {
            return abort(404, 'Produk tidak ditemukan');
        }
    }

    public function storeReceipt(Request $request)
    {
        try {
            $customer = Customer::where('user_id', auth()->user()->id)->first();
            if ($customer->balance >= $request['damount'] * $request['dprice']) {
                $receipt = new Receipt;
                $receipt->koperasi_id = $request['koperasi_id'];
                $receipt->customer_id = auth()->user()->customer->id;
                $receipt->save();

                $detailreceipt = new Detailreceipt;
                $detailreceipt->receipt_id  = $receipt->id;
                $detailreceipt->good_id     = $request['good_id'];
                $detailreceipt->damount     = $request['damount'];
                $detailreceipt->dprice      = $request['dprice'];
                $detailreceipt->dtotal      = $request['damount'] * $request['dprice'];
                $detailreceipt->save();

                $this->updateBalance($detailreceipt->dtotal);
                $this->updateGood($detailreceipt->good_id, $detailreceipt->damount);
                flash()->overlay('Transaksi anda berhasil diproses. Silahkan tunggu pemberitahuan selanjutnya.', 'Pemberitahuan');
                return redirect('/');
            } else {
                flash()->overlay('Saldo anda tidak mencukupi untuk melakukan transaksi. Silahkan lakukan penyetoran sampah.', 'Pemberitahuan');
                return redirect('/');
            }            
        } catch (Exception $e) {
            return abort(500, 'Internal server error');
        }
    }

    public function updateBalance($value)
    {
        // define type code
        $code = Code::find(3);

        $transaction                = new Transaction;
        $transaction->code_id       = 3;
        $transaction->customer_id   = auth()->user()->customer->id;
        $transaction->value         = $code->type.$value;
        $transaction->save();
    }

    public function updateGood($good_id, $value)
    {
        $stock                = new Stock;
        $stock->good_id       = $good_id;
        $stock->user_id       = auth()->user()->id;
        $stock->value         = '-'.$value;
        $stock->save();
    }

    public function about()
    {
    	return view('about.index');
    }

    public function contact()
    {
    	return view('contact.index');
    }
}
