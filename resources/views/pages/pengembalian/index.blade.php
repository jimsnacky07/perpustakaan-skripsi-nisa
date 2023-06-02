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
                            @if (auth()->user()->role == 'admin')
                                <div class="col-md-auto">
                                    <a href="{{ route('pengembalian.create') }}" class="btn btn-warning"><i
                                            class="fas fa-plus-square">
                                            Tambah Data Pengembalian Buku</i>
                                    </a>
                                </div>
                            @endif

                            <div class="col-md-auto">
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal"
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
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $idAnggotaArr = [];
                                    @endphp
                                    @foreach ($pengembalian as $i => $data)
                                        @if (!in_array($data->id_anggota, $idAnggotaArr))
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $data->nama }}</td>
                                                <td>{{ $data->no_isbn }}</td>
                                                <td>{{ $data->judul_buku }}</td>
                                                <td>{{ $data->qty }}</td>
                                                <td>{{ date('d F Y', strtotime($data->tanggal_pengembalian)) }}</td>
                                                <td>{{ $data->jumlah_hari_terlambat }} Hari</td>
                                                <td>Rp. {{ number_format($data->denda) }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#detailModal-{{ $data->id_anggota }}">Detail</button>
                                                </td>
                                            </tr>
                                            @php
                                                $idAnggotaArr[] = $data->id_anggota;
                                            @endphp
                                        @endif
                                    @endforeach
                                </tbody>


                                {{-- <tbody>
                                    @foreach ($pengembalian as $i => $data)
                                        @if ($i == 0 || $data->id_anggota != $pengembalian[$i - 1]->id_anggota)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $data->nama }}</td>
                                                <td>{{ $data->no_isbn }}</td>
                                                <td>{{ $data->judul_buku }}</td>
                                                <td>{{ $data->qty }}</td>
                                                <td>{{ date('d F Y', strtotime($data->tanggal_pengembalian)) }}</td>
                                                <td>{{ $data->jumlah_hari_terlambat }} Hari</td>
                                                <td>Rp. {{ number_format($data->denda) }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#detailModal-{{ $data->id_anggota }}">Detail</button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Detail -->
    @foreach ($pengembalian as $i => $data)
        @if ($i == 0 || $data->id_anggota != $pengembalian[$i - 1]->id_anggota)
            <div class="modal fade" id="detailModal-{{ $data->id_anggota }}" tabindex="-1" role="dialog"
                aria-labelledby="detailModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel">Daftar Data Buku Yang Telah Di Kembalikan Anggota
                                - {{ $data->nama }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body">
                                <table class="table table-striped tableDetailPengembalian">
                                    <thead>
                                        <tr>
                                            <th>No Isbn</th>
                                            <th>Judul Buku</th>
                                            <th>Jumlah Di Kembalikan</th>
                                            <th>Tgl Pengembalian</th>
                                            <th>Terlambat (Hari)</th>
                                            <th>Denda</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pengembalian as $j => $detail)
                                            @if ($detail->id_anggota == $data->id_anggota)
                                                <tr>
                                                    <td>{{ $detail->no_isbn }}</td>
                                                    <td>{{ $detail->judul_buku }}</td>
                                                    <td>{{ $detail->qty }}</td>
                                                    <td>{{ date('d F Y', strtotime($detail->tanggal_pengembalian)) }}
                                                    </td>
                                                    <td>{{ $detail->jumlah_hari_terlambat }}
                                                        Hari</td>
                                                    <td>Rp.
                                                        {{ number_format($detail->denda) }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td><strong>Total Hari Terlambat:</strong></td>
                                            <td><strong>{{ $pengembalian->where('id_anggota', $data->id_anggota)->sum('jumlah_hari_terlambat') }}
                                                    Hari</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td><strong>Total Denda:</strong></td>
                                            <td><strong>Rp.
                                                    {{ number_format($pengembalian->where('id_anggota', $data->id_anggota)->sum('denda')) }}</strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
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
    <script>
        $(document).ready(function() {
            $('.tableDetailPengembalian').DataTable();
        });
    </script>
@endpush
