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
                                            <th scope="col">Tahun Terbit</th>
                                            <th scope="col">Tanggal Pinjam</th>
                                            <th scope="col">Tanggal Wajib Pengembalian</th>
                                            <th scope="col">Status</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($peminjaman as $item)
                                            @foreach ($detailPeminjaman as $data)
                                                @if ($item->id_anggota_peminjaman == $anggota->id && $data->id_peminjaman == $item->id)
                                                    <tr>
                                                        <th>{{ $no++ }}</th>
                                                        <td>{{ $data->no_isbn }}</td>
                                                        <td>{{ $data->judul_buku }}</td>
                                                        <td>{{ $data->tahun_terbit }}</td>
                                                        <td>{{ date('d F Y', strtotime($item->tgl_pinjam)) }}</td>
                                                        <td>{{ date('d F Y', strtotime($item->tgl_kembali)) }}</td>
                                                        <td>{{ $data->status == 0 ? 'DiPinjam' : 'DiKembalikan' }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
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
