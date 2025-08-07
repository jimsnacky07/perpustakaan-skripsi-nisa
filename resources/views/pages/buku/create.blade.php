@extends('layouts.main')

@section('title', 'Create Buku')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Input Data Buku</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="{{ route('buku.store') }}" id="formBuku">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="jenis_buku_id">Kategori Buku <span class="text-danger">*</span></label>
                            <select name="jenis_buku_id" id="jenis_buku_id"
                                class="form-control @error('jenis_buku_id') is-invalid @enderror" required>
                                <option value="" selected disabled>--Pilih Kategori Buku--</option>
                                @foreach ($kategori as $item)
                                <option value="{{ $item->id }}" {{ old('jenis_buku_id')==$item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('jenis_buku_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="judul_buku">Judul Buku <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul_buku') is-invalid @enderror"
                                id="judul_buku" name="judul_buku" placeholder="Ex : IPA" value="{{ old('judul_buku') }}"
                                maxlength="255" required>

                            @error('judul_buku')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="no_isbn">Nomor ISBN Buku <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('no_isbn') is-invalid @enderror" id="no_isbn"
                                name="no_isbn" placeholder="Ex : 978-602-8519-93-9" value="{{ old('no_isbn') }}"
                                pattern="[0-9\-]+" title="Hanya angka dan tanda strip" required>

                            @error('no_isbn')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="penerbit_buku">Penerbit Buku <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('penerbit_buku') is-invalid @enderror"
                                id="penerbit_buku" name="penerbit_buku" placeholder="Ex : ARIL"
                                value="{{ old('penerbit_buku') }}" maxlength="255" required>

                            @error('penerbit_buku')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label>Tahun Terbit <span class="text-danger">*</span></label>
                            <div class="input-group date" id="release-date" data-target-input="nearest">
                                <input type="text" name="tahun_terbit"
                                    class="form-control datetimepicker-input @error('tahun_terbit') is-invalid @enderror"
                                    data-target="#release-date" value="{{ old('tahun_terbit') }}" required />
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
                            <label for="pengarang_buku">Pengarang Buku <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('pengarang_buku') is-invalid @enderror"
                                id="pengarang_buku" name="pengarang_buku" placeholder="Ex : Adinul"
                                value="{{ old('pengarang_buku') }}" maxlength="255" required>
                            @error('pengarang_buku')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="rak_buku_id">Rak Buku <span class="text-danger">*</span></label>
                            <select name="rak_buku_id" id="rak_buku_id"
                                class="form-control @error('rak_buku_id') is-invalid @enderror" required>
                                <option value="" selected disabled>--Pilih Rak Buku--</option>
                                @foreach ($rak as $item)
                                <option value="{{ $item->id }}" {{ old('rak_buku_id')==$item->id ? 'selected' : '' }}>
                                    {{ $item->no_rak }} | {{ $item->nama_rak }}
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
                            <label for="jumlah_buku">Jumlah Buku <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('jumlah_buku') is-invalid @enderror"
                                id="jumlah_buku" name="jumlah_buku" placeholder="Ex : 10"
                                value="{{ old('jumlah_buku') }}" min="0" required>
                            @error('jumlah_buku')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="gambar">Gambar / Sampul Buku <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar"
                                id="gambar" accept="image/*" required>
                            <small class="form-text text-muted">Format: PNG, JPG, JPEG. Maksimal 2MB</small>
                            @error('gambar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Preview Gambar -->
                    <div class="row" id="preview-container" style="display: none;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Preview Gambar:</label>
                                <img id="image-preview" src="" alt="Preview" class="img-thumbnail"
                                    style="max-width: 200px; max-height: 200px;">
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="btnSubmit">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                    <button type="reset" class="btn btn-secondary">Batal</button>
                    <a href="{{ route('buku.index') }}" class="btn btn-warning">
                        <i class="fas fa-backward"></i> Kembali
                    </a>
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

@if (session('error') == true)
<script>
    Swal.fire({
                position: 'center',
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2500
            })
</script>
@endif

<script>
    $(document).ready(function() {
            // Date picker untuk tahun
            $('#release-date').datetimepicker({
                format: 'YYYY',
                viewMode: 'years',
                minDate: '1900',
                maxDate: moment().add(1, 'year')
            });

            // Preview gambar
            $('#gambar').change(function() {
                const file = this.files[0];
                if (file) {
                    // Validasi ukuran file (2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar. Maksimal 2MB.');
                        this.value = '';
                        return;
                    }

                    // Validasi tipe file
                    if (!file.type.match('image.*')) {
                        alert('File harus berupa gambar.');
                        this.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image-preview').attr('src', e.target.result);
                        $('#preview-container').show();
                    }
                    reader.readAsDataURL(file);
                } else {
                    $('#preview-container').hide();
                }
            });

            // Validasi form sebelum submit
            $('#formBuku').submit(function(e) {
                const tahunTerbit = $('input[name="tahun_terbit"]').val();
                const jumlahBuku = $('#jumlah_buku').val();
                const isbn = $('#no_isbn').val();

                // Validasi tahun terbit
                if (tahunTerbit < 1900 || tahunTerbit > new Date().getFullYear() + 1) {
                    e.preventDefault();
                    alert('Tahun terbit harus antara 1900 dan ' + (new Date().getFullYear() + 1));
                    return false;
                }

                // Validasi jumlah buku
                if (jumlahBuku < 0) {
                    e.preventDefault();
                    alert('Jumlah buku tidak boleh negatif');
                    return false;
                }

                // Validasi ISBN (minimal 10 karakter)
                if (isbn.length < 10) {
                    e.preventDefault();
                    alert('ISBN harus minimal 10 karakter');
                    return false;
                }

                // Disable button untuk mencegah double submit
                $('#btnSubmit').prop('disabled', true);
                $('#btnSubmit').html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
            });

            // Reset preview saat form di-reset
            $('button[type="reset"]').click(function() {
                $('#preview-container').hide();
                $('#btnSubmit').prop('disabled', false);
                $('#btnSubmit').html('<i class="fa fa-save"></i> Simpan');
            });
        });
</script>
@endpush