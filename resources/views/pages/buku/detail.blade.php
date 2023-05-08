@extends('layouts.main')

@section('title', 'Detail Buku')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="justify-content-around">
                            <h5>Detail Data Buku</h5>
                            <a href="{{ route('buku.index') }}" class="btn btn-primary"><i class="fas fa-backward"></i>
                                Back</a>
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table">
                            <thead>
                                <th width="1%">No</th>
                                <th>Kategori</th>
                                <th>Judul</th>
                                <th>Penerbit</th>
                                <th>Pengarang</th>
                                <th>Nomor Isbn</th>
                                <th>Tahun</th>
                                <th>Jumlah</th>
                                <th>Rak</th>
                            </thead>
                            <tbody>
                                @foreach ($buku as $no => $data)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->judul_buku }}</td>
                                        <td>{{ $data->penerbit_buku }}</td>
                                        <td>{{ $data->pengarang_buku }}</td>
                                        <td>{{ $data->no_isbn }}</td>
                                        <td>{{ $data->tahun_terbit }}</td>
                                        <td>{{ $data->jumlah_buku }}</td>
                                        <td>{{ $data->nama_rak }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endpush
