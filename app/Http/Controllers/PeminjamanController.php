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
            ->join('books', 'detail_peminjaman.isbn_buku', '=', 'books.no_isbn')
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


    public function storeTemp(Request $r)
    {

        $simpan = DB::table('peminjaman_temp')->insert([
            'isbn' => $r->isbn,
            'judul' => $r->judul,
            'jumlah' => $r->jumlah,
        ]);
        if ($simpan == true) {
            return response()->json(['success' => 200]);
        } else {
            return response()->json(['error' => 401]);
        }
    }

    public function showTemp()
    {
        $data['tmp'] = DB::table('peminjaman_temp')->get();
        return view('pages.peminjaman.showTempPeminjaman', $data);
    }

    public function deleteAllTemp()
    {
        $hapus = DB::table('peminjaman_temp')->delete();
        if ($hapus == true) {
            return response()->json(['success' => 200]);
        } else {
            return response()->json(['error' => 401]);
        }
    }

    public function deleteItemTemp($id)
    {
        $hapus = DB::table('peminjaman_temp')->where('id', $id)->delete();
        if ($hapus == true) {
            return response()->json(['success' => 200]);
        } else {
            return response()->json(['error' => 401]);
        }
    }

    public function store(Request $request)
    {
        $simpan = DB::table('peminjaman')->insertGetId([
            'kode_peminjaman' => date('YmdHis') . rand(0, 999),
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
            'id_anggota_peminjaman' => $request->id_anggota_peminjaman,
        ]);

        $id = DB::getPdo()->lastInsertId();

        if ($simpan == true) {
            $temp = DB::table('peminjaman_temp')->get();
            foreach ($temp as $t) {
                $buku = DB::table('books')->where('no_isbn', $t->isbn)->first();
                if ($t->jumlah > $buku->jumlah_buku) {
                    flash()->addError('Stock Buku tidak mencukupi.');
                    $hapus = DB::table('peminjaman_temp')->delete();
                    $delete = DB::table('peminjaman')->where('id', $id)->delete();
                    return redirect()->route('peminjaman.create');
                }

                $simpan = DB::table('detail_peminjaman')->insert([
                    'id_peminjaman' => $id,
                    'isbn_buku' => $t->isbn,
                    'judul_buku' => $t->judul,
                    'jumlah_buku' => $t->jumlah,
                ]);

                $stockBuku = DB::table('books')->where('no_isbn', $t->isbn)->update([
                    "jumlah_buku" => DB::raw('jumlah_buku - ' . $t->jumlah),
                ]);
            }
            $hapus = DB::table('peminjaman_temp')->delete();
            return redirect(route('peminjaman'))->with('success', 'Succsess');
        } else {
            return redirect(route('peminjaman'))->with('error', 'Gagal');
        }
    }

    public function destroy($id)
    {


        $temp = DB::table('detail_peminjaman')->where('id_peminjaman', $id)->first();
        $ambilJumlahStockBuku = DB::table('detail_peminjaman')->where('id_peminjaman', $id)->sum('jumlah_buku');
        $stockBuku = DB::table('books')->where('no_isbn', $temp->isbn_buku)->update([
            "jumlah_buku" => DB::raw('jumlah_buku + ' . $ambilJumlahStockBuku),
        ]);

        $hapus = DB::table('peminjaman')->where('id', $id)->delete();
        $hapusDetailPeminjaman = DB::table('detail_peminjaman')->where('id_peminjaman', $id)->delete();

        if ($hapus) {
            return redirect()->back()->with(['success', 'Dat Berhasil Di Hapus']);
        } else {
            return redirect()->back()->with(['error', 'Gagal']);
        }
    }
}
