@extends('layouts.main')

@section('title', 'Tambah Buku Rusak')

@section('content')
<div class="container mt-4">
    <h2>Tambah Buku Rusak</h2>
    <form action="{{ route('bukurusak.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="judulbuku" class="form-label">Judul Buku</label>
            <input type="text" class="form-control" id="judulbuku" name="judulbuku" required>
        </div>
        <div class="mb-3">
            <label for="jumlahrusak" class="form-label">Jumlah Rusak</label>
            <input type="number" class="form-control" id="jumlahrusak" name="jumlahrusak" required>
        </div>
        <div class="mb-3">
            <label for="penyebab" class="form-label">Penyebab</label>
            <input type="text" class="form-control" id="penyebab" name="penyebab">
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('bukurusak.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection