<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['buku'] = DB::table('books')
            ->join('jenis_bukus', 'books.jenis_buku_id', '=', 'jenis_bukus.id')
            ->join('rak_bukus', 'books.rak_buku_id', '=', 'rak_bukus.id')
            ->select('books.*', 'jenis_bukus.name', 'rak_bukus.no_rak', 'rak_bukus.nama_rak')
            ->get();

        // dd($data);
        return view('pages.buku.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['kategori'] = DB::table('jenis_bukus')->get();
        $data['rak'] = DB::table('rak_bukus')->get();
        return view('pages.buku.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($data);
        $this->validate($request, [
            'jenis_buku_id' => 'required',
            'judul_buku' => 'required',
            'no_isbn' => 'required',
            'tahun_terbit' => 'required',
            'penerbit_buku' => 'required',
            'pengarang_buku' => 'required',
            'rak_buku_id' => 'required',
            'jumlah_buku' => 'required',
            'gambar'     => 'required|image|mimes:png,jpg,jpeg',
        ]);

        //upload image
        $image = $request->file('gambar');
        $namabuku = $image->hashName();
        $image->move(public_path('storage/buku'), $namabuku);

        $buku = Book::create([
            'jenis_buku_id' => $request->jenis_buku_id,
            'judul_buku' => $request->judul_buku,
            'no_isbn' => $request->no_isbn,
            'tahun_terbit' => $request->tahun_terbit,
            'penerbit_buku' => $request->penerbit_buku,
            'pengarang_buku' => $request->pengarang_buku,
            'rak_buku_id' => $request->rak_buku_id,
            'jumlah_buku' => $request->jumlah_buku,
            'gambar'     => $namabuku,
        ]);


        if ($buku) {
            //redirect dengan pesan sukses
            return redirect()->route('buku.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('buku.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['buku'] = Book::with(['bukuHilangs', 'bukuRusaks', 'kategoriBuku'])
            ->where('id', $id)
            ->first();

        return view('pages.buku.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['kategori'] = DB::table('jenis_bukus')->get();
        $data['rak'] = DB::table('rak_bukus')->get();
        $data['buku'] = Book::findOrFail($id);

        return view('pages.buku.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'jenis_buku_id' => 'required',
            'judul_buku' => 'required',
            'no_isbn' => 'required',
            'tahun_terbit' => 'required',
            'penerbit_buku' => 'required',
            'pengarang_buku' => 'required',
            'rak_buku_id' => 'required',
            'jumlah_buku' => 'required',
            'gambar'     => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        //get data Buku by ID
        $buku = Book::findOrFail($id);

        if ($request->file('gambar') == "") {

            $buku->update([
                'jenis_buku_id' => $request->jenis_buku_id,
                'judul_buku' => $request->judul_buku,
                'no_isbn' => $request->no_isbn,
                'tahun_terbit' => $request->tahun_terbit,
                'penerbit_buku' => $request->penerbit_buku,
                'pengarang_buku' => $request->pengarang_buku,
                'rak_buku_id' => $request->rak_buku_id,
                'jumlah_buku' => $request->jumlah_buku,
            ]);
        } else {

            //hapus old image
            Storage::disk('local')->delete('public/buku/' . $buku->gambar);

            //upload new image
            $image = $request->file('gambar');
            $image->storeAs('public/buku', $image->hashName());

            $buku->update([
                'gambar'     => $image->hashName(),
                'jenis_buku_id' => $request->jenis_buku_id,
                'judul_buku' => $request->judul_buku,
                'no_isbn' => $request->no_isbn,
                'tahun_terbit' => $request->tahun_terbit,
                'penerbit_buku' => $request->penerbit_buku,
                'pengarang_buku' => $request->pengarang_buku,
                'rak_buku_id' => $request->rak_buku_id,
                'jumlah_buku' => $request->jumlah_buku,
            ]);
        }

        if ($buku) {
            //redirect dengan pesan sukses
            return redirect()->route('buku.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Book::findOrFail($id);
        Storage::disk('local')->delete('public/buku/' . $buku->gambar);
        $buku->delete();

        if ($buku) {
            //redirect dengan pesan sukses
            return redirect()->route('buku.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
    }
}
