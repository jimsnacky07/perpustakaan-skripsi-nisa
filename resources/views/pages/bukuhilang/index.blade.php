@extends('layouts.main')


@section('title', 'Form Buku Hilang')


@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-10">
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target='#addModalBukuHilang'>
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
                            <table id="tableBukuHilang" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="main_checkbox" id="main_checkbox">
                                            <label for=""></label>
                                        </th>
                                        <th>No.</th>
                                        <th>Judul Buku</th>
                                        <th>Penerbit</th>
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
    {{-- Add Modal Buku Hilang --}}
    @include('pages.bukuhilang.addModalBukuHilang')

    {{-- Edit Modal Buku Hilang --}}
    @include('pages.bukuhilang.editModalBukuHilang')
@endsection

@push('after-script')
    @include('pages.bukuhilang.scripts')
@endpush()
