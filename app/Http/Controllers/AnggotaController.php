<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::with('user')->get();
        // dd($anggota);
        return view('pages.anggota.index', compact('anggota'));
    }

    public function create()
    {

        $userIdsTerdaftar = Anggota::pluck('user_id')->toArray();
        $user = User::whereNotIn('id', $userIdsTerdaftar)->where('role', 0)->get();
        // $user = User::where('role', 0)->get();
        // $user = Anggota::whereDoesntHave('user')->get();
        return view('pages.anggota.create', compact('user'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:anggotas',
            'nama' => 'required',
            'jk' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'user_id' => 'required|unique:anggotas',
        ], [
            'user_id.unique' => 'User sudah terdaftar sebagai anggota'
        ]);

        Anggota::create($request->all());

        return redirect()->route('anggota.index')->with('success', 'Data Anggota berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::where('role', 0)->get();
        $anggota = Anggota::findOrFail($id);

        return view('pages.anggota.edit', compact('anggota', 'user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $anggota = Anggota::findOrFail($id);
        $anggota->update($data);

        return redirect(route('anggota.index'))->with('success', 'Data Anggota berhasil diupdate');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Data Anggota berhasil dihapus');
    }
}
