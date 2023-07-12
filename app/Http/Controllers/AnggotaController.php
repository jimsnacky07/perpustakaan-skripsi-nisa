<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::latest()->with('user')->get();
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
        $data = $request->validate([
            'nisn' => 'required|unique:anggotas',
            'nama' => 'required',
            'jk' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'user_id' => 'required|unique:anggotas',
            'kelas' => 'required',
            // 'foto' => 'required',
        ], [
            'user_id.unique' => 'User sudah terdaftar sebagai anggota'
        ]);
        //upload image
        $image = $request->file('foto');
        $image->storeAs('public/foto', $image->hashName());

        $anggota = Anggota::create([
            'nisn' => $data['nisn'],
            'nama' => $data['nama'],
            'jk' => $data['jk'],
            'no_hp' => $data['no_hp'],
            'alamat' => $data['alamat'],
            'user_id' => $data['user_id'],
            'kelas' => $data['kelas'],
            'foto'     => $image->hashName(),
        ]);

        if ($anggota) {
            //redirect dengan pesan sukses
            return redirect()->route('anggota.index')->with('success', 'Data Anggota berhasil ditambahkan');
        } else {
            //redirect dengan pesan error
            return redirect()->route('anggota.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
        // Anggota::create($data);
    }

    public function edit($id)
    {
        $user = User::where('role', 0)->get();
        $anggota = Anggota::findOrFail($id);

        return view('pages.anggota.edit', compact('anggota', 'user'));
    }

    public function update(Request $request, $id)
    {
        // $data = $request->all();
        // $anggota = Anggota::findOrFail($id);
        // $anggota->update($data);

        $this->validate($request, [
            'nama' => 'required',
            'jk' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'kelas' => 'required',
            'foto' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        //get data Anggota by ID
        $anggota = Anggota::findOrFail($id);

        if ($request->file('foto') != "") {
            //hapus old image
            Storage::disk('local')->delete('public/foto/' . $anggota->foto);

            //upload new image
            $image = $request->file('foto');
            $image->storeAs('public/foto', $image->hashName());

            $anggota->foto = $image->hashName();
        }
        $anggota->nama = $request->nama;
        $anggota->jk = $request->jk;
        $anggota->no_hp = $request->no_hp;
        $anggota->alamat = $request->alamat;
        $anggota->kelas = $request->kelas;
        $anggota->save();

        return redirect()->route('anggota.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Data Anggota berhasil dihapus');
    }
}
