@extends('layouts.main')

@section('title', 'Data Buku Rusak')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Buku Rusak</h2>
        <a href="{{ route('bukurusak.create') }}" class="btn btn-primary">Tambah Buku Rusak</a>
    </div>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Jumlah Rusak</th>
                <th>Penyebab</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bukuRusak as $no => $rusak)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td>{{ $rusak->judulbuku }}</td>
                <td>{{ $rusak->jumlahrusak }}</td>
                <td>{{ $rusak->penyebab }}</td>
                <td>{{ $rusak->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection