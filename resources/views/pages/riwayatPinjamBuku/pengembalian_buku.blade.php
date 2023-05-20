@extends('layouts.main')

@section('title', 'Data Pengembalian Buku')

@section('content')
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Pengembalian Buku</h3>
                </div>

                <div class="card-body">
                    <div class="col-lg-auto">
                        <div class="card mb-4">
                            <div class="table-responsive p-3">
                                <table class="table align-items-center justify-content-center table-hover"
                                    id="dataTableHover" style="font-size: .8rem">
                                    <thead class="thead-light">
                                        <tr class="">
                                            <th scope="col">No.</th>
                                            <th scope="col">ISBN Buku</th>
                                            <th scope="col">Judul Buku</th>
                                            <th scope="col">Pengarang</th>
                                            <th scope="col">Tahun Terbit</th>
                                            <th scope="col">Tgl Pengembalian</th>
                                            <th scope="col">Jumlah Hari Terlambat</th>
                                            <th scope="col">Denda</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($pengembalian as $data)
                                            <tr>
                                                <th>{{ $no++ }}</th>
                                                <td>{{ $data->no_isbn }}</td>
                                                <td>{{ $data->judul_buku }}</td>
                                                <td>{{ $data->pengarang_buku }}</td>
                                                <td>{{ $data->tahun_terbit }}</td>
                                                <td>{{ date('d F Y', strtotime($data->tanggal_pengembalian)) }} </td>
                                                <td>{{ $data->jumlah_hari_terlambat }} Hari</td>
                                                <td>Rp . {{ number_format($data->denda) }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th colspan="7" class="text-center">Total Hari Terlambat</th>
                                            <th>{{ $totalHariTerlambat }}</th>
                                        </tr>
                                        <tr>
                                            <th colspan="7" class="text-center">Total Denda</th>
                                            <th>Rp . {{ number_format($totalDenda) }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Pengembalian Buku {{ $anggota->nama }} <i>({{ $anggota->nisn }})</i></h3>
                </div>
                <div class="card-body">
                    <div class="col-lg-auto">
                        <div class="card mb-4">
                            <div class="table-responsive p-3">
                                <table class="table align-items-center justify-content-center table-hover"
                                    id="dataTableHover" style="font-size: .8rem">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">ISBN Buku</th>
                                            <th scope="col">Judul Buku</th>
                                            <th scope="col">Pengarang</th>
                                            <th scope="col">Tahun Terbit</th>
                                            <th scope="col">Tgl Pengembalian</th>
                                            <th scope="col">Jumlah Hari Terlambat</th>
                                            <th scope="col">Denda</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp

                                        @foreach ($pengembalian as $data)
                                            <tr>
                                                <th>{{ $no++ }}</th>
                                                <td>{{ $data->no_isbn }}</td>
                                                <td>{{ $data->judul_buku }}</td>
                                                <td>{{ $data->pengarang_buku }}</td>
                                                <td>{{ $data->tahun_terbit }}</td>
                                                <td>{{ date('d F Y', strtotime($data->tanggal_pengembalian)) }}</td>
                                                <td>{{ $data->jumlah_hari_terlambat }} Hari</td>
                                                <td>Rp. {{ number_format($data->denda) }}</td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <th colspan="6" class="text-left">Total Hari Terlambat</th>
                                            <th>{{ $totalHariTerlambat }} Hari</th>
                                        </tr>
                                        <tr>
                                            <th colspan="7" class="text-left">Total Denda</th>
                                            <th>Rp. {{ number_format($totalDenda) }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('after-script')
    <script>
        $(document).ready(function() {
            $('#dataTableHover').DataTable();
        });
    </script>
@endpush
