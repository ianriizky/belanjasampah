<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct()
    {
    	// abort_if(!request()->ajax(), 403, 'Anda dilarang mengakses halaman ini');
    }

    public function index()
    {
        $categories = Category::filter()->orderBy('id')->paginate(request('limit', 5));

        // menambahkan request lain seperti keyword
        if (request()->all()) {
            $categories->appends(request()->all());
        }

        return $categories->toJson();
    }

    public function get()
    {
        $categories = Category::orderBy('id')->where('active', true)->get(['id', 'name']);

        return $categories->toJson();
    }

    public function getLastID()
    {
        $category = Category::orderBy('id', 'desc')->first();
        if (empty($category)) {
            return response()->json(['id' => 1]);
        } else {
            return response()->json(['id' => $category->id+1]);
        }
    }

    public function show($id)
    {
        $category = Category::find($id);
        return $category->toJson();
    }

    public function store(Request $request)
    {
        try {
            // validate request
            $this->validate($request, [
                'name'          => 'required|string|unique:categories',
                'description'   => 'nullable|string'
            ]);
            
            // insert into database
            $category               = new Category;
            $category->id           = $request['id'];
            $category->name         = $request['name'];
            $category->description  = $request['description'];
            $category->unit         = $request['unit'];
            $category->active       = $request['active'];

            // if success
            if ($category->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-success',
                    'message' => 'Kategori barang '.$request['name'].' berhasil ditambah.'
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

    public function update(Request $request) // undone
    {
        try {
            // validate request
            $this->validate($request, [
                'name'          => 'required|string',
                'description'   => 'nullable|string'
            ]);
            
            // update into database
            $category               = Category::find($request['id']);
            $category->name         = $request['name'];
            $category->description  = $request['description'];
            $category->unit         = $request['unit'];
            $category->active       = $request['active'];

            // if success
            if ($category->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-info',
                    'message' => 'Kategori barang '.$request['name'].' berhasil diubah.'
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
            if (Category::destroy($request['id'])) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-danger',
                    'message' => 'Kategori barang '.$request['name'].' berhasil dihapus.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => 'Kategori barang '.$request['name'].' gagal dihapus.'
            ]);
        }        
    }
}
