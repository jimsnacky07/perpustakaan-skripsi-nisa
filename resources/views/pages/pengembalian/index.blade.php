@extends('layouts.main')

@section('title', 'Data Pengembalian Buku')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Pengembalian</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="row justify-content-between">
                            <div class="col-md-auto">
                                <a href="{{ route('pengembalian.create') }}" class="btn btn-warning"><i
                                        class="fas fa-plus-square">
                                        Tambah Data Pengembalian Buku</i>
                                </a>
                            </div>
                            <div class="col-md-auto">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#filterModal">Laporan Pengembalian Buku</button>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <table class="table table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peminjam</th>
                                        <th>No Isbn</th>
                                        <th>Judul Buku</th>
                                        <th>Jumlah Di Kembalikan</th>
                                        <th>Tgl Pengembalian</th>
                                        <th>Terlambat (Hari)</th>
                                        <th>Denda</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengembalian as $i => $data)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->no_isbn }}</td>
                                            <td>{{ $data->judul_buku }}</td>
                                            <td>{{ $data->qty }}</td>
                                            <td>{{ date('d F Y', strtotime($data->tanggal_pengembalian)) }}</td>

                                            <td>{{ $data->jumlah_hari_terlambat }} Hari</td>
                                            <td>Rp. {{ number_format($data->denda) }}</td>

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
    @include('pages.laporan.modal_laporan_pengembalian_buku')
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
