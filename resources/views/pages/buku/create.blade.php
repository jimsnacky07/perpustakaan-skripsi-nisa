@extends('layouts.main')

@section('title', 'Create Buku')

@section('content')
    <div class="row">
        <div class="col-md-12">

            {{-- Alert Here --}}

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Input Data Buku</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST" action="{{ route('buku.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="title">Kategori Buku</label>
                                <select name="jenis_buku_id" id="" class="form-control">
                                    <option value="" selected disabled>--Pilih Kategori Buku--</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_buku_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="judul_buku">Judul Buku</label>
                                <input type="text" class="form-control @error('judul_buku') is-invalid @enderror"
                                    id="judul_buku" name="judul_buku" placeholder="Ex : IPA"
                                    value="{{ old('judul_buku') }}">

                                @error('judul_buku')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="no_isbn">Nomor ISBN Buku</label>
                                <input type="text" class="form-control @error('no_isbn') is-invalid @enderror"
                                    id="no_isbn" name="no_isbn" placeholder="Ex : ISBN 978-602-8519-93-9"
                                    value="{{ old('no_isbn') }}">

                                @error('no_isbn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="penerbit_buku">Penerbit Buku</label>
                                <input type="text" class="form-control @error('penerbit_buku') is-invalid @enderror"
                                    id="penerbit_buku" name="penerbit_buku" placeholder="Ex : UDIN"
                                    value="{{ old('penerbit_buku') }}">

                                @error('penerbit_buku')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label>Tahun Terbit:</label>
                                <div class="input-group date" id="release-date" data-target-input="nearest">
                                    <input type="text" name="tahun_terbit"
                                        class="form-control datetimepicker-input @error('tahun_terbit') is-invalid @enderror"
                                        data-target="#release-date" value="{{ old('tahun_terbit') }}" />
                                    <div class="input-group-append" data-target="#release-date"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    @error('tahun_terbit')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="short-about">Pengarang Buku</label>
                                <input type="text" class="form-control @error('pengarang_buku') is-invalid @enderror"
                                    id="pengarang_buku" name="pengarang_buku" placeholder="Jackie Chan"
                                    value="{{ old('pengarang_buku') }}">
                                @error('pengarang_buku')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="title">Rak Buku</label>
                                <select name="rak_buku_id" id="" class="form-control">
                                    <option value="" selected disabled>--Pilih Kategori Buku--</option>
                                    @foreach ($rak as $item)
                                        <option value="{{ $item->id }}">{{ $item->no_rak }} | {{ $item->nama_rak }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rak_buku_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="short-about">Jumlah Buku</label>
                                <input type="text" class="form-control @error('jumlah_buku') is-invalid @enderror"
                                    id="jumlah_buku" name="jumlah_buku" placeholder="Awesome Movie"
                                    value="{{ old('jumlah_buku') }}">
                                @error('jumlah_buku')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="form-group col-md-4">
                                <label for="small-thumbnail">Gambar / Sampul Buku</label>
                                <input type="file" class="form-control" name="gambar">
                            </div>


                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                        <button type="reset" class="btn btn-secondary">Batal</button>
                        <a href="{{ route('buku.index') }}" class="btn btn-warning"><i class="fas fa-backward"></i>
                            Kembali</a>
                    </div>
                </form>
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
        $('#release-date').datetimepicker({
            format: 'YYYY'
        })
    </script>
@endpush
