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
        $countPeminjamanBuku = DB::table('peminjaman')->count();
        return view('pages.dashboard', compact('countBuku', 'countJenisBuku', 'countAnggota', 'countPeminjamanBuku'));
    }

    public function dashboardAnggota()
    {
        return view('pages.dashboard-anggota');
    }
}
