<?php

namespace App\Http\Controllers;

use App\Models\BukuHilang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BukuHilangController extends Controller
{
    public function index()
    {
        Log::info('BukuHilangController@index accessed', [
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name ?? 'Unknown',
            'user_role' => auth()->user()->role ?? 'Unknown'
        ]);
        
        $books = \App\Models\Book::all();
        $bukuHilang = \App\Models\BukuHilang::with('book')->get();
        return view('pages.bukuhilang.index', compact('books', 'bukuHilang'));
    }

    public function test()
    {
        return response()->json([
            'status' => 200,
            'message' => 'BukuHilangController is accessible',
            'user' => auth()->user()->name ?? 'Unknown',
            'role' => auth()->user()->role ?? 'Unknown'
        ]);
    }

    public function showAddModal()
    {
        $books = \App\Models\Book::all();
        return view('pages.bukuhilang.addModalBukuHilang', compact('books'));
    }

    public function showEditModal()
    {
        $books = \App\Models\Book::all();
        return view('pages.bukuhilang.editModalBukuHilang', compact('books'));
    }

    public function fetchBukuHilang(Request $request)
    {
        $bukuHilang = BukuHilang::with('book')->get();

        if ($request->ajax()) {
            return datatables()->of($bukuHilang)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <div class="btn-group">
                            <button id="btnEditBukuHilang" class="btn btn-warning btn-sm" data-id="' . $row['id'] . '">
                                <span class="fas fa-edit"></span> Edit
                            </button>
                            <button id="btnDeleteBukuHilang" class="btn btn-danger btn-sm mx-2" data-id="' . $row['id'] . '">
                                <span class="fas fa-trash-alt"></span> Hapus
                            </button>
                        </div>
                    ';
                })
                ->addColumn('checkbox', function ($row) {
                    return '
                         <input data-id="' . $row['id'] . '" type="checkbox" name="user_checkbox" id="user_checkbox">
                         <label for=""></label>
                    ';
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Debug: Log request data
        Log::info('Buku Hilang Store Request', $request->all());
        Log::info('User authenticated', [
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name ?? 'Unknown',
            'user_role' => auth()->user()->role ?? 'Unknown'
        ]);
        Log::info('Request method', ['method' => $request->method()]);
        Log::info('Request URL', ['url' => $request->url()]);
        Log::info('Request headers', ['headers' => $request->headers->all()]);

        $validation = Validator::make($request->all(), [
            'judul_buku' => 'required|string|max:255',
            'book_id' => 'required|exists:books,id',
            'penerbit_buku' => 'nullable|string|max:255',
            'pengarang_buku' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:500',
            'jumlah_hilang' => 'required|integer|min:1',
        ], [
            'judul_buku.required' => 'Field Judul Buku Wajib Diisi',
            'book_id.required' => 'Field Buku Utama Wajib Diisi',
            'book_id.exists' => 'Buku yang dipilih tidak ditemukan',
            'jumlah_hilang.required' => 'Jumlah buku hilang harus diisi',
            'jumlah_hilang.min' => 'Jumlah buku hilang minimal 1',
            'jumlah_hilang.integer' => 'Jumlah buku hilang harus berupa angka',
        ]);

        if ($validation->fails()) {
            Log::error('Buku Hilang Validation Failed', $validation->errors()->toArray());
            return response()->json([
                'status' => 400,
                'error' => $validation->errors()->toArray(),
            ]);
        }

        // Cek apakah judul buku sudah ada di tabel buku hilang
        $cekJudul = BukuHilang::where('judul_buku', $request->judul_buku)
            ->where('book_id', $request->book_id)
            ->first();

        if ($cekJudul) {
            return response()->json([
                'status' => 409,
                'error' => ['judul_buku' => ['Judul buku sudah ada di data buku hilang!']],
            ]);
        }

        // Validasi stok buku
        $buku = \App\Models\Book::find($request->book_id);
        if (!$buku) {
            return response()->json([
                'status' => 400,
                'error' => ['book_id' => ['Buku tidak ditemukan!']],
            ]);
        }

        if ($request->jumlah_hilang > $buku->jumlah_buku) {
            return response()->json([
                'status' => 400,
                'error' => ['jumlah_hilang' => ['Jumlah buku hilang tidak boleh melebihi stok yang tersedia! Stok tersedia: ' . $buku->jumlah_buku]],
            ]);
        }

        try {
            DB::beginTransaction();

            // Debug: Log before creating BukuHilang
            Log::info('Creating BukuHilang with data', [
                'judul_buku' => $request->judul_buku,
                'book_id' => $request->book_id,
                'penerbit_buku' => $request->penerbit_buku,
                'pengarang_buku' => $request->pengarang_buku,
                'keterangan' => $request->keterangan,
                'jumlah_hilang' => $request->jumlah_hilang,
            ]);

            $bukuHilang = new BukuHilang();
            $bukuHilang->judul_buku = $request->judul_buku;
            $bukuHilang->book_id = $request->book_id;
            $bukuHilang->penerbit_buku = $request->penerbit_buku;
            $bukuHilang->pengarang_buku = $request->pengarang_buku;
            $bukuHilang->keterangan = $request->keterangan;
            $bukuHilang->jumlah_hilang = $request->jumlah_hilang;
            
            // Debug: Log before save
            Log::info('About to save BukuHilang', $bukuHilang->toArray());
            
            $saved = $bukuHilang->save();
            
            // Debug: Log after save
            Log::info('BukuHilang save result', ['saved' => $saved, 'id' => $bukuHilang->id]);

            if (!$saved) {
                throw new \Exception('Failed to save BukuHilang');
            }

            // Update stok buku
            $buku->jumlah_buku -= $request->jumlah_hilang;
            $buku->save();

            Log::info('Buku hilang dicatat', [
                'judul' => $request->judul_buku,
                'book_id' => $request->book_id,
                'jumlah_hilang' => $request->jumlah_hilang,
                'user_id' => auth()->id()
            ]);

            DB::commit();

            return response()->json([
                'status' => 200,
                'success' => "Data " . $bukuHilang->judul_buku . " Berhasil Di Simpan",
                'reload' => true
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Gagal mencatat buku hilang', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 500,
                'error' => ['system' => ['Terjadi kesalahan sistem: ' . $e->getMessage()]],
            ]);
        }
    }

    public function edit(Request $request)
    {
        $bukuHilang = BukuHilang::findOrFail($request->idBukuHilang);

        return response()->json([
            'status' => 200,
            'bukuHilang' => $bukuHilang
        ]);
    }

    public function update(Request $request): \Illuminate\Http\JsonResponse
    {
        $validation = Validator::make($request->all(), [
            'judul_buku' => 'required|string|max:255',
            'book_id' => 'required|exists:books,id',
            'penerbit_buku' => 'nullable|string|max:255',
            'pengarang_buku' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:500',
            'jumlah_hilang' => 'required|integer|min:1',
        ], [
            'judul_buku.required' => 'Field Judul Buku Wajib Diisi',
            'book_id.required' => 'Field Buku Utama Wajib Diisi',
            'book_id.exists' => 'Buku yang dipilih tidak ditemukan',
            'jumlah_hilang.required' => 'Jumlah buku hilang harus diisi',
            'jumlah_hilang.min' => 'Jumlah buku hilang minimal 1',
            'jumlah_hilang.integer' => 'Jumlah buku hilang harus berupa angka',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validation->errors()->toArray(),
            ]);
        }

        try {
            DB::beginTransaction();

            $bukuHilang = BukuHilang::findOrFail($request->idBukuHilang);
            $buku = \App\Models\Book::find($request->book_id);

            if (!$buku) {
                return response()->json([
                    'status' => 400,
                    'error' => ['book_id' => ['Buku tidak ditemukan!']],
                ]);
            }

            // Kembalikan stok lama ke buku
            $buku->jumlah_buku += $bukuHilang->jumlah_hilang;

            // Validasi stok baru
            if ($request->jumlah_hilang > $buku->jumlah_buku) {
                return response()->json([
                    'status' => 400,
                    'error' => ['jumlah_hilang' => ['Jumlah buku hilang tidak boleh melebihi stok yang tersedia! Stok tersedia: ' . $buku->jumlah_buku]],
                ]);
            }

            // Update stok buku
            $buku->jumlah_buku -= $request->jumlah_hilang;
            $buku->save();

            $bukuHilang->judul_buku = $request->judul_buku;
            $bukuHilang->book_id = $request->book_id;
            $bukuHilang->penerbit_buku = $request->penerbit_buku;
            $bukuHilang->pengarang_buku = $request->pengarang_buku;
            $bukuHilang->keterangan = $request->keterangan;
            $bukuHilang->jumlah_hilang = $request->jumlah_hilang;
            $bukuHilang->save();

            Log::info('Buku hilang diupdate', [
                'judul' => $request->judul_buku,
                'book_id' => $request->book_id,
                'jumlah_hilang' => $request->jumlah_hilang,
                'user_id' => auth()->id()
            ]);

            DB::commit();

            return response()->json([
                'status' => 200,
                'success' => "Data Buku Hilang Dengan Judul " . $bukuHilang->judul_buku . " Berhasil Di Update",
                'reload' => true
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Gagal mengupdate buku hilang', ['error' => $e->getMessage()]);

            return response()->json([
                'status' => 500,
                'error' => ['system' => ['Terjadi kesalahan sistem!']],
            ]);
        }
    }

    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();

            $bukuHilang = BukuHilang::findOrFail($request->idBukuHilang);

            // Kembalikan stok ke buku
            $buku = \App\Models\Book::find($bukuHilang->book_id);
            $buku->jumlah_buku += $bukuHilang->jumlah_hilang;
            $buku->save();

            $bukuHilang->delete();

            Log::info('Buku hilang dihapus', [
                'judul' => $bukuHilang->judul_buku,
                'book_id' => $bukuHilang->book_id,
                'jumlah_hilang' => $bukuHilang->jumlah_hilang,
                'user_id' => auth()->id()
            ]);

            DB::commit();

            return response()->json([
                'status' => 200,
                'success' => "Data Dengan Judul Buku " . $bukuHilang->judul_buku . " Berhasil Di Hapus"
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Gagal menghapus buku hilang', ['error' => $e->getMessage()]);

            return response()->json([
                'status' => 500,
                'error' => ['system' => ['Terjadi kesalahan sistem!']],
            ]);
        }
    }

    public function destroySelected(Request $request)
    {
        try {
            DB::beginTransaction();

            $idBukuHilangs = $request->idBukuHilangs;
            $bukuHilangs = BukuHilang::whereIn('id', $idBukuHilangs)->get();

            foreach ($bukuHilangs as $bukuHilang) {
                // Kembalikan stok ke buku
                $buku = \App\Models\Book::find($bukuHilang->book_id);
                $buku->jumlah_buku += $bukuHilang->jumlah_hilang;
                $buku->save();
            }

            $query = BukuHilang::whereIn('id', $idBukuHilangs)->delete();

            Log::info('Buku hilang dihapus massal', [
                'ids' => $idBukuHilangs,
                'user_id' => auth()->id()
            ]);

            DB::commit();

            if ($query) {
                return response()->json([
                    'status' => 200,
                    'success' => "Data Berhasil Di Hapus"
                ]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Gagal menghapus buku hilang massal', ['error' => $e->getMessage()]);

            return response()->json([
                'status' => 500,
                'error' => ['system' => ['Terjadi kesalahan sistem!']],
            ]);
        }
    }
}
