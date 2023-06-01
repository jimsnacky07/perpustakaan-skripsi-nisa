<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $countBuku = DB::table('books')->count();
        $countJenisBuku = DB::table('jenis_bukus')->count();
        $countAnggota = DB::table('anggotas')->count();
        // $countPeminjamanBuku = DB::table('peminjaman')->count();
        $countPeminjamanBuku = DB::table('peminjaman')
            ->distinct('id_anggota_peminjaman')
            ->count('id_anggota_peminjaman');
        return view('pages.dashboard', compact('countBuku', 'countJenisBuku', 'countAnggota', 'countPeminjamanBuku'));
    }

    public function dashboardAnggota()
    {
        $countBuku = DB::table('books')->count();
        $countJenisBuku = DB::table('jenis_bukus')->count();

        $userIdLogin = auth()->user()->id;
        $anggota = DB::table('anggotas')->where('user_id', '=', $userIdLogin)->first();

        $jumlahBukuDipinjam = DB::table('detail_peminjaman')
            ->join('peminjaman', 'detail_peminjaman.id_peminjaman', '=', 'peminjaman.id')
            ->join('books', 'books.id', '=', 'detail_peminjaman.id_buku_pinjam')
            ->where('peminjaman.id_anggota_peminjaman', '=', $anggota?->id)
            ->where('detail_peminjaman.status', '=', 0)
            ->count();
        // dd($jumlahBukuDipinjam);

        return view('pages.dashboard-anggota', compact('countBuku', 'countJenisBuku', 'jumlahBukuDipinjam'));
    }

    public function dashboardPimpinan()
    {
        $countBuku = DB::table('books')->count();
        $countJenisBuku = DB::table('jenis_bukus')->count();
        $countAnggota = DB::table('anggotas')->count();
        $countPeminjamanBuku = DB::table('peminjaman')->count();
        return view('pages.dashboard', compact('countBuku', 'countJenisBuku', 'countAnggota', 'countPeminjamanBuku'));
    }
}
