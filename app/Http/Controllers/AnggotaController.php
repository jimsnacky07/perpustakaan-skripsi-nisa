<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::where('status', 'aktif')
            ->orWhereNull('status')
            ->latest()
            ->with(['user', 'pengembalians', 'peminjamans'])
            ->get();
        return view('pages.anggota.index', compact('anggota'));
    }

    public function create()
    {
        $userIdsTerdaftar = Anggota::pluck('user_id')->toArray();
        $user = User::whereNotIn('id', $userIdsTerdaftar)->where('role', 0)->get();
        return view('pages.anggota.create', compact('user'));
    }

    public function store(Request $request)
    {
        // Debug: Log request data
        Log::info('Anggota Store Request', $request->all());
        Log::info('User authenticated', [
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name ?? 'Unknown',
            'user_role' => auth()->user()->role ?? 'Unknown'
        ]);

        $data = $request->validate([
            'nisn' => 'required|string|regex:/^\d{10}$/|unique:anggotas',
            'nama' => 'required|string|max:255',
            'jk' => 'required|in:L,P',
            'no_hp' => 'required|string|min:10|max:15',
            'alamat' => 'required|string|max:500',
            'user_id' => 'required|unique:anggotas|exists:users,id',
            'kelas' => 'required|string|max:10',
        ], [
            'nisn.required' => 'NISN wajib diisi',
            'nisn.regex' => 'NISN harus berupa 10 digit angka',
            'nisn.unique' => 'NISN sudah terdaftar',
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 255 karakter',
            'jk.required' => 'Jenis kelamin wajib dipilih',
            'jk.in' => 'Jenis kelamin harus L atau P',
            'no_hp.required' => 'Nomor HP wajib diisi',
            'no_hp.min' => 'Nomor HP minimal 10 digit',
            'no_hp.max' => 'Nomor HP maksimal 15 digit',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.max' => 'Alamat maksimal 500 karakter',
            'user_id.required' => 'User wajib dipilih',
            'user_id.unique' => 'User sudah terdaftar sebagai anggota',
            'user_id.exists' => 'User tidak ditemukan',
            'kelas.required' => 'Kelas wajib diisi',
            'kelas.max' => 'Kelas maksimal 10 karakter',
        ]);

        try {
            $anggota = Anggota::create([
                'nisn' => $data['nisn'],
                'nama' => $data['nama'],
                'jk' => $data['jk'],
                'no_hp' => $data['no_hp'],
                'alamat' => $data['alamat'],
                'user_id' => $data['user_id'],
                'kelas' => $data['kelas'],
                'status' => 'aktif',
            ]);

            Log::info('Anggota baru ditambahkan', [
                'nisn' => $data['nisn'],
                'nama' => $data['nama'],
                'user_id' => auth()->id()
            ]);

            return redirect()->route('anggota.index')->with('success', 'Data Anggota berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Gagal menambahkan anggota', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('anggota.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit($id)
    {
        $user = User::where('role', 0)->get();
        $anggota = Anggota::findOrFail($id);

        return view('pages.anggota.edit', compact('anggota', 'user'));
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);

        $this->validate($request, [
            'nama' => 'required|string|max:255',
            'jk' => 'required|in:L,P',
            'no_hp' => 'required|string|min:10|max:15',
            'alamat' => 'required|string|max:500',
            'kelas' => 'required|string|max:10',
            'foto' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 255 karakter',
            'jk.required' => 'Jenis kelamin wajib dipilih',
            'jk.in' => 'Jenis kelamin harus L atau P',
            'no_hp.required' => 'Nomor HP wajib diisi',
            'no_hp.min' => 'Nomor HP minimal 10 digit',
            'no_hp.max' => 'Nomor HP maksimal 15 digit',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.max' => 'Alamat maksimal 500 karakter',
            'kelas.required' => 'Kelas wajib diisi',
            'kelas.max' => 'Kelas maksimal 10 karakter',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus PNG, JPG, atau JPEG',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        try {
            if ($request->file('foto') != "") {
                //hapus old image
                if ($anggota->foto) {
                    Storage::disk('local')->delete('public/foto/' . $anggota->foto);
                }

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

            Log::info('Anggota diupdate', [
                'nisn' => $anggota->nisn,
                'nama' => $request->nama,
                'user_id' => auth()->id()
            ]);

            return redirect()->route('anggota.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } catch (\Exception $e) {
            Log::error('Gagal mengupdate anggota', ['error' => $e->getMessage()]);
            return redirect()->route('anggota.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);

        // Cek apakah anggota masih memiliki peminjaman aktif
        $peminjamanAktif = DB::table('detail_peminjaman')
            ->join('peminjaman', 'detail_peminjaman.id_peminjaman', '=', 'peminjaman.id')
            ->where('peminjaman.id_anggota_peminjaman', $id)
            ->where('detail_peminjaman.status', 0)
            ->count();

        if ($peminjamanAktif > 0) {
            return redirect()->route('anggota.index')->with(['error' => 'Anggota tidak dapat dihapus karena masih memiliki peminjaman aktif!']);
        }

        // Cek apakah anggota memiliki denda belum lunas (tanpa status_pembayaran)
        $dendaBelumLunas = DB::table('pengembalians')
            ->where('id_anggota', $id)
            ->where('denda', '>', 0)
            ->sum('denda');

        if ($dendaBelumLunas > 0) {
            return redirect()->route('anggota.index')->with(['error' => 'Anggota tidak dapat dihapus karena masih memiliki denda belum lunas!']);
        }

        try {
            // Soft delete - ubah status menjadi nonaktif dan set deleted_at
            $anggota->status = 'nonaktif';
            $anggota->deleted_at = now();
            $anggota->save();

            Log::info('Anggota dinonaktifkan', [
                'nisn' => $anggota->nisn,
                'nama' => $anggota->nama,
                'user_id' => auth()->id()
            ]);

            return redirect()->route('anggota.index')->with('success', 'Data Anggota berhasil dinonaktifkan');
        } catch (\Exception $e) {
            Log::error('Gagal menonaktifkan anggota', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('anggota.index')->with(['error' => 'Data Gagal Dinonaktifkan!']);
        }
    }

    // Method untuk mengaktifkan kembali anggota
    public function activate($id)
    {
        try {
            $anggota = Anggota::findOrFail($id);

            $anggota->status = 'aktif';
            $anggota->deleted_at = null;
            $anggota->save();

            Log::info('Anggota diaktifkan kembali', [
                'nisn' => $anggota->nisn,
                'nama' => $anggota->nama,
                'user_id' => auth()->id()
            ]);

            return redirect()->route('anggota.index')->with('success', 'Data Anggota berhasil diaktifkan kembali');
        } catch (\Exception $e) {
            Log::error('Gagal mengaktifkan anggota', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('anggota.index')->with(['error' => 'Data Gagal Diaktifkan!']);
        }
    }
}
