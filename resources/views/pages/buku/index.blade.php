@extends('layouts.main')

@section('title', 'Data Buku')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Buku</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a href="{{ route('buku.create') }}" class="btn btn-warning"><i class="fas fa-plus-square">
                                    Create Buku</i>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Kategori</th>
                                        <th>Judul</th>
                                        <th>Tahun</th>
                                        <th>Jumlah</th>
                                        <th>Gambar</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($buku as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->judul_buku }}</td>
                                            <td>{{ $item->tahun_terbit }}</td>
                                            <td>{{ $item->jumlah_buku }}</td>
                                            <td><img src="{{ Storage::url('public/buku/' . $item->gambar) }} "
                                                    alt="" width="50" class="img-thumbnail"></td>
                                            <td>

                                                <a href="{{ route('buku.edit', $item->id) }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt">
                                                    </i></a>

                                                <a href="{{ route('buku.show', $item->id) }}"
                                                    class="btn btn-dark btn-sm"><i class="fas fa-eye">
                                                    </i></a>

                                                <form action="{{ route('buku.destroy', $item->id) }}" method="POST"
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
            $('#example2').DataTable();
        });

        $('#release-date').datetimepicker({
            format: 'YYYY-MM-DD'
        })
    </script>
@endpush
