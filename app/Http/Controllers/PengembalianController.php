<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = \App\Models\Pengembalian::with(['anggota', 'book'])->orderBy('tanggal_pengembalian', 'asc')->get();
        return view('pages.pengembalian.index', compact('pengembalian'));
    }

    public function tambah()
    {
        // Ambil anggota yang memiliki peminjaman aktif
        $anggota = DB::table('peminjaman')
            ->join('anggotas', 'peminjaman.id_anggota_peminjaman', '=', 'anggotas.id')
            ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
            ->select('peminjaman.id_anggota_peminjaman', 'anggotas.nama', 'anggotas.nisn')
            ->where('detail_peminjaman.status', 0) // Hanya peminjaman yang belum dikembalikan
            ->groupBy('peminjaman.id_anggota_peminjaman', 'anggotas.nama', 'anggotas.nisn')
            ->get();

        return view('pages.pengembalian.create', compact('anggota'));
    }

    public function store(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'id_anggota' => 'required|exists:anggotas,id',
            'id' => 'required|exists:books,id',
            'jumlah' => 'required|integer|min:1',
            'id_peminjaman' => 'required|exists:peminjaman,id',
        ], [
            'id_anggota.required' => 'Anggota harus dipilih',
            'id.required' => 'Buku harus dipilih',
            'jumlah.required' => 'Jumlah pengembalian harus diisi',
            'jumlah.min' => 'Jumlah pengembalian minimal 1',
            'id_peminjaman.required' => 'Data peminjaman tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect('tambah-pengembalian')
                ->withErrors($validator)
                ->withInput();
        }

        // Validasi apakah buku benar-benar dipinjam oleh anggota tersebut
        $peminjamanValid = DB::table('detail_peminjaman')
            ->join('peminjaman', 'detail_peminjaman.id_peminjaman', '=', 'peminjaman.id')
            ->where('peminjaman.id', $r->id_peminjaman)
            ->where('peminjaman.id_anggota_peminjaman', $r->id_anggota)
            ->where('detail_peminjaman.id_buku_pinjam', $r->id)
            ->where('detail_peminjaman.status', 0)
            ->first();

        if (!$peminjamanValid) {
            return redirect('tambah-pengembalian')
                ->withErrors(['id' => 'Buku tidak dipinjam oleh anggota tersebut atau sudah dikembalikan'])
                ->withInput();
        }

        // Validasi jumlah pengembalian tidak melebihi yang dipinjam
        if ($r->jumlah > $peminjamanValid->jumlah_buku) {
            return redirect('tambah-pengembalian')
                ->withErrors(['jumlah' => 'Jumlah pengembalian tidak boleh melebihi jumlah yang dipinjam'])
                ->withInput();
        }

        try {
            $tanggalPengembalian = Carbon::now()->toDateString();
            $peminjaman = DB::table('peminjaman')->where('id', $r->id_peminjaman)->first();
            $jumlahHariTerlambat = 0;
            $denda = 0;

            if ($peminjaman) {
                $tanggalWajibKembali = $peminjaman->tgl_kembali;

                // Hanya hitung keterlambatan jika tanggal pengembalian > tanggal wajib kembali
                if (Carbon::parse($tanggalPengembalian)->greaterThan(Carbon::parse($tanggalWajibKembali))) {
                    $jumlahHariTerlambat = Carbon::parse($tanggalWajibKembali)->diffInDays($tanggalPengembalian);
                    $denda = $r->jumlah * $jumlahHariTerlambat * 1000; // Rp 1000 per hari per buku
                }
                // Jika tidak terlambat (dikembalikan tepat waktu atau lebih awal), 
                // jumlahHariTerlambat dan denda tetap 0
            }

            $pengembalian = new \App\Models\Pengembalian();
            $pengembalian->id_anggota = $r->id_anggota;
            $pengembalian->id_buku = $r->id;
            $pengembalian->qty = $r->jumlah;
            $pengembalian->denda = $denda;
            $pengembalian->jumlah_hari_terlambat = $jumlahHariTerlambat;
            $pengembalian->tanggal_pengembalian = $tanggalPengembalian;
            $pengembalian->save();

            // Update status detail peminjaman
            $jumlahDikembalikan = $peminjamanValid->jumlah_buku - $r->jumlah;
            if ($jumlahDikembalikan <= 0) {
                // Semua buku dikembalikan
                DB::table('detail_peminjaman')
                    ->where('id_peminjaman', $r->id_peminjaman)
                    ->where('id_buku_pinjam', $r->id)
                    ->update(['status' => 1]);
            } else {
                // Sebagian buku dikembalikan
                DB::table('detail_peminjaman')
                    ->where('id_peminjaman', $r->id_peminjaman)
                    ->where('id_buku_pinjam', $r->id)
                    ->update(['jumlah_buku' => $jumlahDikembalikan]);
            }

            // Update stok buku
            DB::table('books')->where('id', $r->id)->update([
                "jumlah_buku" => DB::raw('jumlah_buku + ' . $r->jumlah),
            ]);

            Log::info('Pengembalian buku', [
                'anggota_id' => $r->id_anggota,
                'buku_id' => $r->id,
                'jumlah' => $r->jumlah,
                'denda' => $denda,
                'keterlambatan' => $jumlahHariTerlambat,
                'user_id' => auth()->id()
            ]);

            $message = 'Pengembalian berhasil!';
            if ($denda > 0) {
                $message .= " Denda keterlambatan: Rp " . number_format($denda);
            }

            return redirect(route('pengembalian'))->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Gagal memproses pengembalian', ['error' => $e->getMessage()]);
            return redirect(route('pengembalian'))->with('error', 'Terjadi kesalahan sistem!');
        }
    }

    // Method untuk melunasi denda
    public function lunasiDenda(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pengembalian_id' => 'required|exists:pengembalians,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Data tidak valid']);
        }

        try {
            $pengembalian = \App\Models\Pengembalian::findOrFail($request->pengembalian_id);
            // Catat pelunasan denda (karena tidak ada kolom status_pembayaran, kita hanya log saja)

            Log::info('Denda dilunasi', [
                'pengembalian_id' => $request->pengembalian_id,
                'denda' => $pengembalian->denda,
                'user_id' => auth()->id()
            ]);

            return response()->json(['success' => true, 'message' => 'Denda berhasil dilunasi']);
        } catch (\Exception $e) {
            Log::error('Gagal melunasi denda', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan sistem']);
        }
    }

    // Method untuk mendapatkan data buku yang dipinjam berdasarkan anggota
    public function getBukuDipinjam(Request $request)
    {
        $anggotaId = $request->anggota_id;

        $bukuDipinjam = DB::table('detail_peminjaman')
            ->join('peminjaman', 'detail_peminjaman.id_peminjaman', '=', 'peminjaman.id')
            ->join('books', 'detail_peminjaman.id_buku_pinjam', '=', 'books.id')
            ->where('peminjaman.id_anggota_peminjaman', $anggotaId)
            ->where('detail_peminjaman.status', 0) // Hanya buku yang belum dikembalikan
            ->select(
                'books.id',
                'books.judul_buku', 
                'books.no_isbn',
                'detail_peminjaman.jumlah_buku',
                'peminjaman.tgl_kembali',
                'peminjaman.id as id_peminjaman'
            )
            ->get();

        return response()->json($bukuDipinjam);
    }
}
