@extends('layouts.main')

@section('title', 'Detail Buku Rusak')

@section('content')
<div class="container mt-4">
    <h2>Detail Buku Rusak</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Judul Buku:</strong> {{ $bukuRusak->judulbuku }}</p>
            <p><strong>Jumlah Rusak:</strong> {{ $bukuRusak->jumlahrusak }}</p>
            <p><strong>Penyebab:</strong> {{ $bukuRusak->penyebab }}</p>
            <p><strong>Keterangan:</strong> {{ $bukuRusak->keterangan }}</p>
            <a href="{{ route('bukurusak.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection