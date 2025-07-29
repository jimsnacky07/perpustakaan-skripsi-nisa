<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GrafikController extends Controller
{
    public function index()
    {
        return view('pages.grafik.index');
    }

    public function viewGrafikPinjam(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $query = \DB::select(\DB::raw("
        SELECT books.judul_buku , COUNT(detail_peminjaman.id_buku_pinjam) AS jumlah_buku
        FROM detail_peminjaman
        JOIN peminjaman ON peminjaman.id = detail_peminjaman.id_peminjaman
        JOIN books ON detail_peminjaman.id_buku_pinjam = books.id
        WHERE EXTRACT(MONTH FROM peminjaman.tgl_pinjam ) = :bulan
        AND EXTRACT(YEAR FROM peminjaman.tgl_pinjam ) = :tahun
        GROUP BY books.judul_buku
        ORDER BY books.judul_buku ASC
            "), ['bulan' => $bulan, 'tahun' => $tahun]);

        $data = [
            'grafik' => $query,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];

        return response()->json([
            'data' => view('pages.grafik.viewgrafik', $data)->render()
        ]);
    }
}
