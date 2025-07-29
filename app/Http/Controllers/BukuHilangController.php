<?php

namespace App\Http\Controllers;

use App\Models\BukuHilang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BukuHilangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $books = \App\Models\Book::all();
        return view('pages.bukuHilang.index', compact('books'));
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



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'judul_buku' => 'required|string',
            'tanggal_hilang' => 'required|date',
            'book_id' => 'required|exists:books,id',
        ], [
            'judul_buku.required' => 'Field Judul Buku Wajib Diisi',
            'tanggal_hilang.required' => 'Field Tanggal Hilang Wajib Diisi',
            'book_id.required' => 'Field Buku Utama Wajib Diisi',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validation->errors()->toArray(),
            ]);
        } else {
            $bukuHilang = new BukuHilang();
            $bukuHilang->judul_buku = $request->judul_buku;
            $bukuHilang->tanggal_hilang = $request->tanggal_hilang;
            $bukuHilang->book_id = $request->book_id;
            $bukuHilang->save();

            return response()->json([
                'status' => 200,
                'success' => "Data " . $bukuHilang->judul_buku . " Berhasil Di Simpan"
            ]);
        }
    }


    public function edit(Request $request)
    {
        $bukuHilang = BukuHilang::findOrFail($request->idBukuHilang);
        // $user = User::findOrFail($request->get('idUser'));

        return response()->json([
            'status' => 200,
            'bukuHilang' => $bukuHilang
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'judul_buku' => 'required|string',
            'tanggal_hilang' => 'required|date',
            'book_id' => 'required|exists:books,id',
        ], [
            'judul_buku.required' => 'Field Judul Buku Wajib Diisi',
            'tanggal_hilang.required' => 'Field Tanggal Hilang Wajib Diisi',
            'book_id.required' => 'Field Buku Utama Wajib Diisi',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validation->errors()->toArray(),
            ]);
        } else {
            $bukuHilang = BukuHilang::findOrFail($request->idBukuHilang);
            $bukuHilang->judul_buku = $request->judul_buku;
            $bukuHilang->tanggal_hilang = $request->tanggal_hilang;
            $bukuHilang->book_id = $request->book_id;
            $bukuHilang->update();

            return response()->json([
                'status' => 200,
                'success' => "Data Buku Hilang Dengan Judul " . $bukuHilang->judul_buku . " Berhasil Di Update"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $bukuHilang = BukuHilang::findOrFail($request->idBukuHilang);
        $bukuHilang->delete();

        return response()->json([
            'status' => 200,
            'success' => "Data Dengan Judul Buku " . $bukuHilang->judul_buku . " Berhasil Di Hapus"
        ]);
    }

    public function destroySelected(Request $request)
    {
        $idBukuHilangs = $request->idBukuHilangs;
        $query = BukuHilang::whereIn('id', $idBukuHilangs)->delete();

        if ($query) {
            return response()->json([
                'status' => 200,
                'success' => "Data Berhasil Di Hapus"
            ]);
        }
    }
}
