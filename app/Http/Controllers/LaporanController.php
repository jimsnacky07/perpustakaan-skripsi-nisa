<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BukuRusak;
use App\Models\BukuHilang;
use App\Models\JenisBuku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Anggota;
use App\Models\Faktur; // Added Faktur model
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LaporanController extends Controller
{
    public function bukuMasuk(Request $request)
    {
        $request->validate([
            'start' => 'nullable|date',
            'end' => 'nullable|date|after_or_equal:start',
            'kategori' => 'nullable|exists:jenis_bukus,id',
            'penerbit' => 'nullable|string',
        ]);

        $books = Book::with(['kategoriBuku', 'rakBuku']);

        if ($request->filled('start') && $request->filled('end')) {
            $books->whereBetween('created_at', [$request->start, $request->end]);
        }

        if ($request->filled('kategori')) {
            $books->where('jenis_buku_id', $request->kategori);
        }

        if ($request->filled('penerbit')) {
            $books->where('penerbit_buku', 'like', '%' . $request->penerbit . '%');
        }

        $books = $books->paginate(10);
        $kategori = JenisBuku::all();

        return view('pages.laporan.buku_masuk', compact('books', 'kategori'));
    }

    public function bukuRusak(Request $request)
    {
        $request->validate([
            'start' => 'nullable|date',
            'end' => 'nullable|date|after_or_equal:start',
            'penyebab' => 'nullable|string',
        ]);

        $bukuRusak = BukuRusak::with('book');

        if ($request->filled('start') && $request->filled('end')) {
            $bukuRusak->whereBetween('created_at', [$request->start, $request->end]);
        }

        if ($request->filled('penyebab')) {
            $bukuRusak->where('penyebab', 'like', '%' . $request->penyebab . '%');
        }

        $bukuRusak = $bukuRusak->paginate(10);
        return view('pages.laporan.buku_rusak', compact('bukuRusak'));
    }

    public function bukuHilang(Request $request)
    {
        $request->validate([
            'start' => 'nullable|date',
            'end' => 'nullable|date|after_or_equal:start',
            'keterangan' => 'nullable|string',
        ]);

        $bukuHilang = BukuHilang::with('book');

        if ($request->filled('start') && $request->filled('end')) {
            $bukuHilang->whereBetween('created_at', [$request->start, $request->end]);
        }

        if ($request->filled('keterangan')) {
            $bukuHilang->where('keterangan', 'like', '%' . $request->keterangan . '%');
        }

        $bukuHilang = $bukuHilang->paginate(10);
        return view('pages.laporan.buku_hilang', compact('bukuHilang'));
    }

    public function kategoriBuku()
    {
        $kategoriBuku = JenisBuku::withCount('books')->with('books')->get();
        $title = 'Laporan Kategori Buku';
        return view('pages.laporan.kategoriBuku', compact('kategoriBuku', 'title'));
    }

    public function anggota(Request $request)
    {
        $request->validate([
            'kelas' => 'nullable|string',
            'jk' => 'nullable|in:L,P',
        ]);

        $anggota = Anggota::with('user');

        if ($request->filled('kelas')) {
            $anggota->where('kelas', $request->kelas);
        }

        if ($request->filled('jk')) {
            $anggota->where('jk', $request->jk);
        }

        $anggota = $anggota->get();
        $title = 'Laporan Anggota';
        return view('pages.laporan.anggota', compact('anggota', 'title'));
    }

    public function buku(Request $request)
    {
        $request->validate([
            'kategori' => 'nullable|exists:jenis_bukus,id',
            'rak' => 'nullable|exists:rak_bukus,id',
            'tahun' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
        ]);

        $buku = Book::with(['kategoriBuku', 'rakBuku']);

        if ($request->filled('kategori')) {
            $buku->where('jenis_buku_id', $request->kategori);
        }

        if ($request->filled('rak')) {
            $buku->where('rak_buku_id', $request->rak);
        }

        if ($request->filled('tahun')) {
            $buku->where('tahun_terbit', $request->tahun);
        }

        $buku = $buku->get();
        $title = 'Laporan Buku';
        $kategori = JenisBuku::all();
        $rak = \App\Models\RakBuku::all();

        return view('pages.laporan.buku', compact('buku', 'title', 'kategori', 'rak'));
    }

    public function rakBuku()
    {
        $rak = \App\Models\RakBuku::withCount('books')->with('books')->get();
        $title = 'Laporan Rak Buku';
        return view('pages.laporan.rak', compact('rak', 'title'));
    }

    public function riwayatPeminjaman(Request $request)
    {
        $request->validate([
            'start' => 'nullable|date',
            'end' => 'nullable|date|after_or_equal:start',
            'anggota' => 'nullable|exists:anggotas,id',
            'status' => 'nullable|in:0,1,2', // 0=dipinjam, 1=dikembalikan, 2=menunggu
        ]);

        $riwayatPeminjamanBuku = Peminjaman::with(['anggota', 'detailPeminjaman.book']);

        if ($request->filled('start') && $request->filled('end')) {
            $riwayatPeminjamanBuku->whereBetween('tgl_pinjam', [$request->start, $request->end]);
        }

        if ($request->filled('anggota')) {
            $riwayatPeminjamanBuku->where('id_anggota_peminjaman', $request->anggota);
        }

        $riwayatPeminjamanBuku = $riwayatPeminjamanBuku->get()->map(function ($item) {
            $judul_buku = '-';
            $jumlah_buku = 0;
            if ($item->detailPeminjaman && $item->detailPeminjaman->count() > 0) {
                $judul_buku = $item->detailPeminjaman->pluck('judul_buku')->implode(', ');
                $jumlah_buku = $item->detailPeminjaman->sum('jumlah_buku');
            }
            return [
                'nama' => $item->anggota ? $item->anggota->nama : '-',
                'judul_buku' => $judul_buku,
                'jumlah_buku' => $jumlah_buku,
                'tgl_pinjam' => $item->tgl_pinjam,
                'tgl_kembali' => $item->tgl_kembali,
                'status' => $item->detailPeminjaman->first() ? $item->detailPeminjaman->first()->status : 0,
            ];
        });

        if ($request->filled('status')) {
            $riwayatPeminjamanBuku = $riwayatPeminjamanBuku->filter(function ($item) use ($request) {
                return $item['status'] == $request->status;
            });
        }

        $title = 'Laporan Riwayat Peminjaman';
        $anggota = Anggota::all();
        return view('pages.laporan.riwayatPeminjaman', compact('riwayatPeminjamanBuku', 'title', 'anggota'));
    }

    public function denda(Request $request)
    {
        $request->validate([
            'start' => 'nullable|date',
            'end' => 'nullable|date|after_or_equal:start',
            'anggota' => 'nullable|exists:anggotas,id',
            'min_denda' => 'nullable|numeric|min:0',
            'max_denda' => 'nullable|numeric|min:0',
        ]);

        $denda = Pengembalian::with(['anggota', 'book']);

        // Filter tanggal
        if ($request->filled('start') && $request->filled('end')) {
            $denda->whereBetween('tanggal_pengembalian', [$request->start, $request->end]);
        }

        // Filter anggota
        if ($request->filled('anggota')) {
            $denda->where('id_anggota', $request->anggota);
        }

        // Filter range denda
        if ($request->filled('min_denda')) {
            $denda->where('denda', '>=', $request->min_denda);
        }

        if ($request->filled('max_denda')) {
            $denda->where('denda', '<=', $request->max_denda);
        }

        $denda = $denda->where('denda', '>', 0)->get();

        // Hitung statistik
        $statistik = [
            'total_denda' => $denda->sum('denda'),
            'total_transaksi' => $denda->count(),
            'rata_rata_denda' => $denda->avg('denda'),
            'denda_tertinggi' => $denda->max('denda'),
            'denda_terendah' => $denda->min('denda'),
            'total_hari_terlambat' => $denda->sum('jumlah_hari_terlambat'),
            'rata_hari_terlambat' => $denda->avg('jumlah_hari_terlambat'),
        ];

        // Top 5 anggota dengan denda tertinggi
        $topAnggota = $denda->groupBy('id_anggota')
            ->map(function ($group) {
                return [
                    'nama' => $group->first()->anggota->nama ?? 'Unknown',
                    'total_denda' => $group->sum('denda'),
                    'jumlah_transaksi' => $group->count(),
                ];
            })
            ->sortByDesc('total_denda')
            ->take(5);

        $title = 'Laporan Denda';
        $anggota = Anggota::all();

        return view('pages.laporan.denda', compact('denda', 'title', 'statistik', 'topAnggota', 'anggota'));
    }

    public function statistik(Request $request)
    {
        $request->validate([
            'periode' => 'nullable|in:hari,minggu,bulan,tahun',
        ]);

        $periode = $request->get('periode', 'bulan');

        // Statistik peminjaman
        $peminjamanStats = $this->getPeminjamanStats($periode);

        // Statistik pengembalian
        $pengembalianStats = $this->getPengembalianStats($periode);

        // Statistik denda
        $dendaStats = $this->getDendaStats($periode);

        // Statistik buku
        $bukuStats = $this->getBukuStats();

        return view('pages.laporan.statistik', compact(
            'peminjamanStats',
            'pengembalianStats',
            'dendaStats',
            'bukuStats',
            'periode'
        ));
    }

    private function getPeminjamanStats($periode)
    {
        $query = Peminjaman::query();

        switch ($periode) {
            case 'hari':
                $query->where('created_at', '>=', Carbon::now()->subDays(7));
                break;
            case 'minggu':
                $query->where('created_at', '>=', Carbon::now()->subWeeks(4));
                break;
            case 'bulan':
                $query->where('created_at', '>=', Carbon::now()->subMonths(6));
                break;
            case 'tahun':
                $query->where('created_at', '>=', Carbon::now()->subYear());
                break;
        }

        return [
            'total' => $query->count(),
            'hari_ini' => Peminjaman::whereDate('created_at', Carbon::today())->count(),
            'minggu_ini' => Peminjaman::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count(),
            'bulan_ini' => Peminjaman::whereMonth('created_at', Carbon::now()->month)->count(),
        ];
    }

    private function getPengembalianStats($periode)
    {
        $query = Pengembalian::query();

        switch ($periode) {
            case 'hari':
                $query->where('created_at', '>=', Carbon::now()->subDays(7));
                break;
            case 'minggu':
                $query->where('created_at', '>=', Carbon::now()->subWeeks(4));
                break;
            case 'bulan':
                $query->where('created_at', '>=', Carbon::now()->subMonths(6));
                break;
            case 'tahun':
                $query->where('created_at', '>=', Carbon::now()->subYear());
                break;
        }

        return [
            'total' => $query->count(),
            'denda_total' => $query->sum('denda'),
            'denda_belum_lunas' => $query->where('denda', '>', 0)->sum('denda'),
            'denda_sudah_lunas' => 0, // Karena tidak ada kolom status_pembayaran
        ];
    }

    private function getDendaStats($periode)
    {
        $query = Pengembalian::where('denda', '>', 0);

        switch ($periode) {
            case 'hari':
                $query->where('created_at', '>=', Carbon::now()->subDays(7));
                break;
            case 'minggu':
                $query->where('created_at', '>=', Carbon::now()->subWeeks(4));
                break;
            case 'bulan':
                $query->where('created_at', '>=', Carbon::now()->subMonths(6));
                break;
            case 'tahun':
                $query->where('created_at', '>=', Carbon::now()->subYear());
                break;
        }

        return [
            'total_denda' => $query->sum('denda'),
            'belum_lunas' => $query->sum('denda'), // Semua denda dianggap belum lunas
            'sudah_lunas' => 0, // Karena tidak ada kolom status_pembayaran
            'rata_rata_denda' => $query->avg('denda'),
        ];
    }

    private function getBukuStats()
    {
        return [
            'total_buku' => Book::count(),
            'total_stok' => Book::sum('jumlah_buku'),
            'buku_terpopuler' => DB::table('detail_peminjaman')
                ->join('books', 'detail_peminjaman.id_buku_pinjam', '=', 'books.id')
                ->select('books.judul_buku', DB::raw('COUNT(*) as total_peminjaman'))
                ->groupBy('books.id', 'books.judul_buku')
                ->orderBy('total_peminjaman', 'desc')
                ->limit(5)
                ->get(),
            'kategori_terpopuler' => DB::table('detail_peminjaman')
                ->join('books', 'detail_peminjaman.id_buku_pinjam', '=', 'books.id')
                ->join('jenis_bukus', 'books.jenis_buku_id', '=', 'jenis_bukus.id')
                ->select('jenis_bukus.name', DB::raw('COUNT(*) as total_peminjaman'))
                ->groupBy('jenis_bukus.id', 'jenis_bukus.name')
                ->orderBy('total_peminjaman', 'desc')
                ->limit(5)
                ->get(),
        ];
    }

    // Export laporan ke PDF
    public function exportPdf(Request $request, $type)
    {
        $data = $this->getLaporanData($request, $type);

        // Untuk sementara return view, bisa ditambahkan package PDF nanti
        return view("pages.laporan.export.{$type}", compact('data'));
    }

    // Export laporan ke Excel
    public function exportExcel(Request $request, $type)
    {
        $data = $this->getLaporanData($request, $type);

        // Untuk sementara return view, bisa ditambahkan package Excel nanti
        return view("pages.laporan.export.{$type}", compact('data'));
    }

    private function getLaporanData($request, $type)
    {
        switch ($type) {
            case 'buku':
                return Book::with(['kategoriBuku', 'rakBuku'])->get();
            case 'peminjaman':
                return Peminjaman::with(['anggota', 'detailPeminjaman.book'])->get();
            case 'denda':
                return Pengembalian::with(['anggota', 'book'])->where('denda', '>', 0)->get();
            case 'anggota':
                return Anggota::with('user')->get();
            default:
                return collect();
        }
    }

    // Method untuk laporan peminjaman buku
    public function laporanPeminjamanBuku(Request $request)
    {
        $request->validate([
            'tglAwal' => 'nullable|date',
            'tglAkhir' => 'nullable|date|after_or_equal:tglAwal',
            'anggota_id' => 'nullable|exists:anggotas,id',
        ]);

        $peminjaman = Peminjaman::with(['anggota', 'detailPeminjaman.book']);

        if ($request->filled('tglAwal') && $request->filled('tglAkhir')) {
            $peminjaman->whereBetween('tgl_pinjam', [$request->tglAwal, $request->tglAkhir]);
        }

        if ($request->filled('anggota_id')) {
            $peminjaman->where('id_anggota_peminjaman', $request->anggota_id);
        }

        $peminjaman = $peminjaman->get();
        $title = 'Laporan Peminjaman Buku';
        $anggota = Anggota::all();

        return view('pages.laporan.peminjaman-buku', compact('peminjaman', 'title', 'anggota'));
    }

    // Method untuk laporan pengembalian buku
    public function laporanPengembalianBuku(Request $request)
    {
        $request->validate([
            'tglAwal' => 'nullable|date',
            'tglAkhir' => 'nullable|date|after_or_equal:tglAwal',
            'anggota_id' => 'nullable|exists:anggotas,id',
        ]);

        $pengembalian = Pengembalian::with(['anggota', 'book']);

        if ($request->filled('tglAwal') && $request->filled('tglAkhir')) {
            $pengembalian->whereBetween('tanggal_pengembalian', [$request->tglAwal, $request->tglAkhir]);
        }

        if ($request->filled('anggota_id')) {
            $pengembalian->where('id_anggota', $request->anggota_id);
        }

        $pengembalian = $pengembalian->get();
        $title = 'Laporan Pengembalian Buku';
        $anggota = Anggota::all();

        return view('pages.laporan.pengembalian-buku', compact('pengembalian', 'title', 'anggota'));
    }

    // Method untuk laporan buku hilang
    public function laporanbukuhilang(Request $request)
    {
        $request->validate([
            'start' => 'nullable|date',
            'end' => 'nullable|date|after_or_equal:start',
            'keterangan' => 'nullable|string',
        ]);

        $bukuHilang = BukuHilang::with('book');

        if ($request->filled('start') && $request->filled('end')) {
            $bukuHilang->whereBetween('created_at', [$request->start, $request->end]);
        }

        if ($request->filled('keterangan')) {
            $bukuHilang->where('keterangan', 'like', '%' . $request->keterangan . '%');
        }

        $bukuHilang = $bukuHilang->get();
        $title = 'Laporan Buku Hilang';

        return view('pages.laporan.buku_hilang', compact('bukuHilang', 'title'));
    }

    // Method untuk generate faktur dari laporan
    public function generateFakturPeminjaman(Request $request)
    {
        try {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $anggotaId = $request->input('anggota_id');

            $query = Peminjaman::with(['anggota', 'detailPeminjaman.book']);

            if ($startDate && $endDate) {
                $query->whereBetween('tgl_pinjam', [$startDate, $endDate]);
            }

            if ($anggotaId) {
                $query->where('id_anggota_peminjaman', $anggotaId);
            }

            $peminjamans = $query->get();

            if ($peminjamans->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada data peminjaman untuk periode yang dipilih!');
            }

            // Generate faktur untuk setiap peminjaman
            foreach ($peminjamans as $peminjaman) {
                // Cek apakah faktur sudah ada
                $existingFaktur = Faktur::where('jenis_faktur', 'peminjaman')
                    ->where('id_transaksi', $peminjaman->id)
                    ->first();

                if (!$existingFaktur) {
                    // Generate detail items
                    $detailItems = [];
                    foreach ($peminjaman->detailPeminjaman as $detail) {
                        $detailItems[] = [
                            'judul_buku' => $detail->book->judul_buku,
                            'jumlah' => $detail->jumlah,
                            'tanggal_pinjam' => $peminjaman->tgl_pinjam,
                            'tanggal_kembali' => $peminjaman->tgl_kembali
                        ];
                    }

                    Faktur::create([
                        'nomor_faktur' => Faktur::generateNomorFaktur('peminjaman'),
                        'jenis_faktur' => 'peminjaman',
                        'id_transaksi' => $peminjaman->id,
                        'id_anggota' => $peminjaman->id_anggota_peminjaman,
                        'detail_items' => $detailItems,
                        'total_amount' => 0,
                        'status' => 'dibayar',
                        'tanggal_faktur' => now(),
                        'tanggal_jatuh_tempo' => $peminjaman->tgl_kembali,
                        'keterangan' => 'Faktur Peminjaman Buku'
                    ]);
                }
            }

            return redirect()->route('faktur.index')->with('success', 'Faktur peminjaman berhasil dibuat!');
        } catch (\Exception $e) {
            Log::error('Gagal membuat faktur peminjaman', [
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Gagal membuat faktur peminjaman!');
        }
    }

    public function generateFakturPengembalian(Request $request)
    {
        try {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $anggotaId = $request->input('anggota_id');

            $query = Pengembalian::with(['anggota', 'book']);

            if ($startDate && $endDate) {
                $query->whereBetween('tanggal_pengembalian', [$startDate, $endDate]);
            }

            if ($anggotaId) {
                $query->where('id_anggota', $anggotaId);
            }

            $pengembalians = $query->get();

            if ($pengembalians->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada data pengembalian untuk periode yang dipilih!');
            }

            // Generate faktur untuk setiap pengembalian
            foreach ($pengembalians as $pengembalian) {
                // Cek apakah faktur sudah ada
                $existingFaktur = Faktur::where('jenis_faktur', 'pengembalian')
                    ->where('id_transaksi', $pengembalian->id)
                    ->first();

                if (!$existingFaktur) {
                    // Generate detail items
                    $detailItems = [
                        [
                            'judul_buku' => $pengembalian->book->judul_buku,
                            'tanggal_kembali' => $pengembalian->tanggal_pengembalian,
                            'jumlah_hari_terlambat' => $pengembalian->jumlah_hari_terlambat,
                            'denda_per_hari' => 1000,
                            'total_denda' => $pengembalian->denda
                        ]
                    ];

                    Faktur::create([
                        'nomor_faktur' => Faktur::generateNomorFaktur('pengembalian'),
                        'jenis_faktur' => 'pengembalian',
                        'id_transaksi' => $pengembalian->id,
                        'id_anggota' => $pengembalian->id_anggota,
                        'detail_items' => $detailItems,
                        'total_amount' => $pengembalian->denda,
                        'status' => $pengembalian->denda > 0 ? 'belum_dibayar' : 'dibayar',
                        'tanggal_faktur' => now(),
                        'keterangan' => 'Faktur Pengembalian Buku'
                    ]);
                }
            }

            return redirect()->route('faktur.index')->with('success', 'Faktur pengembalian berhasil dibuat!');
        } catch (\Exception $e) {
            Log::error('Gagal membuat faktur pengembalian', [
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Gagal membuat faktur pengembalian!');
        }
    }

    public function generateFakturDenda(Request $request)
    {
        try {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $anggotaId = $request->input('anggota_id');

            $query = Pengembalian::with(['anggota', 'book'])
                ->where('denda', '>', 0);

            if ($startDate && $endDate) {
                $query->whereBetween('tanggal_pengembalian', [$startDate, $endDate]);
            }

            if ($anggotaId) {
                $query->where('id_anggota', $anggotaId);
            }

            $dendaBelumDibayar = $query->get();

            if ($dendaBelumDibayar->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada data denda untuk periode yang dipilih!');
            }

            // Group by anggota
            $dendaByAnggota = $dendaBelumDibayar->groupBy('id_anggota');

            foreach ($dendaByAnggota as $anggotaId => $pengembalians) {
                // Cek apakah faktur denda sudah ada untuk anggota ini
                $existingFaktur = Faktur::where('jenis_faktur', 'denda')
                    ->where('id_anggota', $anggotaId)
                    ->whereDate('tanggal_faktur', today())
                    ->first();

                if (!$existingFaktur) {
                    // Generate detail items
                    $detailItems = [];
                    $totalDenda = 0;
                    
                    foreach ($pengembalians as $pengembalian) {
                        $detailItems[] = [
                            'judul_buku' => $pengembalian->book->judul_buku,
                            'tanggal_pengembalian' => $pengembalian->tanggal_pengembalian,
                            'jumlah_hari_terlambat' => $pengembalian->jumlah_hari_terlambat,
                            'denda_per_hari' => 1000,
                            'total_denda' => $pengembalian->denda
                        ];
                        $totalDenda += $pengembalian->denda;
                    }

                    Faktur::create([
                        'nomor_faktur' => Faktur::generateNomorFaktur('denda'),
                        'jenis_faktur' => 'denda',
                        'id_transaksi' => null,
                        'id_anggota' => $anggotaId,
                        'detail_items' => $detailItems,
                        'total_amount' => $totalDenda,
                        'status' => 'belum_dibayar',
                        'tanggal_faktur' => now(),
                        'tanggal_jatuh_tempo' => now()->addDays(7),
                        'keterangan' => 'Faktur Denda Terlambat'
                    ]);
                }
            }

            return redirect()->route('faktur.index')->with('success', 'Faktur denda berhasil dibuat!');
        } catch (\Exception $e) {
            Log::error('Gagal membuat faktur denda', [
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Gagal membuat faktur denda!');
        }
    }
}
