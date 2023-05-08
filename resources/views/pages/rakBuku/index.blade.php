@extends('layouts.main')


@section('title', 'Form Rak Buku')


@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-10">
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target='#addModalRakBuku'>
                                <span class="fas fa-plus-circle"></span>
                                Tambah Data
                            </button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-danger" type="submit" id="deleteAll">
                                <span class="fas fa-trash"></span>
                                Hapus
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 table-responsive">
                            <table id="tableRakBuku" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="main_checkbox" id="main_checkbox">
                                            <label for=""></label>
                                        </th>
                                        <th>No.</th>
                                        <th>Nomor Rak Buku</th>
                                        <th>Nama Rak Buku</th>
                                        <th>Kapasitas</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Add Modal Rak Buku --}}
    @include('pages.rakBuku.addModalRakBuku')

    {{-- Edit Modal Rak Buku --}}
    @include('pages.rakBuku.editModalRakBuku')
@endsection

@push('after-script')
    @include('pages.rakBuku.scripts')
@endpush
