<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function kategoriBuku()
    {
        $kategoriBuku = DB::table('jenis_bukus')->get();
        $title = 'Laporan Kategori Buku';
        return view('pages.laporan.kategoriBuku', compact('kategoriBuku', 'title'));
    }

    public function anggota()
    {
        $anggota = DB::table('anggotas')->join('users', 'anggotas.user_id', '=', 'users.id')->get();
        $title = 'Laporan Data Anggota Perpustakaan';
        return view('pages.laporan.anggota', compact('anggota', 'title'));
    }

    public function buku()
    {
        $buku = DB::table('books')
            ->join('jenis_bukus', 'books.jenis_buku_id', '=', 'jenis_bukus.id')
            ->join('rak_bukus', 'books.rak_buku_id', '=', 'rak_bukus.id')
            ->select('books.*', 'jenis_bukus.name as nama_buku', 'rak_bukus.*')
            ->get();

        $title = 'Laporan Data Buku Perpustakaan';
        return view('pages.laporan.buku', compact('buku', 'title'));
    }

    public function rakBuku()
    {
        $rak = DB::table('rak_bukus')->get();
        $title = 'Laporan Data Rak Buku Perpustakaan';
        return view('pages.laporan.rak', compact('rak', 'title'));
    }

    public function riwayatPeminjaman()
    {
        $riwayatPeminjamanBuku = DB::table('peminjaman')
            ->join('anggotas', 'peminjaman.id_anggota_peminjaman', '=', 'anggotas.id')
            ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
            ->select('peminjaman.*', 'detail_peminjaman.*',  'anggotas.*')
            ->get();

        $title = 'Laporan Riwayat Peminjaman Buku Perpustakaan';

        return view('pages.laporan.riwayatPeminjaman', compact('riwayatPeminjamanBuku', 'title'));
    }
}
