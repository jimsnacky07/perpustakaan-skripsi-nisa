@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $countBuku }}</h3>
                    <p>Buku</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $countJenisBuku }}</h3>
                    <p>Kategori Buku</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $countAnggota }}</h3>
                    <p class="text-white">Anggota Perpustakaan</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $countPeminjamanBuku }}</h3>
                    <p>Orang Peminjam Buku</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@endsection

@push('before-style')
    <style>
        .small-box {
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            padding: 15px;
            margin-bottom: 20px;
            color: white;
            transition: all 0.3s;
            cursor: pointer;
        }

        .small-box:hover {
            transform: translateY(-5px);
        }

        .small-box .icon {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 32px;
        }

        .small-box .inner {
            padding-right: 50px;
        }

        .small-box p {
            font-size: 14px;
            margin: 0;
            opacity: 0.8;
        }

        .small-box .small-box-footer {
            position: absolute;
            bottom: 15px;
            left: 15px;
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s;
        }

        .small-box:hover .small-box-footer {
            color: white;
        }
    </style>
@endpush
