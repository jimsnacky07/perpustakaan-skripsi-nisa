<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data['peminjaman'] = DB::table('peminjaman')
            ->join('anggotas', 'peminjaman.id_anggota_peminjaman', '=', 'anggotas.id')
            ->join('detail_peminjaman', 'detail_peminjaman.id_peminjaman', '=', 'peminjaman.id')
            ->join('books', 'books.id', '=', 'detail_peminjaman.id_buku_pinjam')
            ->where('detail_peminjaman.status', '<>', 2)
            ->select('peminjaman.*', 'anggotas.nama')
            ->distinct()
            ->get();

        return view('pages.peminjaman.index', $data);
    }

    public function detail($id)
    {
        $data['detail'] = DB::table('peminjaman')
            ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
            ->join('books', 'detail_peminjaman.id_buku_pinjam', '=', 'books.id')
            ->join('anggotas', 'peminjaman.id_anggota_peminjaman', '=', 'anggotas.id')
            ->where('peminjaman.id', $id)
            ->select('peminjaman.*', 'anggotas.nama as nama_anggota', 'books.*', 'detail_peminjaman.*')
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
        // Validasi buku yang sama
        $existingBook = DB::table('peminjaman_temp')
            ->where('isbn', $r->isbn)
            ->first();

        if ($existingBook) {
            return response()->json(['error' => 'Buku ini sudah ada dalam keranjang!']);
        }

        // Validasi stok buku
        $buku = DB::table('books')->where('no_isbn', $r->isbn)->first();
        if (!$buku) {
            return response()->json(['error' => 'Buku tidak ditemukan!']);
        }

        if ($r->jumlah > $buku->jumlah_buku) {
            return response()->json(['error' => 'Stok buku tidak mencukupi!']);
        }

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
        // Validasi apakah ada item di temporary
        $tempItems = DB::table('peminjaman_temp')->get();
        if ($tempItems->count() == 0) {
            flash()->addError('Tidak ada buku yang dipilih. Silakan tambahkan buku terlebih dahulu.');
            return redirect(route('peminjaman.create'));
        }

        // Validasi denda sebelumnya - sesuaikan dengan struktur database yang ada
        $dendaBelumLunas = DB::table('pengembalians')
            ->where('id_anggota', $request->id_anggota_peminjaman)
            ->where('denda', '>', 0)
            ->sum('denda');

        if ($dendaBelumLunas > 0) {
            flash()->addError("Anggota memiliki denda sebesar Rp " . number_format($dendaBelumLunas) . ". Harap lunasi terlebih dahulu.");
            DB::table('peminjaman_temp')->delete();
            return redirect(route('peminjaman.create'));
        }

        // Validasi limit peminjaman
        $count = DB::table('peminjaman')
            ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
            ->where('id_anggota_peminjaman', $request->id_anggota_peminjaman)
            ->where('detail_peminjaman.status', 0)
            ->count();

        if ($count >= 10) {
            flash()->addError('User telah mencapai limit untuk meminjam buku (maksimal 10 buku)');
            DB::table('peminjaman_temp')->delete();
            return redirect(route('peminjaman.create'));
        }

        // Validasi buku yang sudah dipinjam
        $temp = DB::table('peminjaman_temp')->get();
        foreach ($temp as $t) {
            $bukuSudahDipinjam = DB::table('detail_peminjaman')
                ->join('peminjaman', 'detail_peminjaman.id_peminjaman', '=', 'peminjaman.id')
                ->where('peminjaman.id_anggota_peminjaman', $request->id_anggota_peminjaman)
                ->where('detail_peminjaman.id_buku_pinjam', DB::table('books')->where('no_isbn', $t->isbn)->value('id'))
                ->where('detail_peminjaman.status', 0)
                ->count();

            if ($bukuSudahDipinjam > 0) {
                flash()->addError("Buku '{$t->judul}' sudah dipinjam oleh anggota ini.");
                DB::table('peminjaman_temp')->delete();
                return redirect(route('peminjaman.create'));
            }
        }

        try {
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
                        DB::table('peminjaman_temp')->delete();
                        DB::table('peminjaman')->where('id', $id)->delete();
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

                DB::table('peminjaman_temp')->delete();

                Log::info('Peminjaman baru dibuat', [
                    'kode_peminjaman' => date('YmdHis') . rand(0, 999),
                    'anggota_id' => $request->id_anggota_peminjaman,
                    'jumlah_buku' => $temp->count(),
                    'user_id' => auth()->id()
                ]);

                return redirect(route('peminjaman'))->with('success', 'Peminjaman berhasil dibuat!');
            } else {
                return redirect(route('peminjaman'))->with('error', 'Gagal membuat peminjaman!');
            }
        } catch (\Exception $e) {
            Log::error('Gagal membuat peminjaman', ['error' => $e->getMessage()]);
            DB::table('peminjaman_temp')->delete();
            return redirect(route('peminjaman'))->with('error', 'Terjadi kesalahan sistem!');
        }
    }

    public function destroy($id)
    {
        try {
            $temp = DB::table('detail_peminjaman')->where('id_peminjaman', $id)->get();

            foreach ($temp as $t) {
                $UpdateStockBuku = DB::table('books')->where('id', $t->id_buku_pinjam)->update([
                    "jumlah_buku" => DB::raw('jumlah_buku + ' . $t->jumlah_buku),
                ]);
            }

            $hapus = DB::table('peminjaman')->where('id', $id)->delete();
            $hapusDetailPeminjaman = DB::table('detail_peminjaman')->where('id_peminjaman', $id)->delete();

            Log::info('Peminjaman dihapus', [
                'peminjaman_id' => $id,
                'user_id' => auth()->id()
            ]);

            if ($hapus && $hapusDetailPeminjaman == true) {
                return redirect()->back()->with(['success' => 'Data Berhasil Di Hapus']);
            } else {
                return redirect()->back()->with(['error' => 'Gagal menghapus data']);
            }
        } catch (\Exception $e) {
            Log::error('Gagal menghapus peminjaman', ['error' => $e->getMessage()]);
            return redirect()->back()->with(['error' => 'Terjadi kesalahan sistem']);
        }
    }

    public function cetakBuktiPeminjaman($id)
    {
        $data['peminjaman'] = DB::table('peminjaman')
            ->join('anggotas', 'peminjaman.id_anggota_peminjaman', '=', 'anggotas.id')
            ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
            ->select('peminjaman.*', 'detail_peminjaman.*', 'anggotas.nama', 'anggotas.nisn')
            ->where('peminjaman.id', $id)
            ->get();

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

        return view('pages.permintaanPeminjaman.index', $data);
    }

    public function terimaPermintaanPeminjaman(Request $request)
    {
        $ids = $request->input('ids');

        if (is_array($ids)) {
            DB::table('detail_peminjaman')
                ->whereIn('id_peminjaman', $ids)
                ->update(['status' => 0]);

            Log::info('Permintaan peminjaman diterima', [
                'ids' => $ids,
                'user_id' => auth()->id()
            ]);

            flash('Peminjaman Berhasil Di Accept');
        }
        return response()->json(['success' => true]);
    }
}
