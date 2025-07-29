<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.user.index');
    }

    public function fetchUser(Request $request)
    {
        $user = User::all();

        if ($request->ajax()) {
            return datatables()->of($user)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <div class="btn-group">
                            <button id="btnEditUser" class="btn btn-warning btn-sm" data-id="' . $row['id'] . '">
                                <span class="fas fa-edit"></span> Edit
                            </button>
                            <button id="btnDeleteUser" class="btn btn-danger btn-sm mx-2" data-id="' . $row['id'] . '">
                                <span class="fas fa-trash-alt"></span> Hapus
                            </button>
                        </div>
                    ';
                })
                ->addColumn('checkbox', function ($row) {
                    return '
                         <input data-id="' . $row['id'] . '" type="checkbox" name="user_checkbox" id="user_checkbox">
                         <label for=""></label>
                    ';
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'email|required|unique:users,email',
            'role' => 'required',
            'password' => 'required|string',
        ], [
            'name.required' => 'Field Nama Wajib Diisi',
            'email.email' => 'Field Email Harus Valid Contoh : fazeel@gmail.com',
            'email.required' => 'Field Email Wajib Diisi',
            'email.unique' => 'Email Sudah Ada',
            'role.required' => 'Field role Wajib Diisi',
            'password.required' => 'Field Password Wajib Diisi',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validation->errors()->toArray(),
            ]);
        } else {
            $dataUser = new User();
            $dataUser->name = $request->name;
            $dataUser->email = $request->email;
            $dataUser->role = $request->role;
            $dataUser->password = Hash::make($request->password);
            $dataUser->save();

            return response()->json([
                'status' => 200,
                'success' => "Data User Berhasil Di Simpan",
                'redirect' => url('/login')
            ]);
        }
    }

    public function edit(Request $request)
    {
        $user = User::findOrFail($request->idUser);
        return response()->json([
            'status' => 200,
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'email|required',
            'role' => 'required',
            'password' => 'nullable',
        ], [
            'name.required' => 'Field Nama Wajib Diisi',
            'email.email' => 'Field Email Harus Valid Contoh : fazeel@gmail.com',
            'email.required' => 'Field Email Wajib Diisi',
            'role.required' => 'Field role Wajib Diisi',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validation->errors()->toArray(),
            ]);
        } else {
            $dataUser = User::findOrFail($request->idUser);
            $dataUser->name = $request->name;
            $dataUser->email = $request->email;

            if ($request->role == 'anggota') {
                $dataUser->role = 0;
            } elseif ($request->role == 'admin') {
                $dataUser->role = 1;
            } else {
                $dataUser->role = 2;
            }

            if ($request->password) {
                $dataUser->password = Hash::make($request->password);
            }

            $dataUser->update();

            return response()->json([
                'status' => 200,
                'success' => "Data User Dengan Nama " . $dataUser->name . " Berhasil Di Update"
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $dataUser = User::findOrFail($request->idUser);

        if ($dataUser->id == auth()->user()->id) {
            return response()->json([
                'status' => 400,
                'error' => "Tidak Bisa Hapus Data, Karena User Sedang Aktif"
            ]);
        }
        $dataUser->delete();

        return response()->json([
            'status' => 200,
            'success' => "Data Dengan Nama " . $dataUser->name . " Berhasil Di Hapus"
        ]);
    }

    public function destroySelected(Request $request)
    {
        $idUser = $request->idUsers;
        $query = User::whereIn('id', $idUser)->delete();

        if ($query) {
            return response()->json([
                'status' => 200,
                'success' => "Data User Berhasil Di Hapus"
            ]);
        }
    }
}
