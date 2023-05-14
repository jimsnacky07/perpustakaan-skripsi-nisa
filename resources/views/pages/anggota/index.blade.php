@extends('layouts.main')

@section('title', 'Data Anggota')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Anggota</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a href="{{ route('anggota.create') }}" class="btn btn-warning"><i class="fas fa-plus-square">
                                    Tambah Data Anggota</i>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>NISN</th>
                                        <th>Nama</th>
                                        <th>Kelamin</th>
                                        <th>HP</th>
                                        <th>Alamat</th>
                                        <th>Email</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anggota as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nisn }}</td>
                                            <td>{{ $item->nama }}</td>

                                            <td>
                                                @if ($item->jk == 'L')
                                                    Laki - Laki
                                                @else
                                                    Perempuan
                                                @endif
                                            </td>
                                            <td>{{ $item->no_hp }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->user->email }}</td>
                                            <td>
                                                <a href="{{ route('anggota.edit', $item->id) }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt">
                                                    </i></a>

                                                {{-- <a href="{{ route('anggota.show', $item->id) }}"
                                                    class="btn btn-dark btn-sm"><i class="fas fa-eye">
                                                    </i></a> --}}

                                                <form action="{{ route('anggota.destroy', $item->id) }}" method="POST"
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
    </script>
@endpush
