<?php

namespace App\Http\Controllers;

use App\Models\RakBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RakBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.rakBuku.index');
    }


    public function fetchRakBuku(Request $request)
    {
        $rakBuku = RakBuku::all();

        if ($request->ajax()) {
            return datatables()->of($rakBuku)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <div class="btn-group">
                            <button id="btnEditRak" class="btn btn-warning btn-sm" data-id="' . $row['id'] . '">
                                <span class="fas fa-edit"></span> Edit
                            </button>
                            <button id="btnDeleteRak" class="btn btn-danger btn-sm mx-2" data-id="' . $row['id'] . '">
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
            'no_rak' => 'required|string',
            'nama_rak' => 'required',
            'kapasitas_rak' => 'required|string',
        ], [
            'no_rak.required' => 'Field Nama Wajib Diisi',
            'nama_rak.required' => 'Field role Wajib Diisi',
            'kapasitas_rak.required' => 'Field Password Wajib Diisi',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validation->errors()->toArray(),
            ]);
        } else {
            $dataRakBuku = new RakBuku();
            $dataRakBuku->no_rak = $request->no_rak;
            $dataRakBuku->nama_rak = $request->nama_rak;
            $dataRakBuku->kapasitas_rak = $request->kapasitas_rak;
            $dataRakBuku->save();

            return response()->json([
                'status' => 200,
                'success' => "Data Berhasil Di Simpan"
            ]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $rakBuku = RakBuku::findOrFail($request->idRakBuku);
        // dd($user);
        // $user = User::findOrFail($request->get('idRakBuku'));

        return response()->json([
            'status' => 200,
            'rakBuku' => $rakBuku
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'no_rak' => 'required|string',
            'nama_rak' => 'required',
            'kapasitas_rak' => 'required|string',
        ], [
            'no_rak.required' => 'Field Nama Wajib Diisi',
            'nama_rak.required' => 'Field role Wajib Diisi',
            'kapasitas_rak.required' => 'Field Password Wajib Diisi',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validation->errors()->toArray(),
            ]);
        } else {
            $dataRakBuku = RakBuku::findOrFail($request->idRakBuku);
            $dataRakBuku->no_rak = $request->no_rak;
            $dataRakBuku->nama_rak = $request->nama_rak;
            $dataRakBuku->kapasitas_rak = $request->kapasitas_rak;
            $dataRakBuku->update();

            return response()->json([
                'status' => 200,
                'success' => "Data Id " . $dataRakBuku->id . " Dengan Nama " . $dataRakBuku->nama_rak . " Berhasil Di Update"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $dataRakBuku = RakBuku::findOrFail($request->idRakBuku);

        if ($dataRakBuku->id == auth()->user()->id) {
            return response()->json([
                'status' => 400,
                'error' => "Tidak Bisa Hapus Data, Karena User Sedang Aktif"
            ]);
        }
        $dataRakBuku->delete();

        return response()->json([
            'status' => 200,
            'success' => "Data Dengan Nama " . $dataRakBuku->nama_rak . " Berhasil Di Hapus"
        ]);
    }

    public function destroySelected(Request $request)
    {
        $idRakBuku = $request->idRakBukus;
        $query = RakBuku::whereIn('id', $idRakBuku)->delete();

        if ($query) {
            return response()->json([
                'status' => 200,
                'success' => "Data User Berhasil Di Hapus"
            ]);
        }
    }
}
