@extends('layouts.main')

@section('title', 'Data Permintaan Peminjaman Buku')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Permintaan Peminjaman Buku</h3>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="row justify-content-between">
                            <div class="col-md-auto">
                                <button type="button" id="btn-status" class="btn btn-success" style="display: none"><i
                                        class="fa fa-check"></i>
                                    Accept</button>
                            </div>
                            <div class="col-md-auto">
                                <a href="{{ route('peminjaman') }}" class="btn btn-primary"><i class="fas fa-backward">
                                        Kembali</i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <table id="table" class="table table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        {{-- <th width="1%">No</th> --}}
                                        <th><input type="checkbox" id="checked-all"></th>
                                        <th>Nama Peminjam</th>
                                        <th>Kelas</th>
                                        <th>Judul Buku</th>
                                        <th>ISBN Buku</th>
                                        <th>Pengarang Buku</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Tgl Wajib Kembali</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjaman as $item)
                                        <tr>
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td><input type="checkbox" class="change-status" name="ids[]"
                                                    value="{{ $item->id_peminjaman }}">
                                            </td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->kelas }}</td>
                                            <td>{{ $item->judul_buku }}</td>
                                            <td>{{ $item->no_isbn }}</td>
                                            <td>{{ $item->pengarang_buku }}</td>
                                            <td>{{ date('d F Y', strtotime($item->tgl_pinjam)) }}</td>
                                            <td>{{ date('d F Y', strtotime($item->tgl_kembali)) }}</td>
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
            $('#table').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#btn-status').hide();
            $('.change-status').change(function(e) {
                if ($(this).prop('checked')) {
                    $('#btn-status').show();
                }

                if ($(".change-status:checked").length == 0) {
                    $('#btn-status').hide();
                }
            });

            $('#checked-all').click(function(e) {
                if ($(this).is(':checked')) {
                    $('#btn-status').show();
                    $(".change-status").prop('checked', true)
                } else {
                    $('#btn-status').hide();
                    $(".change-status").prop('checked', false)
                }
            });

            $("#btn-status").click(function(e) {
                e.preventDefault();

                var selectedIds = [];

                $(".change-status:checked").each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length > 0) {
                    if (confirm("Apakah Anda yakin ingin mengubah status terpilih?")) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "POST",
                            url: "{{ route('terima-permintaan-peminjaman') }}",
                            data: {
                                ids: selectedIds
                            },
                            dataType: "json",

                            success: function(response) {
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }
                }
            });
        });
    </script>

@endpush
