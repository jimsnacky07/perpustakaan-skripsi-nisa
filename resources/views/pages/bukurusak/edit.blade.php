@extends('layouts.main')

@section('title', 'Edit Buku Rusak')

@section('content')
<div class="container mt-4">
    <h2>Edit Buku Rusak</h2>
    <form action="{{ route('bukurusak.update', $bukuRusak->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="judulbuku" class="form-label">Judul Buku</label>
            <input type="text" class="form-control" id="judulbuku" name="judulbuku" value="{{ $bukuRusak->judulbuku }}" required>
        </div>
        <div class="mb-3">
            <label for="jumlahrusak" class="form-label">Jumlah Rusak</label>
            <input type="number" class="form-control" id="jumlahrusak" name="jumlahrusak" value="{{ $bukuRusak->jumlahrusak }}" required>
        </div>
        <div class="mb-3">
            <label for="penyebab" class="form-label">Penyebab</label>
            <input type="text" class="form-control" id="penyebab" name="penyebab" value="{{ $bukuRusak->penyebab }}">
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan">{{ $bukuRusak->keterangan }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('bukurusak.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection