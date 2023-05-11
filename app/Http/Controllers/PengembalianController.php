<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PengembalianController extends Controller
{
    public function index()
    {
        // $data['pengembalian'] = DB::table('pengembalians')
        //     ->join('anggotas', 'pengembalians.id_anggota', '=', 'anggotas.id')
        //     ->join('detail_peminjaman', 'pengembalians.id_buku', '=', 'detail_peminjaman.id')
        //     ->select('pengembalians.*', 'anggotas.*', 'detail_peminjaman.*')
        //     ->get();

        $data['pengembalian'] = DB::table('pengembalians')
            ->join('anggotas', 'pengembalians.id_anggota', '=', 'anggotas.id')
            ->join('books', 'pengembalians.id_buku', '=', 'books.id')
            ->select('pengembalians.*', 'anggotas.*', 'books.*')
            ->get();

        return view('pages.pengembalian.index', $data);
    }

    public function tambah()
    {
        $anggota = Anggota::all();
        // $buku = DB::table('books')
        //     ->join('detail_peminjaman', 'books.no_isbn', '=', 'detail_peminjaman.isbn_buku')
        //     ->where('detail_peminjaman.status', 0)
        //     ->get();

        $buku = DB::table('books')->get();

        return view('pages.pengembalian.create', compact('anggota', 'buku'));
    }

    public function store(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'id_anggota' => 'required',
            'id' => 'required',
            'jumlah' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('tambah-pengembalian')
                ->withErrors($validator)
                ->withInput();
        }

        $simpan = DB::table('pengembalians')->insert([
            'id_anggota' => $r->id_anggota,
            'id_buku' => $r->id,
            'qty' => $r->jumlah,
            'denda' => $r->denda,
            // 'tanggal_pengembalian' => date('Y-m-d H:i:s'),
            'tanggal_pengembalian' => now(),
        ]);

        // $updateStatus = DB::table('detail_peminjaman')->where('isbn_buku', $r->isbn)->where('id', $r->id)->update([
        //     'status' => 1,
        // ]);

        $stok = DB::table('books')->where('id', $r->id)->update([
            "jumlah_buku" => DB::raw('jumlah_buku + ' . $r->jumlah),
        ]);

        if ($simpan == true) {
            return redirect(route('pengembalian'))->with('success', 'Succsess');
        } else {
            return redirect(route('pengembalian'))->with('error', 'Gagal');
        }
    }
}
