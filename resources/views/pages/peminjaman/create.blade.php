@extends('layouts.main')

@section('title', 'Create Buku')

@section('content')
    <div class="row">
        <div class="col-md-12">

            {{-- Alert Here --}}
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Transaksi Peminjaman Buku</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST" action="{{ route('peminjaman.store') }}" id="forms">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="title">Nama Anggota Yang Akan Meminjam Buku</label>
                                <select name="id_anggota_peminjaman" id="" class="form-control select2" required>
                                    <option value="" selected disabled>--Pilih Anggota--</option>
                                    @foreach ($anggota as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }} | {{ $item->nisn }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_anggota_peminjaman')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- <div class="form-group col-md-4">
                                <label for="tgl_pinjam">Tanggal Peminjaman</label>
                                <input type="date" name="tgl_pinjam" value="{{ old('tgl_pinjam') }}" class="form-control"
                                    required>

                                @error('tgl_pinjam')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="tgl_kembali">Tanggal Kembali</label>
                                <input type="date" name="tgl_kembali" value="{{ old('tgl_kembali') }}"
                                    class="form-control" required>

                                @error('tgl_kembali')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}
                        </div>
                        <div class="card">
                            <div class="card-header bg-danger">
                                Peminjaman Buku
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="">Nomor Isbn Buku</label>
                                        <div class="input-group mb-3">
                                            <input type="hidden" id="id" class="form-control" name="id"
                                                required>
                                            <input type="text" id="isbn" class="form-control" name="isbn"
                                                placeholder="Ex : ISBN ***">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary" type="button" data-toggle="modal"
                                                    data-target="#modalBuku">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Judul Buku</label>
                                        <input type="text" readonly id="judul" class="form-control" name="judul">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Jumlah Buku</label>
                                        <input type="number" class="form-control" name="jumlah" id="jumlah">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">#</label>
                                        <div class="input-group">
                                            <a href="#" id="simpan-temp" class="btn btn-primary btn-sm mr-2"
                                                title="Simpan Item">
                                                <i class="fa fa-save"></i>
                                            </a>

                                            <a href="#" class="btn btn-danger btn-sm mr-2" id="hapusAll"><i
                                                    class="fas fa-trash" title="Hapus Semua Item"></i>
                                                Item</a>

                                            <button type="submit" class="btn btn-success btn-sm" id="proses"><i
                                                    class="fas fa-save"></i>
                                                Simpan</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- <div class="row">
                            <div class="form-group col-md-3">
                                <label for="">Nomor Isbn Buku</label>
                                <input type="hidden" id="id" class="form-control" name="id" required>
                                <input type="text" id="isbn" class="form-control" name="isbn"
                                    placeholder="Ex : ISBN ***">
                            </div>

                            <div class="form-group col-md-1">
                                <div class="form-group">
                                    <label for="" style="visibility: hidden;">Isbn Buku</label>
                                    <button type="button" class="btn btn-warning btn-sm align-items-center"
                                        data-toggle="modal" data-target="#modalBuku"><i class="fas fa-search"></i>
                                        Cari</button>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="">Judul Buku</label>
                                <input type="text" readonly id="judul" class="form-control" name="judul">
                            </div>


                            <div class="form-group col-md-1">
                                <label for="">Jumlah Buku</label>
                                <input type="number" class="form-control" name="jumlah" id="jumlah">
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="" style="visibility: hidden;">Kode</label>
                                    <a href="#" id="simpan-temp" class="btn btn-primary btn-sm">
                                        + Item
                                    </a>

                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="" style="visibility: hidden;">Kode</label>
                                    <a href="#" class="btn btn-danger btn-sm" id="hapusAll"><i
                                            class="fas fa-trash"></i>
                                        Item</a>
                                    <button class="btn btn-danger btn-sm" id="hapusAll">
                                        <i class="fas fa-trash"> Item</i>
                                    </button>
                                </div>
                            </div>


                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="" style="visibility: hidden;">Kode</label>
                                    <button type="submit" class="btn btn-success btn-sm" id="proses"><i
                                            class="fas fa-save"></i>
                                        Proses</button>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </form>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table" id="table-detail">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Isbn</th>
                                        <th>Judul</th>
                                        <th>Jumlah</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody id="table1"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade bd-example-modal-sm" id="confirmasiItem" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Yakin Hapus Data Ini ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger btn-sm" name="hapusItem" id="hapusItem">Hapus</button>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="modal fade bd-example-modal-sm" id="confirmasiAll" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Yakin Hapus Semua Data ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger btn-sm" name="hapusAllOk" id="hapusAllOk">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modalBuku" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Data Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered" id="table">
                        <thead>
                            <th width="1%">No</th>
                            <th>Isbn</th>
                            <th>Judul</th>
                            <th>Tahun Terbit</th>
                            <th>Jumlah</th>
                            <th>#</th>
                        </thead>
                        <tbody>
                            @foreach ($buku as $i => $data)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $data->no_isbn }}</td>
                                    <td>{{ $data->judul_buku }}</td>
                                    <td>{{ $data->tahun_terbit }}</td>
                                    <td>{{ $data->jumlah_buku }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" id="pilih"
                                            data-id="{{ $data->id }}" data-isbn="{{ $data->no_isbn }}"
                                            data-judul="{{ $data->judul_buku }}"
                                            data-jumlah-buku="{{ $data->jumlah_buku }}">
                                            <i class="fas fa-mouse-pointer"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-script')
    <script>
        $(document).ready(function() {
            load()
            $('#table').DataTable();
            $('#table-temp').DataTable();
            $('#proses').hide();
            $('.select2').select2();
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#pilih', function() {
                var item_id = $(this).data('id');
                var item_isbn = $(this).data('isbn');
                var item_judul = $(this).data('judul');
                $('#id').val(item_id);
                $('#isbn').val(item_isbn);
                $('#judul').val(item_judul);
                $('#jumlah').focus();
                $('#modalBuku').modal('hide');
            })
        });
    </script>


    {{-- <script>
        $(document).ready(function() {
            $(document).on('click', '#hapusItem', function() {
                $('#confirmasiItem').modal('hide');
            });

            $('#hapusItem').click(function() {
                $.ajax({
                    url: 'hapus-temp-item' + id,
                    method: 'GET',
                    dataType: 'JSON',

                    beforeSend: function() {
                        $('#hapusItem').text('Deleting...');
                    },

                    success: function(response) {
                        if (response.success == 200) {
                            $('#confirmasiItem').modal('hide');
                            load()
                        } else {
                            alert('Oppzz... Periksa Kembali Inputan');
                        }
                    }
                });
            });
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            $(document).on('click', '#hapusAll', function() {
                $('#confirmasiAll').modal('show');
            });

            $('#hapusAllOk').click(function() {
                $.ajax({
                    url: '{{ route('hapus-temp-all') }}',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.success == 200) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Semua Data Temporary Berhasil Dihapus',
                                showConfirmButton: false,
                                timer: 2500
                            })
                            $('#confirmasiAll').modal('hide');
                            load()
                        } else {
                            alert('Oppzz... Periksa Kembali Inputan');
                        }
                    }
                });
            });

        })
    </script>

    <script>
        $(document).ready(function() {
            $('#simpan-temp').click(simpanTemp);
        })

        function load() {
            $('#table1').load('panggil-temp');
        }

        function kosong() {
            $('#isbn').val('');
            $('#judul').val('');
            $('#jumlah').val('');
        }

        function simpanTemp() {
            // var id = $(this).data('id');
            var jumlah_buku = $(this).data('jumlah-buku');
            var isbn = $('#isbn').val();
            var judul = $('#judul').val();
            var jumlah = $('#jumlah').val();


            if (jumlah >= jumlah_buku) {
                alert('Stock Buku Tidak Mencukupi');
            }

            if (isbn == '') {
                alert('Isbn Buku harus diisi');
            } else if (judul == '') {
                alert('Judul Buku harus diisi');
            } else if (jumlah == '') {
                alert('Jumlah Buku harus diisi');
            } else {
                $.ajax({
                    method: 'POST',
                    url: '{{ route('simpan-temp') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'isbn': isbn,
                        'judul': judul,
                        'jumlah': jumlah,
                    },
                    dataType: 'json',
                    cache: false,
                    success: function(response) {
                        console.log(response);
                        if (response.success == 200) {
                            kosong()
                            load()
                            $('#proses').show();
                        } else {
                            alert('Oppzz... Periksa Kembali Inputan');
                        }
                    }

                });
            }
        };
    </script>
@endpush
