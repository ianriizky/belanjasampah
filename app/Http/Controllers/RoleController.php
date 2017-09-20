<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{    
    public function __construct()
    {
        // abort_if(!request()->ajax(), 403, 'Anda dilarang mengakses halaman ini');
    }
    
    public function index()
    {
        $roles = Role::all();

        return $roles->toJson();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $role = Role::find($id);
        return $role->toJson();
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            // validate request
            $this->validate($request, [
                'display_name'  => 'min:5|string',
                'description'   => 'string|max:100'
            ]);
            
            // update into database
            $role               = Role::find($request['id']);
            $role->display_name = $request['display_name'];
            $role->description  = $request['description'];

            // if success
            if ($role->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-info',
                    'message' => 'Peran '.$request['name'].' berhasil diubah.'
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

    public function destroy($id)
    {
        //
    }
}
