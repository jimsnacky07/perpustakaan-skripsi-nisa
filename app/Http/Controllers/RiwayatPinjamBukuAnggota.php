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

        $data = DB::table('detail_peminjaman')
            ->join('peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
            ->join('books', 'books.id', '=', 'detail_peminjaman.id_buku_pinjam')
            ->select('peminjaman.*', 'detail_peminjaman.*', 'books.*')
            ->where('peminjaman.id_anggota_peminjaman', '=', $anggota->id)
            ->where('detail_peminjaman.status', '=', '0')
            ->get();



        $data = DB::table('detail_peminjaman')
            ->join('peminjaman', 'detail_peminjaman.id_peminjaman', '=', 'peminjaman.id')
            ->join('books', 'books.id', '=', 'detail_peminjaman.id_buku_pinjam')
            ->where('peminjaman.id_anggota_peminjaman', '=', $anggota->id)
            ->select('detail_peminjaman.*', 'peminjaman.*', 'books.*')
            ->get();

        //ambil data detail peminjaman dan cocokkan dengan id_peminjaman dengan id di peminjaman 

        // $data = DB::table('peminjaman')
        //     ->join('anggotas', 'peminjaman.id_anggota_peminjaman', '=', 'anggotas.id')
        //     ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
        //     ->select('peminjaman.*', 'detail_peminjaman.*', 'anggotas.*')
        //     ->where('peminjaman.id_anggota_peminjaman', '=', $anggota->id)
        //     ->get();


        //koding riwayat pengembalian Buku
        // $data = DB::table('detail_peminjaman')
        //     ->join('peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
        //     ->join('books', 'books.id', '=', 'detail_peminjaman.id_buku_pinjam')
        //     ->join('pengembalians', 'pengembalians.id_buku', '=', 'detail_peminjaman.id_buku_pinjam')
        //     ->select('peminjaman.*', 'detail_peminjaman.*', 'books.*', 'pengembalians.*')
        //     ->where('peminjaman.id_anggota_peminjaman', '=', $anggota->id)
        //     ->where('pengembalians.id_anggota', '=', $anggota->id)
        //     ->get();



        return view('pages.riwayatPinjamBuku.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
