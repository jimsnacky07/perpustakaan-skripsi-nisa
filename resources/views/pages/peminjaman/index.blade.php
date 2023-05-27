@extends('layouts.main')

@section('title', 'Data Peminjaman')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Peminjaman</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="row justify-content-between">
                            <div class="col-md-auto">
                                <a href="{{ route('peminjaman.create') }}" class="btn btn-warning"><i
                                        class="fas fa-plus-square">
                                        Tambah Data Peminjaman Buku</i>
                                </a>
                            </div>
                            <div class="col-md-auto">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#filterModal">Laporan Peminjaman Buku</button>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <table id="table" class="table table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Kode Peminjaman</th>
                                        <th>Nama Peminjam</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Tgl Wajib Kembali</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjaman as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode_peminjaman }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ date('d F Y', strtotime($item->tgl_pinjam)) }}</td>
                                            <td>{{ date('d F Y', strtotime($item->tgl_kembali)) }}</td>

                                            <td>

                                                <a href="{{ route('cetak-bukti-peminjaman', $item->id) }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-print">
                                                    </i></a>

                                                <a href="{{ route('detail-peminjaman', $item->id) }}"
                                                    class="btn btn-dark btn-sm"><i class="fas fa-eye">
                                                    </i></a>

                                                <form action="{{ route('peminjaman.destroy', $item->id) }}" method="POST"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm hapus"><i
                                                            class="fas fa-trash"
                                                            onclick="return confirm('Apakah Yakin Ingin Menghapus Data Ini?')">
                                                        </i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.laporan.modal_laporan')
@endsection
@push('after-script')

    @if (session('success') == true)
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2500
            })
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endpush
