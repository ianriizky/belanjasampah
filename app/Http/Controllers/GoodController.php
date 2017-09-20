<?php

namespace App\Http\Controllers;

use App\Good;
use App\Koperasi;
use Image;
use Illuminate\Http\Request;

class GoodController extends Controller
{
    public function __construct()
    {
    	// abort_if(!request()->ajax(), 403, 'Anda dilarang mengakses halaman ini');
    }

    public function index()
    {
        $koperasi   = Koperasi::where('user_id', auth()->user()->id)->first();
        $goods      = Good::with(['category' => function ($q) {
                        $q->select('id', 'name');
                    }])->where('koperasi_id', $koperasi->id)->filter()->paginate();

        // menambahkan request lain seperti keyword
        if (request()->all()) {
            $goods->appends(request()->all());
        }

        return $goods->toJson();

    }

    public function get()
    {
        $koperasi   = Koperasi::where('user_id', auth()->user()->id)->first();
        $goods      = Good::select('id', 'name')
                        ->where('koperasi_id', $koperasi->id)
                        ->where('active', true)
                        ->get();

        return $goods->toJson();
    }

    public function gePriorityStatus()
    {
        $koperasi   = Koperasi::where('user_id', auth()->user()->id)->first();
        $good_count = Good::select('id', 'name')
                        ->where('koperasi_id', $koperasi->id)
                        ->where('priority', 'high')
                        ->count('priority');
        if ($good_count >= 3) {
            return response()->json([
                'status' => false,
            ]);
        } else {
            return response()->json([
                'status' => true,
            ]);
        }
    }

    public function getLastID()
    {
        $good = Good::latest()->first();
        if (empty($good)) {
            return response()->json(['id' => 1]);
        } else {
            return response()->json(['id' => $good->id+1]);
        }
    }

    public function store(Request $request)
    {
        try {
            // validate request
            $this->validate($request, [
                'koperasi_id'   => 'required',
                'category_id'   => 'required',
                'name'          => 'required|string',
                'description'   => 'nullable|string',
                'priority'      => 'required',
                'price'         => 'required',
            ]);
            
            // insert into database
            $pictureName        = $request['koperasi_id'].'-'.$request['id'].'.jpg';
            $good               = new Good;
            $good->id           = $request['id'];
            $good->koperasi_id  = $request['koperasi_id'];
            $good->category_id  = $request['category_id'];
            $good->name         = $request['name'];
            $good->description  = $request['description'];
            $good->priority     = $request['priority'];
            $good->price        = $request['price'];
            $good->active       = $request['active'];
            if ($request['picture'] != null) {
                $this->validate($request, [
                    'picture'       => 'image64:jpeg,jpg,png'
                ]);
                $good->picture      = asset('storage/img/'.$pictureName);
                Image::make($request['picture'])->encode('jpg')->resize(800, 800)->save(public_path('storage/img/').$pictureName);
            } else {
                $good->picture      = asset('storage/img/good.jpg');
            }

            // if success
            if ($good->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-success',
                    'message' => 'Barang '.$request['name'].' berhasil ditambah.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => 'Barang '.$request['name'].' gagal ditambah.'
            ]);
        }
    }

    public function show($id)
    {
        $good = Good::with(['category' => function ($q) {
                        $q->select('id', 'name');
                    }])->with(['koperasi' => function ($q) {
                        $q->select('id', 'name');
                    }])->with(['stocks' => function ($q) {
                        $q->with(['user' => function ($q) {
                            $q->select('id', 'name');
                        }]);
                    }])->find($id);
        return $good->toJson();
    }

    public function update(Request $request, $id)
    {
        try {
            // validate request
            $this->validate($request, [
                'category_id'   => 'required',
                'name'          => 'required|string',
                'description'   => 'nullable|string',
                'priority'      => 'required',
                'price'         => 'required',
            ]);
            
            // insert into database
            $pictureName        = $request['koperasi_id'].'-'.$request['id'].'.jpg';
            $good               = Good::find($id);
            $good->id           = $request['id'];
            $good->category_id  = $request['category_id'];
            $good->name         = $request['name'];
            $good->description  = $request['description'];
            $good->priority     = $request['priority'];
            $good->price        = $request['price'];
            $good->active       = $request['active'];
            if (strrpos($request['picture'], 'http://belanjasampah.dev/storage/img/') === false) {
                $this->validate($request, [
                    'picture'       => 'image64:jpeg,jpg,png'
                ]);
                $good->picture      = asset('storage/img/'.$pictureName);
                Image::make($request['picture'])->encode('jpg')->resize(800, 800)->save(public_path('storage/img/').$pictureName);
            }
            // if success
            if ($good->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-success',
                    'message' => 'Barang '.$request['name'].' berhasil diubah.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => 'Barang '.$request['name'].' gagal diubah.'
            ]);
        }
    }

    public function activate(Good $good)
    {
        try {
            $good->active = true;

            // if success
            if ($good->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-success',
                    'message' => 'Barang '.$good->name.' berhasil diaktifkan.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => true,
                'alert'   => 'alert-danger',
                'message' => 'Barang '.$good->name.' gagal diaktifkan.'
            ]);
        }
    }

    public function deactivate(Good $good)
    {
        try {
            $good->active = false;

            // if success
            if ($good->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-warning',
                    'message' => 'Barang '.$good->name.' berhasil dinonaktifkan.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => 'Barang '.$good->name.' gagal diaktifkan.'
            ]);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            if (Good::destroy($id)) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-danger',
                    'message' => 'Barang '.$request['name'].' berhasil dihapus.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => 'Barang '.$request['name'].' gagal dihapus.'
            ]);
        }
    }
}
