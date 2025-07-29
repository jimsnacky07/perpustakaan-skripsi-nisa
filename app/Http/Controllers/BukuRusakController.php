<?php

namespace App\Http\Controllers;

use App\Models\BukuRusak;
use Illuminate\Http\Request;

class BukuRusakController extends Controller
{
    public function index()
    {
        $bukuRusak = BukuRusak::with('book')->get();
        return view('pages.bukurusak.index', compact('bukuRusak'));
    }

    public function create()
    {
        return view('pages.bukurusak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judulbuku' => 'required',
            'jumlahrusak' => 'required|integer',
            'penyebab' => 'nullable',
            'keterangan' => 'nullable',
        ]);
        BukuRusak::create($request->only(['judulbuku', 'jumlahrusak', 'penyebab', 'keterangan']));
        return redirect()->route('bukurusak.index')->with('success', 'Data buku rusak berhasil ditambahkan.');
    }

    public function show($id)
    {
        $bukuRusak = BukuRusak::findOrFail($id);
        return view('pages.bukurusak.show', compact('bukuRusak'));
    }

    public function edit($id)
    {
        $bukuRusak = BukuRusak::findOrFail($id);
        return view('pages.bukurusak.edit', compact('bukuRusak'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judulbuku' => 'required',
            'jumlahrusak' => 'required|integer',
            'penyebab' => 'nullable',
            'keterangan' => 'nullable',
        ]);
        $bukuRusak = BukuRusak::findOrFail($id);
        $bukuRusak->update($request->only(['judulbuku', 'jumlahrusak', 'penyebab', 'keterangan']));
        return redirect()->route('bukurusak.index')->with('success', 'Data buku rusak berhasil diupdate.');
    }

    public function destroy($id)
    {
        $bukuRusak = BukuRusak::findOrFail($id);
        $bukuRusak->delete();
        return redirect()->route('bukurusak.index')->with('success', 'Data buku rusak berhasil dihapus.');
    }
}