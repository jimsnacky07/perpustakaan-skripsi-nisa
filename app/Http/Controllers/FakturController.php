<?php

namespace App\Http\Controllers;

use App\Models\Faktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class FakturController extends Controller
{
    public function index()
    {
        $faktur = Faktur::with('anggota')->latest()->get();
        return view('pages.faktur.index', compact('faktur'));
    }

    public function show($id)
    {
        $faktur = Faktur::with(['anggota', 'peminjaman', 'pengembalian'])->findOrFail($id);
        return view('pages.faktur.show', compact('faktur'));
    }

    public function downloadPDF($id)
    {
        $faktur = Faktur::with(['anggota', 'peminjaman', 'pengembalian'])->findOrFail($id);

        $pdf = PDF::loadView('pages.faktur.pdf', compact('faktur'));

        return $pdf->download('faktur-' . $faktur->nomor_faktur . '.pdf');
    }

    public function markAsPaid($id)
    {
        try {
            $faktur = Faktur::findOrFail($id);
            $faktur->status = 'dibayar';
            $faktur->save();

            Log::info('Faktur ditandai sebagai dibayar', [
                'nomor_faktur' => $faktur->nomor_faktur,
                'user_id' => auth()->id()
            ]);

            return redirect()->route('faktur.show', $faktur->id)->with('success', 'Faktur berhasil ditandai sebagai dibayar!');
        } catch (\Exception $e) {
            Log::error('Gagal menandai faktur sebagai dibayar', [
                'error' => $e->getMessage(),
                'faktur_id' => $id
            ]);
            return redirect()->back()->with('error', 'Gagal menandai faktur sebagai dibayar!');
        }
    }
}
