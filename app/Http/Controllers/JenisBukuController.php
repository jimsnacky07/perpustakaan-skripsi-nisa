<?php

namespace App\Http\Controllers;

use App\Models\JenisBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class JenisBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.jenisBuku.index');
    }

    public function fetchJenisBuku(Request $request)
    {
        $jenisBuku = JenisBuku::all();

        if ($request->ajax()) {
            return datatables()->of($jenisBuku)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <div class="btn-group">
                            <button id="btnEditKategori" class="btn btn-warning btn-sm" data-id="' . $row['id'] . '">
                                <span class="fas fa-edit"></span> Edit
                            </button>
                            <button id="btnDeleteKategori" class="btn btn-danger btn-sm mx-2" data-id="' . $row['id'] . '">
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
            'name' => 'required|string',
        ], [
            'name.required' => 'Field Jenis Buku Wajib Diisi',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validation->errors()->toArray(),
            ]);
        } else {
            $jenisBuku = new JenisBuku();
            $jenisBuku->name = $request->name;
            $jenisBuku->slug = Str::slug($request->name);
            $jenisBuku->save();

            return response()->json([
                'status' => 200,
                'success' => "Data " . $jenisBuku->name . " Berhasil Di Simpan"
            ]);
        }
    }


    public function edit(Request $request)
    {
        $jenisBuku = JenisBuku::findOrFail($request->idKategori);
        // $user = User::findOrFail($request->get('idUser'));

        return response()->json([
            'status' => 200,
            'jenisBuku' => $jenisBuku
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
            'name' => 'required|string',

        ], [
            'name.required' => 'Field Jenis Buku Wajib Diisi',

        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validation->errors()->toArray(),
            ]);
        } else {
            $jenisBuku = JenisBuku::findOrFail($request->idKategori);
            $jenisBuku->name = $request->name;
            $jenisBuku->slug = Str::slug($request->name);
            $jenisBuku->update();

            return response()->json([
                'status' => 200,
                'success' => "Data Jenis Buku Dengan Nama " . $jenisBuku->name . " Berhasil Di Update"
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
        $jenisBuku = JenisBuku::findOrFail($request->idKategori);
        $jenisBuku->delete();

        return response()->json([
            'status' => 200,
            'success' => "Data Dengan Nama Jenis Buku " . $jenisBuku->name . " Berhasil Di Hapus"
        ]);
    }

    public function destroySelected(Request $request)
    {
        $idKategori = $request->idKategoris;
        $query = JenisBuku::whereIn('id', $idKategori)->delete();

        if ($query) {
            return response()->json([
                'status' => 200,
                'success' => "Data Berhasil Di Hapus"
            ]);
        }
    }
}
