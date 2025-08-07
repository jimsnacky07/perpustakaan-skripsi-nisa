@extends('layouts.main')

@section('title', 'Create Data Anggota')

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
                <h3 class="card-title">Form Input Data Anggota</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="{{ route('anggota.store') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="title">User</label>
                            <select name="user_id" id="" class="form-control @error('user_id') is-invalid  @enderror"
                                autofocus>
                                <option value="" selected disabled>--Pilih User--</option>
                                @foreach ($user as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn"
                                name="nisn" placeholder="Ex : 12121" value="{{ old('nisn') }}"
                                onkeypress="return onlyNumber(event)" maxlength="10">

                            @error('nisn')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" placeholder="Ex : Masukkan Nama Lengkap" value="{{ old('nama') }}">

                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="title">Jenis Kelamin</label>
                            <select name="jk" id="" class="form-control">
                                <option value="" selected disabled>--Pilih Jenis Kelamin--</option>
                                <option value="L">Laki - Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            @error('jk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="short-about">No Handphone</label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                name="no_hp" placeholder="08312444" value="{{ old('no_hp') }}">
                            @error('no_hp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                name="alamat" placeholder="Ex : Jl...." value="{{ old('alamat') }}">

                            @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>



                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="short-about">Kelas</label>
                            <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas"
                                name="kelas" placeholder="Ex : 10-12A" value="{{ old('kelas') }}">
                            @error('kelas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- <div class="form-group col-md-4">
                            <label for="foto">foto</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                                name="foto" accept="image/*">

                            @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div> --}}



                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Batal</button>
                    <a href="{{ route('anggota.index') }}" class="btn btn-warning"><i class="fas fa-backward"></i>
                        Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('after-script')
<script>
    function onlyNumber(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        }
        
        $(document).ready(function() {
            // Validasi NISN (10 digit)
            $('#nisn').on('input', function() {
                const nisn = $(this).val();
                if (nisn.length !== 10) {
                    $(this).addClass('is-invalid');
                    if (!$(this).next('.invalid-feedback').length) {
                        $(this).after('<div class="invalid-feedback">NISN harus 10 digit angka</div>');
                    }
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).next('.invalid-feedback').remove();
                }
            });
            
            // Validasi nomor HP
            $('#no_hp').on('input', function() {
                const noHp = $(this).val();
                
                if (noHp.length < 10 || noHp.length > 15) {
                    $(this).addClass('is-invalid');
                    if (!$(this).next('.invalid-feedback').length) {
                        $(this).after('<div class="invalid-feedback">Nomor HP harus 10-15 digit</div>');
                    }
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).next('.invalid-feedback').remove();
                }
            });
            
            // Validasi form sebelum submit
            $('form').submit(function(e) {
                const nisn = $('#nisn').val();
                const noHp = $('#no_hp').val();
                const nama = $('#nama').val();
                const jk = $('select[name="jk"]').val();
                const alamat = $('#alamat').val();
                const kelas = $('#kelas').val();
                const userId = $('select[name="user_id"]').val();
                
                // Validasi NISN
                if (nisn.length !== 10) {
                    e.preventDefault();
                    Swal.fire('Error', 'NISN harus 10 digit angka', 'error');
                    return false;
                }
                
                // Validasi nomor HP
                if (noHp.length < 10 || noHp.length > 15) {
                    e.preventDefault();
                    Swal.fire('Error', 'Nomor HP harus 10-15 digit', 'error');
                    return false;
                }
                
                // Validasi field required
                if (!nama || !jk || !alamat || !kelas || !userId) {
                    e.preventDefault();
                    Swal.fire('Error', 'Semua field harus diisi', 'error');
                    return false;
                }
                
                // Konfirmasi sebelum submit
                if (!confirm('Apakah Anda yakin ingin menyimpan data anggota ini?')) {
                    e.preventDefault();
                    return false;
                }
            });
        });
</script>
@endpush