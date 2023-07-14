<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        // $data['peminjaman'] = DB::table('peminjaman')
        //     ->join('anggotas', 'peminjaman.id_anggota_peminjaman', '=', 'anggotas.id')
        //     ->join('detail_peminjaman', 'detail_peminjaman.id_peminjaman', '=', 'peminjaman_id')
        //     ->join('books', 'books.id', '=', 'detail_peminjaman.id_buku_pinjam')
        //     ->where('detail_peminjaman.status', <> 2)
        //     ->select('peminjaman.*', 'anggotas.nama')
        //     ->get();

        $data['peminjaman'] = DB::table('peminjaman')
            ->join('anggotas', 'peminjaman.id_anggota_peminjaman', '=', 'anggotas.id')
            ->join('detail_peminjaman', 'detail_peminjaman.id_peminjaman', '=', 'peminjaman.id')
            ->join('books', 'books.id', '=', 'detail_peminjaman.id_buku_pinjam')
            ->where('detail_peminjaman.status', '<>', 2)
            ->select('peminjaman.*', 'anggotas.nama')
            ->get();


        return view('pages.peminjaman.index', $data);
    }



    public function detail($id)
    {
        $data['detail'] = DB::table('detail_peminjaman')
            ->join('peminjaman', 'detail_peminjaman.id_peminjaman', '=', 'peminjaman.id')
            ->join('anggotas', 'peminjaman.id_anggota_peminjaman', '=', 'anggotas.id')
            ->join('books', 'detail_peminjaman.isbn_buku', '=', 'books.no_isbn')
            ->where('peminjaman.id', $id)
            ->select('detail_peminjaman.*', 'detail_peminjaman.jumlah_buku as jumlah_buku_pinjam', 'peminjaman.*', 'books.*', 'anggotas.nama as nama_anggota')
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
        $count = DB::table('peminjaman')
            ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
            ->where('id_anggota_peminjaman', $request->id_anggota_peminjaman)
            ->where('detail_peminjaman.status', 0)
            ->count();
        // dd($count);

        if ($count >= 10) {
            flash()->addError('User telah mencapai limit untuk meminjam buku');
            // Alert::warning('Gagal', 'User telah mencapai limit untuk meminjam buku');
            $hapus = DB::table('peminjaman_temp')->delete();
            return redirect(route('peminjaman.create'));
        }

        $simpan = DB::table('peminjaman')->insertGetId([
            'kode_peminjaman' => date('YmdHis') . rand(0, 999),
            'tgl_pinjam' => Carbon::now()->toDateString(),
            'tgl_kembali' => Carbon::now()->addMonth(3)->toDateString(),
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
                    'status' => 0,
                    'id_buku_pinjam' => $buku->id,
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
        $temp = DB::table('detail_peminjaman')->where('id_peminjaman', $id)->get();

        foreach ($temp as $t) {
            $UpdateStockBuku = DB::table('books')->where('id', $t->id_buku_pinjam)->update([
                "jumlah_buku" => DB::raw('jumlah_buku + ' . $t->jumlah_buku),
            ]);
        }
        // $temp = DB::table('detail_peminjaman')->where('id_peminjaman', $id)->first();
        //mengambil jumlah buku yang dipinjam untuk di update ke stock buku
        // $ambilJumlahStockBuku = DB::table('detail_peminjaman')->where('id_buku_pinjam', $temp->id_buku_pinjam)->sum('jumlah_buku');
        // $stockBuku = DB::table('books')->where('id', $temp->id_buku_pinjam)->update([
        //     // "jumlah_buku" => DB::raw('jumlah_buku + ' . $temp->jumlah_buku),
        //     "jumlah_buku" => DB::raw('jumlah_buku + ' . $ambilJumlahStockBuku),
        // ]);

        $hapus = DB::table('peminjaman')->where('id', $id)->delete();
        $hapusDetailPeminjaman = DB::table('detail_peminjaman')->where('id_peminjaman', $id)->delete();

        if ($hapus && $hapusDetailPeminjaman == true) {
            return redirect()->back()->with(['success', 'Data Berhasil Di Hapus']);
        } else {
            return redirect()->back()->with(['error', 'Gagal']);
        }
    }


    public function cetakBuktiPeminjaman($id)
    {
        $data['peminjaman'] = DB::table('peminjaman')
            ->join('anggotas', 'peminjaman.id_anggota_peminjaman', '=', 'anggotas.id')
            ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
            // ->join('pengembalians', 'peminjaman.id_anggota_peminjaman', '=', 'pengembalians.id_anggota')
            ->select('peminjaman.*', 'detail_peminjaman.*', 'anggotas.nama', 'anggotas.nisn')
            // ->where('pengembalians.id_anggota', '=', 'anggotas.id')
            ->where('peminjaman.id', $id)
            ->get();
        // dd($data);

        $data['title'] = 'Kartu / Bukti Peminjaman Buku';
        return view('pages.peminjaman.bukti_peminjaman', $data);
    }

    public function permintaanPeminjaman()
    {
        $data['peminjaman'] = DB::table('peminjaman')
            ->join('anggotas', 'peminjaman.id_anggota_peminjaman', '=', 'anggotas.id')
            ->join('detail_peminjaman', 'detail_peminjaman.id_peminjaman', '=', 'peminjaman.id')
            ->join('books', 'books.id', '=', 'detail_peminjaman.id_buku_pinjam')
            ->where('detail_peminjaman.status', 2)
            ->select('peminjaman.*', 'anggotas.nama', 'anggotas.kelas', 'books.*', 'detail_peminjaman.id_peminjaman')
            ->get();
        // dd($data);

        return view('pages.permintaanPeminjaman.index', $data);
    }

    public function terimaPermintaanPeminjaman(Request $request)
    {
        $ids = $request->input('ids');

        if (is_array($ids)) {
            DB::table('detail_peminjaman')
                ->whereIn('id_peminjaman', $ids)
                ->update(['status' => 0]);

            flash('Peminjaman Berhasil Di Accept');
        }
        return response()->json(['success' => true]);
    }
}
