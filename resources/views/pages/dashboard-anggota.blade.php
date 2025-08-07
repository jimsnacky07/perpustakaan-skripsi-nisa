@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
            <div class="card bg-blue-1 text-white rounded-4 shadow-lg border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="fs-3 fw-bold mb-0">{{ $countBuku }}</h4>
                            <p class="text-white-50 mb-0">Jumlah Buku</p>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book-open fa-2x"></i>
                        </div>
                    </div>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </div>

        <div class="col">
            <div class="card bg-blue-2 text-white rounded-4 shadow-lg border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="fs-3 fw-bold mb-0">{{ $countJenisBuku }}</h4>
                            <p class="text-white-50 mb-0">Kategori Buku</p>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bookmark fa-2x"></i>
                        </div>
                    </div>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </div>

        <div class="col">
            <div class="card bg-blue-3 text-white rounded-4 shadow-lg border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="fs-3 fw-bold mb-0">{{ $jumlahBukuDipinjam }}</h4>
                            <p class="text-white-50 mb-0">Jumlah Buku Dipinjam</p>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book-reader fa-2x"></i>
                        </div>
                    </div>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </div>

        <div class="col">
            <div class="card bg-blue-4 text-white rounded-4 shadow-lg border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="fs-3 fw-bold mb-0">{{ $jumlahBukuDiKembalikan }}</h4>
                            <p class="text-white-50 mb-0">Jumlah Buku Dikembalikan</p>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book-dead fa-2x"></i>
                        </div>
                    </div>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <div class="card bg-blue-info rounded-4 shadow-lg border-0 mt-4">
        <div class="container p-4">
            <h5 class="text-white">
                <i class="fas fa-info-circle me-2"></i> Informasi Aturan Peminjaman Buku
            </h5>
            <ol class="text-white-50 small">
                <li>Waktu peminjaman maksimal 3 bulan.</li>
                <li>Setiap anggota hanya dapat meminjam maksimal 10 kali atau 10 buku.</li>
                <li>Jika terlambat mengembalikan buku, dikenakan denda Rp.1.000 per hari.</li>
                <li>Konfirmasi dan bukti peminjaman diperlukan saat pengembalian buku.</li>
                <li>Denda harus dibayar saat mengembalikan buku terlambat.</li>
                <li>Bawa bukti peminjaman saat mengembalikan buku.</li>
            </ol>
        </div>
    </div>
@endsection

@push('before-style')
    <style>
        .card {
            position: relative;
            overflow: hidden;
            border-radius: 1.25rem;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(to bottom right, rgba(255,255,255,0.07), rgba(0,0,0,0.1));
            opacity: 0.5;
            transition: opacity 0.4s ease;
            z-index: -1;
        }

        .card:hover::before {
            opacity: 0.3;
        }

        .fa {
            transition: transform 0.3s ease-in-out;
        }

        .card:hover .fa {
            transform: scale(1.15);
        }

        .bg-blue-1 {
            background: linear-gradient(135deg, #3a7bd5, #00d2ff);
        }

        .bg-blue-2 {
            background: linear-gradient(135deg, #2b5876, #4e4376);
        }

        .bg-blue-3 {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
        }

        .bg-blue-4 {
            background: linear-gradient(135deg, #1488cc, #2b32b2);
        }

        .bg-blue-info {
            background: linear-gradient(135deg, #283c86, #45a247);
        }

        .text-white {
            color: #fff !important;
        }

        .text-white-50 {
            color: rgba(255, 255, 255, 0.85) !important;
        }
    </style>
@endpush
