<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data['peminjaman'] = DB::table('peminjaman')
            ->join('anggotas', 'peminjaman.id_anggota_peminjaman', '=', 'anggotas.id')
            ->select('peminjaman.*', 'anggotas.nama')
            ->get();

        return view('pages.peminjaman.index', $data);
    }

    public function detail($id)
    {
        $data['detail'] = DB::table('detail_peminjaman')
            ->join('peminjaman', 'detail_peminjaman.id_peminjaman', '=', 'peminjaman.id')
            ->join('books', 'detail_peminjaman.isbn_buku', '=', 'books.isbn_buku')
            ->where('peminjaman.id', $id)
            ->select('detail_peminjaman.*',  'peminjaman.*', 'books.*')
            ->get();

        return view('pages.peminjaman.detail', $data);
    }

    public function create()
    {
        $data['anggota'] = DB::table('anggotas')->get();
        $data['buku'] = DB::table('books')->get();
        return view('pages.peminjaman.create', $data);
    }
}
