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
                        <div class="col-md-12 mb-3">
                            <a href="{{ route('peminjaman') }}" class="btn btn-primary"><i class="fas fa-backward"></i>
                                Kembali</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-left">
                                        <h5>Detail Data Peminjaman</h5>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <table class="table table-striped" id="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Isbn</th>
                                                <th>Judul Buku</th>
                                                <th>Pengarang</th>
                                                <th>Penerbit</th>
                                                <th>Tahun Terbit</th>
                                                <th>Jumlah Buku Di Pinjam</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detail as $no => $data)
                                                <tr>
                                                    <td>{{ $no + 1 }}</td>
                                                    <td>{{ $data->isbn_buku }}</td>
                                                    <td>{{ $data->judul_buku }}</td>
                                                    <td>{{ $data->pengarang_buku }}</td>
                                                    <td>{{ $data->penerbit_buku }}</td>
                                                    <td>{{ $data->tahun_terbit }}</td>
                                                    <td>{{ $data->jumlah_buku_pinjam }}</td>
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
        </div>
    </div>
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
