<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Book;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DaftarBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $buku = Book::with('kategoriBuku')->where('judul_buku', 'like', '%' . $request->search . '%')->paginate(6);
        } else {
            $buku = Book::with('kategoriBuku')->paginate(6);
        }
        
        return view('pages.daftarbuku.index', compact('buku'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $anggota = Anggota::where('user_id', $userId)->first();

        if (!$anggota) {
            flash()->addError('Anda belum terdaftar sebagai anggota.');
            return redirect(route('daftarbuku.index'));
        }

        $idBukuDipinjam = $request->input('id_buku_pinjam');

        // Pengecekan jumlah maksimal peminjaman (maksimal 3 buku)
        $countPeminjaman = DB::table('peminjaman')
            ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
            ->where('id_anggota_peminjaman', $anggota->id)
            ->where(function ($query) {
                $query->where('detail_peminjaman.status', 0)
                    ->orWhere('detail_peminjaman.status', 2);
            })
            ->count();

        if ($countPeminjaman >= 3) {
            flash()->addError('Anda sudah mencapai batas maksimal peminjaman (3 buku).');
            return redirect(route('daftarbuku.index'));
        }

        // Pengecekan apakah anggota sedang meminjam buku yang belum dikembalikan
        $isMeminjam = DB::table('peminjaman')
            ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
            ->where('id_anggota_peminjaman', $anggota->id)
            ->where(function ($query) {
                $query->where('detail_peminjaman.status', 0)
                    ->orWhere('detail_peminjaman.status', 2);
            })
            ->whereIn('detail_peminjaman.id_buku_pinjam', $idBukuDipinjam)
            ->exists();

        if ($isMeminjam) {
            flash()->addError('Anda telah meminjam buku yang belum dikembalikan. Silakan kembalikan buku sebelum meminjam lagi.');
            return redirect(route('daftarbuku.index'));
        }

        $today = Carbon::now()->toDateString();

        $peminjamanHariIni = Peminjaman::where('id_anggota_peminjaman', $anggota->id)
            ->whereDate('tgl_pinjam', $today)
            ->first();

        if (!$peminjamanHariIni) {
            $simpanPeminjaman = DB::table('peminjaman')->insertGetId([
                'kode_peminjaman' => date('YmdHis') . rand(0, 999),
                'tgl_pinjam' => Carbon::now()->toDateString(),
                'tgl_kembali' => Carbon::now()->addMonth(3)->toDateString(),
                'id_anggota_peminjaman' => $anggota->id,
            ]);

            $id = DB::getPdo()->lastInsertId();

            foreach ($request->input('id_buku_pinjam') as $key => $id_buku) {
                $simpanDetailPeminjaman = DB::table('detail_peminjaman')->insert([
                    'id_peminjaman' => $id,
                    'isbn_buku' => $request->input('isbn_buku')[$key],
                    'judul_buku' => $request->input('judul_buku')[$key],
                    'jumlah_buku' => 1,
                    'status' => 2,
                    'id_buku_pinjam' => $id_buku,
                ]);
            }

            $stockBuku = DB::table('books')
                ->whereIn('no_isbn', $request->input('isbn_buku'))
                ->decrement('jumlah_buku', 1);

            return redirect(route('daftarbuku.index'))->with('success', "Buku berhasil dipinjam");
        } else {
            $idPeminjaman = $peminjamanHariIni->id;
            foreach ($request->input('id_buku_pinjam') as $key => $id_buku) {
                $simpanDetailPeminjaman = DB::table('detail_peminjaman')->insert([
                    'id_peminjaman' => $idPeminjaman,
                    'isbn_buku' => $request->input('isbn_buku')[$key],
                    'judul_buku' => $request->input('judul_buku')[$key],
                    'jumlah_buku' => 1,
                    'status' => 2,
                    'id_buku_pinjam' => $id_buku,
                ]);
            }

            $stockBuku = DB::table('books')
                ->whereIn('no_isbn', $request->input('isbn_buku'))
                ->decrement('jumlah_buku', 1);

            return redirect(route('daftarbuku.index'))->with('success', "Buku berhasil dipinjam");
        }
    }

    // Metode lain seperti show, edit, update, dan destroy bisa ditambahkan sesuai kebutuhan
}
