@extends('layouts.main')


@section('title', 'Form Buku Hilang')


@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target='#addModalBukuHilang'>
                                <span class="fas fa-plus-circle"></span>
                                Tambah Data
                            </button>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-danger" type="submit" id="deleteAll">
                                <span class="fas fa-trash"></span>
                                Hapus
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Buku</th>
                                        <th>Penerbit</th>
                                        <th>Pengarang</th>
                                        <th>Jumlah Hilang</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($bukuHilang))
                                        @foreach ($bukuHilang as $i => $item)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $item->book->judul_buku ?? $item->judul_buku ?? '-' }}</td>
                                                <td>{{ $item->book->penerbit_buku ?? $item->penerbit_buku ?? '-' }}</td>
                                                <td>{{ $item->book->pengarang_buku ?? $item->pengarang_buku ?? '-' }}</td>
                                                <td class="text-center">
                                                    <span class="badge badge-danger">{{ $item->jumlah_hilang ?? 0 }}</span>
                                                </td>
                                                <td>{{ $item->keterangan ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Add Modal Buku Hilang --}}
    @include('pages.bukuhilang.addModalBukuHilang')

    {{-- Edit Modal Buku Hilang --}}
    @include('pages.bukuhilang.editModalBukuHilang')
@endsection

@push('after-script')
    @include('pages.bukuhilang.scripts')
@endpush()
