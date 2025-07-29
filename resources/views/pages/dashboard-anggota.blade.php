@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
            <div class="card bg-gradient-artistic-1 text-white rounded-3 shadow-lg border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="fs-3 fw-bold mb-0">{{ $countBuku }}</h3>
                            <p class="text-white mb-0">Jumlah Buku</p>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book-open fa-3x"></i>
                        </div>
                    </div>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </div>

        <div class="col">
            <div class="card bg-gradient-artistic-2 text-white rounded-3 shadow-lg border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="fs-3 fw-bold mb-0">{{ $countJenisBuku }}</h3>
                            <p class="text-white mb-0">Kategori Buku</p>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bookmark fa-3x"></i>
                        </div>
                    </div>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </div>

        <div class="col">
            <div class="card bg-gradient-artistic-3 text-white rounded-3 shadow-lg border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="fs-3 fw-bold mb-0">{{ $jumlahBukuDipinjam }}</h3>
                            <p class="text-white mb-0">Jumlah Buku Dipinjam</p>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book-reader fa-3x"></i>
                        </div>
                    </div>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </div>

        <div class="col">
            <div class="card bg-gradient-artistic-4 text-white rounded-3 shadow-lg border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="fs-3 fw-bold mb-0">{{ $jumlahBukuDiKembalikan }}</h3>
                            <p class="text-white mb-0">Jumlah Buku Dikembalikan</p>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book-dead fa-3x"></i>
                        </div>
                    </div>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <div class="card bg-gradient-artistic-info rounded-3 shadow-lg border-0">
        <div class="container p-4">
            <h3 class="text-white">
                <i class="fas fa-info-circle me-3"></i> Informasi Aturan Peminjaman Buku
            </h3>
            <ol class="text-white">
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
            border-radius: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(to bottom right, rgba(255, 255, 255, 0.1), rgba(0, 0, 0, 0.1));
            opacity: 0.6;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .card:hover::before {
            opacity: 0.4;
        }

        .card .card-body {
            position: relative;
            z-index: 1;
            padding: 1.5rem;
            text-align: center;
        }

        .card .card-body h3 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .card .card-body p {
            font-size: 1.25rem;
            margin-bottom: 0;
        }

        .fa {
            transition: transform 0.3s ease-in-out;
        }

        .card:hover .fa {
            transform: scale(1.2);
        }

        .bg-gradient-artistic-1 {
            background: linear-gradient(to right bottom, #4a90e2, #50e3c2); /* Soft blue to green */
        }

        .bg-gradient-artistic-2 {
            background: linear-gradient(to right bottom, #f39c12, #f1c40f); /* Orange to yellow */
        }

        .bg-gradient-artistic-3 {
            background: linear-gradient(to right bottom, #e74c3c, #c0392b); /* Red to dark red */
        }

        .bg-gradient-artistic-4 {
            background: linear-gradient(to right bottom, #2ecc71, #27ae60); /* Green to darker green */
        }

        .bg-gradient-artistic-info {
            background: linear-gradient(to right bottom, #34495e, #2c3e50); /* Dark blue to darker blue */
        }

        .text-white {
            color: #fff !important;
        }
    </style>
@endpush
