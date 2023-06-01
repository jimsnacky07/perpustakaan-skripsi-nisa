@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="row mb-3">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 bg-gradient-primaryr">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-uppercase mb-1 text-light">Jumlah Buku</div>
                            <div class="text-sm text-light h5 mb-0 font-weight-bold">{{ $countBuku }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-book text-light fa-3x" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 bg-gradients-info">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm text-light font-weight-bold text-uppercase mb-1">Kategori Buku</div>
                            <div class="text-sm text-light h5 mb-0 font-weight-bold">{{ $countJenisBuku }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-bookmark  text-light fa-3x" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 bg-gradients-warning">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm text-light font-weight-bold text-uppercase mb-1">Jumlah Buku Di Pinjam</div>
                            <div class="text-sm text-light h5 mb-0 font-weight-bold">{{ $jumlahBukuDipinjam }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-book text-light fa-3x" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card bg-gradients-secondary">
        <div class="container">
            <h3 class="text-light ms-auto">
                <i class="fa-solid fa-circle-info text-light my-3 ms-3"></i> Informasi Aturan Peminjaman Buku
            </h3>
            <ol class=text-light>
                <li class=text-light>Waktu peminjaman maksimal 3 Bulan.</li>
                <li class=text-light>Setiap anggota hanya dapat meminjam maksimal 10 X Peminjaman / 10 Buku.</li>
                {{-- <li class=text-light>Setiap anggota Tidak Boleh Meminjam Judul Buku Yang Sama.</li> --}}
                <li class=text-light>Jika Pengembalian Buku Lebih Dari Waktu Yang Telah Ditentukan, Maka Akan Diberikan
                    Denda Setiap Buku Rp.1.000/Hari.</li>
                <li class=text-light>Jika Telah Meminjam Buku, Silahkan Pergi Ke Tempat Petugas Untuk Melakukan Konfirmasi
                    dan Pencetakan Bukti Peminjaman.</li>
                <li class=text-light>Jika Terlambat Mengembalikan Buku dan Mendapat denda, Maka Wajib Langsung Membayar Pada
                    Petugas Saat Mengembalikan Buku.</li>
                <li class=text-light>Pada Saat Mau Mengembalikan Buku Jangan Lupa Membawa Bukti Peminjaman / Kartu
                    Perpustakaan.
                </li>
            </ol>
        </div>
    </div>
@endsection
@push('before-style')
    <style>
        .card {
            border-radius: 10px;
            overflow: hidden;
        }

        .ms-auto {
            margin-left: 20px;
        }

        .card .card-body {
            padding: 1.5rem;
        }

        .card .card-body .text-light {
            color: #ffffff;
        }

        .card .card-body .font-weight-bold {
            font-weight: bold;
        }

        .card .card-body .fa-3x {
            font-size: 3rem;
        }

        .bg-gradient-primaryr {
            background: linear-gradient(to right, #4e73df, #224abe);
        }

        .bg-gradients-info {
            background: linear-gradient(to right, #36b9cc, #1a8eac);
        }

        .bg-gradients-warning {
            background: linear-gradient(to right, #f5d144, #f6c419);
        }

        .bg-gradients-secondary {
            background: linear-gradient(to right, #858796, #343a40);
        }

        .bg-gradients-secondary h3 {
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .bg-gradients-secondary ol li {
            margin-bottom: 0.5rem;
        }
    </style>
@endpush
