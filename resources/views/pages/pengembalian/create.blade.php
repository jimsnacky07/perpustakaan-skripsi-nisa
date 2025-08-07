@extends('layouts.main')

@section('title', 'Create Buku')

@section('content')
<div class="row">
    <div class="col-md-12">

        {{-- Alert Here --}}


        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Transaksi Pengembalian Buku</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="{{ route('pengembalian.store') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="title">Nama Anggota Yang Akan Mengembalikan Buku</label>
                            <select name="id_anggota" id="id_anggota" class="form-control select2" required>
                                <option value="" selected disabled>--Pilih Anggota--</option>
                                @foreach ($anggota as $item)
                                <option value="{{ $item->id_anggota_peminjaman }}">{{ $item->nama }} | {{ $item->nisn }}</option>
                                @endforeach
                            </select>
                            @error('id_anggota')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-primary">
                            <b>
                                Pengembalian Buku

                            </b>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="">Buku Yang Dipinjam</label>
                                    <select name="id" id="id_buku" class="form-control select2" required disabled>
                                        <option value="" selected disabled>--Pilih Anggota Terlebih Dahulu--</option>
                                    </select>
                                    @error('id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">Judul Buku</label>
                                    <input type="text" readonly id="judul" class="form-control" name="judul">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Jumlah Buku</label>
                                    <input type="number" class="form-control" name="jumlah" id="jumlah" readonly>
                                </div>

                                <div class="form-group col-md-1">
                                    <label for="" style="visibility: hidden">Kode Peminjaman</label>
                                    <input type="hidden" class="form-control" name="id_peminjaman" id="id_peminjaman"
                                        readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">#</label>
                                    <div class="input-group">

                                        <button type="submit" class="btn btn-primary" id="proses"><i
                                                class="fas fa-save"></i>
                                            Simpan</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('after-script')
<script>
    $(document).ready(function() {
            $('.select2').select2();
            
            // Event ketika anggota dipilih
            $('#id_anggota').change(function() {
                const anggotaId = $(this).val();
                if (anggotaId) {
                    // Ambil buku yang dipinjam oleh anggota ini
                    $.ajax({
                        url: '{{ route("pengembalian.getBukuDipinjam") }}',
                        method: 'GET',
                        data: { anggota_id: anggotaId },
                        dataType: 'json',
                        success: function(response) {
                            const bukuSelect = $('#id_buku');
                            bukuSelect.empty();
                            bukuSelect.append('<option value="" selected disabled>--Pilih Buku--</option>');
                            
                            if (response.length > 0) {
                                response.forEach(function(buku) {
                                    bukuSelect.append(`<option value="${buku.id}" 
                                        data-judul="${buku.judul_buku}" 
                                        data-jumlah="${buku.jumlah_buku}" 
                                        data-tgl-kembali="${buku.tgl_kembali}"
                                        data-id-peminjaman="${buku.id_peminjaman}">
                                        ${buku.judul_buku} (${buku.jumlah_buku} buku)
                                    </option>`);
                                });
                                bukuSelect.prop('disabled', false);
                            } else {
                                bukuSelect.append('<option value="" disabled>Tidak ada buku yang dipinjam</option>');
                                Swal.fire('Info', 'Anggota ini tidak memiliki buku yang sedang dipinjam', 'info');
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'Gagal mengambil data buku', 'error');
                        }
                    });
                } else {
                    $('#id_buku').empty().append('<option value="" selected disabled>--Pilih Anggota Terlebih Dahulu--</option>').prop('disabled', true);
                    $('#judul').val('');
                    $('#jumlah').val('');
                    $('#id_peminjaman').val('');
                }
            });
            
            // Event ketika buku dipilih
            $('#id_buku').change(function() {
                const selectedOption = $(this).find('option:selected');
                if (selectedOption.val()) {
                    $('#judul').val(selectedOption.data('judul'));
                    $('#jumlah').val(selectedOption.data('jumlah'));
                    $('#id_peminjaman').val(selectedOption.data('id-peminjaman'));
                } else {
                    $('#judul').val('');
                    $('#jumlah').val('');
                    $('#id_peminjaman').val('');
                }
            });
            
            // Validasi form sebelum submit
            $('form').submit(function(e) {
                const anggotaId = $('#id_anggota').val();
                const bukuId = $('#id_buku').val();
                const jumlah = $('#jumlah').val();
                
                if (!anggotaId) {
                    e.preventDefault();
                    Swal.fire('Error', 'Pilih anggota terlebih dahulu', 'error');
                    return false;
                }
                
                if (!bukuId) {
                    e.preventDefault();
                    Swal.fire('Error', 'Pilih buku terlebih dahulu', 'error');
                    return false;
                }
                
                if (!jumlah || jumlah <= 0) {
                    e.preventDefault();
                    Swal.fire('Error', 'Jumlah pengembalian harus lebih dari 0', 'error');
                    return false;
                }
                
                // Konfirmasi sebelum submit
                if (!confirm('Apakah Anda yakin ingin memproses pengembalian ini?')) {
                    e.preventDefault();
                    return false;
                }
            });
        });
</script>
@endpush