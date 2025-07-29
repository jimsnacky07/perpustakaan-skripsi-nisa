@extends('layouts.main')

@section('title', '')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Grafik Statistik</h3>
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bulan">Bulan:</label>
                            <select class="form-control" id="bulan">
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahun">Tahun:</label>
                            <select class="form-control" id="tahun">
                                @for ($year = date('Y'); $year >= 2000; $year--)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary btnBulan" onclick="viewGrafikPinjam()">View</button>
                    </div>
                </div>
                </div>
            </div>
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Grafik Peminjaman Buku</h3>
            </div>
            <div class="card-body viewTampilGrafik ">
                
            </div>
        </div>
        </div>
    </div>
@endsection
@push('after-script')
    <script>
        function viewGrafikPinjam() {
        let bulan = $('#bulan').val();
        let tahun = $('#tahun').val();
        let tipe = $('#tipe').val();

        if (bulan == '') {
            toastr.error('Bulan Belum Dipilih !!!');
        } else if (tahun == '') {
            toastr.error('Tahun Belum Dipilih !!!');
        } else {
            $.ajax({
                type: "post",
                url: "{{ route('view-grafik-pinjam') }}",
                data: {
                    _token: "{{ csrf_token() }}", // Menambahkan CSRF token
                    bulan: bulan,
                    tahun: tahun,
                    tipe: tipe
                },
                dataType: "json",
                beforeSend: function() {
                    $('.btnBulan').html('<i class="fas fa-spin fa-spinner"></i>');
                },

                complete: function() {
                    $('.btnBulan').html('View');

                },

                success: function(response) {
                    if (response.data) {
                        $('.viewTampilGrafik').html(response.data);


                    }
                },

                error: function(e) {
                    alert('Error \n' + e.responseText);
                }
            });

        }
    }
    </script>
@endpush
