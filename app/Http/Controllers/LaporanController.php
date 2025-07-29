<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BukuRusak;
use App\Models\BukuHilang;

class LaporanController extends Controller
{
    public function bukuMasuk(Request $request)
    {
        $request->validate([
            'start' => 'nullable|date',
            'end' => 'nullable|date|after_or_equal:start',
        ]);
        $books = Book::query();
        if ($request->filled('start') && $request->filled('end')) {
            $books->whereBetween('created_at', [$request->start, $request->end]);
        }
        $books = $books->paginate(10);
        return view('pages.laporan.buku_masuk', compact('books'));
    }

    public function bukuRusak(Request $request)
    {
        $request->validate([
            'start' => 'nullable|date',
            'end' => 'nullable|date|after_or_equal:start',
        ]);
        $bukuRusak = BukuRusak::query();
        if ($request->filled('start') && $request->filled('end')) {
            $bukuRusak->whereBetween('created_at', [$request->start, $request->end]);
        }
        $bukuRusak = $bukuRusak->paginate(10);
        return view('pages.laporan.buku_rusak', compact('bukuRusak'));
    }

    public function bukuHilang(Request $request)
    {
        $request->validate([
            'start' => 'nullable|date',
            'end' => 'nullable|date|after_or_equal:start',
        ]);
        $bukuHilang = BukuHilang::query();
        if ($request->filled('start') && $request->filled('end')) {
            $bukuHilang->whereBetween('created_at', [$request->start, $request->end]);
        }
        $bukuHilang = $bukuHilang->paginate(10);
        return view('pages.laporan.buku_hilang', compact('bukuHilang'));
    }
}
