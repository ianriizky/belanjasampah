<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Crypt;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        // abort_if(!request()->ajax(), 403, 'Anda dilarang mengakses halaman ini');
    }

    public function index()
    {
        $users = User::with(['roles' => function ($q) {
                    $q->select('id', 'display_name');
                }])->filter()->latest()->paginate(request('limit', 5));

        // menambahkan request lain seperti keyword
        if (request()->all()) {
            $users->appends(request()->all());
        }

        return $users->toJson();
    }

    public function getUserID()
    {
        return response()->json([
            'user_id' => auth()->user()->id,
        ]);
    }

    public function getIDForKoperasi()
    {
        $users = User::join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('role_user.role_id', 2)
            ->where('active', true)
            ->doesntHave('koperasi')
            ->get();

        return $users->toJson();
    }

    public function getIDForBank()
    {
        $users = User::join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('role_user.role_id', 3)
            ->where('active', true)
            ->doesntHave('bank')
            ->get(['id', 'name']);

        return $users->toJson();
    }

    public function profil()
    {
        $user = User::with(['bank', 'koperasi'])->with(['roles' => function ($q) {
                    $q->select('id', 'name');
                }])->find(auth()->user()->id);

        return $user->toJson();
    }

    public function store(Request $request)
    {
        try {
            // validate request
            $this->validate($request, [
                'id'            => 'required|min:4|max:15|alpha_dash|unique:users,id',
                'email'         => 'required|string|email|max:255|unique:users,email',
                'name'          => 'required|string|max:50',
                'address'       => 'nullable|string',
                'phone_number'  => 'nullable|numeric|digits_between:11,15',
                'gender'        => 'nullable',
                'birth_date'    => 'nullable|date|before_or_equal:today',
                'password'      => 'required|string|min:4|confirmed',
                'role_id'       => 'required'
            ]);
            
            // insert into database
            $user               = new User;
            $user->id           = strtolower($request['id']);
            $user->email        = $request['email'];
            $user->name         = $request['name'];
            $user->address      = $request['address'];
            $user->phone_number = str_replace('-', 'replace', $request['phone_number']);
            $user->gender       = $request['gender'];
            $user->birth_date   = $request['birth_date'];
            $user->password     = bcrypt($request['password']);
            $user->active       = $request['active'];

            // if success
            if ($user->save()) {
                $user->attachRole($request['role_id']);
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-info',
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
        $user = User::with(['roles' => function ($q) {
                    $q->select('id', 'name', 'display_name', 'description');
                }])->find($id);
        return $user->toJson();
    }

    public function updateProfil(Request $request, User $user)
    {
        try {
            // validate request
            $this->validate($request, [
                // 'id'            => 'required',
                'email'         => 'required|string|email|max:255|unique:users,email,'.$user->id,
                'name'          => 'required|string|max:50',
                'phone_number'  => 'nullable|numeric|digits_between:11,15',
                'birth_date'    => 'nullable|date|before_or_equal:today',
            ]);
            
            // update into database
            $user               = User::find($user->id);
            // $user->id           = $request['id'];
            $user->email        = $request['email'];
            $user->name         = $request['name'];
            $user->address      = $request['address'];
            $user->phone_number = $request['phone_number'];
            $user->gender       = $request['gender'];
            $user->birth_date   = $request['birth_date'];

            // if success
            if ($user->save()) {
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

    public function updatePassword(Request $request, User $user)
    {
        try {
            // validate request
            $this->validate($request, [
                'password'  => 'required|min:4|confirmed'
            ]);
            
            // update into database
            $user               = User::find($user->id);
            $user->password     = bcrypt($request['password']);

            // if success
            if ($user->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-info',
                    'message' => 'Password '.$request['name'].' berhasil diubah. (password: '.$request['password'].')'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => 'Password '.$request['name'].' gagal diubah.'
            ]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            if (User::destroy($request['id'])) {
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

    public function activate(User $user)
    {
        try {
            // insert into database
            $user->active   = true;

            // if success
            if ($user->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-success',
                    'message' => $user->name.' berhasil diaktifkan.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => true,
                'alert'   => 'alert-danger',
                'message' => $user->name.' gagal diaktifkan.'
            ]);
        }
    }

    public function deactivate(User $user)
    {
        try {
            // insert into database
            $user->active   = false;

            // if success
            if ($user->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-warning',
                    'message' => $user->name.' berhasil dinonaktifkan.'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => $user->name.' gagal diaktifkan.'
            ]);
        }
    }

    public function reset(User $user)
    {
        try {
            // insert into database
            $user->password   = bcrypt('123456');

            // if success
            if ($user->save()) {
                // return as JSON
                return response()->json([
                    'success' => true,
                    'alert'   => 'alert-danger',
                    'message' => $user->name.' berhasil direset passwordnya (password: 123456).'
                ]);
            }
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'success' => false,
                'alert'   => 'alert-danger',
                'message' => $user->name.' gagal direset passwordnya.'
            ]);
        }
    }
}
