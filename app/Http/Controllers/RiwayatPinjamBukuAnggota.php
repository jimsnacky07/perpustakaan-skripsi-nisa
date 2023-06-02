<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatPinjamBukuAnggota extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userIdLogin = auth()->user()->id;
        $anggota = DB::table('anggotas')->where('user_id', '=', $userIdLogin)->first();

        // $data = DB::table('detail_peminjaman')
        //     ->join('peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
        //     ->join('books', 'books.id', '=', 'detail_peminjaman.id_buku_pinjam')
        //     ->select('peminjaman.*', 'detail_peminjaman.*', 'books.*')
        //     ->where('peminjaman.id_anggota_peminjaman', '=', $anggota->id)
        //     ->where('detail_peminjaman.status', '=', '0')
        //     ->get();



        // $data = DB::table('detail_peminjaman')
        //     ->join('peminjaman', 'detail_peminjaman.id_peminjaman', '=', 'peminjaman.id')
        //     ->join('books', 'books.id', '=', 'detail_peminjaman.id_buku_pinjam')
        //     ->where('peminjaman.id_anggota_peminjaman', '=', $anggota->id)
        //     ->select('detail_peminjaman.*', 'peminjaman.*', 'books.*')
        //     ->get();

        // ambil data detail peminjaman dan cocokkan dengan id_peminjaman dengan id di peminjaman 

        $peminjaman = DB::table('peminjaman')
            ->where('peminjaman.id_anggota_peminjaman', '=', $anggota?->id)
            ->get();

        // dd($peminjaman);
        // dd($peminjaman);

        $detailPeminjaman = DB::table('detail_peminjaman')
            ->join('books', 'books.id', '=', 'detail_peminjaman.id_buku_pinjam')
            ->select('detail_peminjaman.*', 'books.*')
            // ->where('detail_peminjaman.status', '=', '0')
            ->orderBy('detail_peminjaman.status', 'asc')
            ->get();
        // dd($detailPeminjaman);



        return view('pages.riwayatPinjamBuku.index', compact('peminjaman', 'detailPeminjaman', 'anggota'));

        //koding riwayat pengembalian Buku
        // $data = DB::table('detail_peminjaman')
        //     ->join('peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
        //     ->join('books', 'books.id', '=', 'detail_peminjaman.id_buku_pinjam')
        //     ->join('pengembalians', 'pengembalians.id_buku', '=', 'detail_peminjaman.id_buku_pinjam')
        //     ->select('peminjaman.*', 'detail_peminjaman.*', 'books.*', 'pengembalians.*')
        //     ->where('peminjaman.id_anggota_peminjaman', '=', $anggota->id)
        //     ->where('pengembalians.id_anggota', '=', $anggota->id)
        //     ->get();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function riwayatPengembalianBuku()
    {
        $userIdLogin = auth()->user()->id;
        $anggota = DB::table('anggotas')->where('user_id', '=', $userIdLogin)->first();
        // ambil data detail peminjaman dan cocokkan dengan id_peminjaman dengan id di peminjaman 

        // Kodingan Pengembalian Buku yang Sudah Fix
        $pengembalian = DB::table('pengembalians')
            ->join('books', 'books.id', '=', 'pengembalians.id_buku')
            ->where('pengembalians.id_anggota', '=', $anggota?->id)
            ->get();
        // dd($pengembalian);

        $totalDenda = DB::table('pengembalians')
            ->join('books', 'books.id', '=', 'pengembalians.id_buku')
            ->where('pengembalians.id_anggota', '=', $anggota?->id)
            ->sum('pengembalians.denda');

        $totalHariTerlambat = DB::table('pengembalians')
            ->join('books', 'books.id', '=', 'pengembalians.id_buku')
            ->where('pengembalians.id_anggota', '=', $anggota?->id)
            ->sum('pengembalians.jumlah_hari_terlambat');
        // dd($totalDenda);

        // $pengembalian = DB::table('pengembalians')
        //     ->where('pengembalians.id_anggota', '=', $anggota->id)
        //     ->get();
        // // dd($pengembalian);

        // $detailPengembalian = DB::table('detail_peminjaman')
        //     ->join('books', 'books.id', '=', 'detail_peminjaman.id_buku_pinjam')
        //     ->select('detail_peminjaman.*', 'books.*')
        //     ->where('detail_peminjaman.status', '=', '1')
        //     ->get();

        // dd($detailPengembalian);

        // return view('pages.riwayatPinjamBuku.pengembalian_buku', compact('pengembalian', 'detailPengembalian', 'anggota'));
        return view('pages.riwayatPinjamBuku.pengembalian_buku', compact('pengembalian', 'anggota', 'totalDenda', 'totalHariTerlambat'));


        // koding riwayat pengembalian Buku

    }
}
