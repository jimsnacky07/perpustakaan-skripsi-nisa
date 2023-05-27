@extends('layouts.main')

@section('title', 'Edit Anggota')


@section('content')
    <div class="row">
        <div class="col-md-12">

            {{-- Alert Here --}}

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Anggota</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST" action="{{ route('anggota.update', $anggota->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="title">User</label>
                                <input type="text" class="form-control @error('user_id') is-invalid @enderror"
                                    id="user_id" name="user_id" placeholder="Ex : 12121"
                                    value="{{ old('user_id', $anggota->user->name) }}" readonly>
                                {{-- <select name="user_id" id="" class="form-control" disabled>
                                    <option value="" selected disabled>--Pilih User--</option>
                                    @foreach ($user as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id == $anggota->user_id) selected @endif>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select> --}}
                                @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="nisn">NISN</label>
                                <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                    id="nisn" name="nisn" placeholder="Ex : 12121"
                                    value="{{ old('nisn', $anggota->nisn) }}" readonly>

                                @error('nisn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" placeholder="Ex : Masukkan Nama Lengkap"
                                    value="{{ old('nama', $anggota->nama) }}">

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
                                    <option value="L" @if ($anggota->jk == 'L') selected @endif>Laki - Laki
                                    </option>
                                    <option value="P" @if ($anggota->jk == 'P') selected @endif>Perempuan
                                    </option>
                                </select>
                                @error('jk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="short-about">No Handphone</label>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                    id="no_hp" name="no_hp" placeholder="081471417"
                                    value="{{ old('no_hp', $anggota->no_hp) }}">
                                @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    id="alamat" name="alamat" placeholder="Ex : Jl...."
                                    value="{{ old('alamat', $anggota->alamat) }}">

                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>



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
