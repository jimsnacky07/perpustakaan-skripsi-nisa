<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Laporan Statistik</title>
    <style>
        .stat-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f8f9fa;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #007bff;
        }
        
        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .table thead th {
            background-color: #007bff;
            color: #ffffff;
        }
        
        .table tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }
        
        .table tbody tr:nth-of-type(even) {
            background-color: #ffffff;
        }
    </style>
</head>

<body>
    @include('pages.laporan.header_laporan')

    <div class="container mt-3">
        <table>
            <tr>
                <td>Tanggal Cetak</td>
                <td>:</td>
                <td>{{ date('d F Y') }}</td>
            </tr>
            <tr>
                <td>Periode</td>
                <td>:</td>
                <td>{{ ucfirst($periode) }}</td>
            </tr>
        </table>
    </div>
    <br>

    <div class="container">
        <!-- Statistik Peminjaman -->
        <div class="row">
            <div class="col-md-12">
                <h4>Statistik Peminjaman</h4>
                <div class="row">
                    <div class="col-md-3">
                        <div class="stat-card text-center">
                            <div class="stat-number">{{ $peminjamanStats['total'] }}</div>
                            <div class="stat-label">Total Peminjaman</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card text-center">
                            <div class="stat-number">{{ $peminjamanStats['hari_ini'] }}</div>
                            <div class="stat-label">Hari Ini</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card text-center">
                            <div class="stat-number">{{ $peminjamanStats['minggu_ini'] }}</div>
                            <div class="stat-label">Minggu Ini</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card text-center">
                            <div class="stat-number">{{ $peminjamanStats['bulan_ini'] }}</div>
                            <div class="stat-label">Bulan Ini</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Pengembalian -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h4>Statistik Pengembalian</h4>
                <div class="row">
                    <div class="col-md-3">
                        <div class="stat-card text-center">
                            <div class="stat-number">{{ $pengembalianStats['total'] }}</div>
                            <div class="stat-label">Total Pengembalian</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card text-center">
                            <div class="stat-number">Rp {{ number_format($pengembalianStats['denda_total']) }}</div>
                            <div class="stat-label">Total Denda</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card text-center">
                            <div class="stat-number">Rp {{ number_format($pengembalianStats['denda_belum_lunas']) }}</div>
                            <div class="stat-label">Denda Belum Lunas</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card text-center">
                            <div class="stat-number">Rp {{ number_format($pengembalianStats['denda_sudah_lunas']) }}</div>
                            <div class="stat-label">Denda Sudah Lunas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Buku -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h4>Statistik Buku</h4>
                <div class="row">
                    <div class="col-md-3">
                        <div class="stat-card text-center">
                            <div class="stat-number">{{ $bukuStats['total_buku'] }}</div>
                            <div class="stat-label">Total Buku</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card text-center">
                            <div class="stat-number">{{ $bukuStats['total_stok'] }}</div>
                            <div class="stat-label">Total Stok</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buku Terpopuler -->
        <div class="row mt-4">
            <div class="col-md-6">
                <h5>Buku Terpopuler</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Jumlah Dipinjam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bukuStats['buku_terpopuler'] as $no => $buku)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $buku->judul_buku }}</td>
                                <td>{{ $buku->total_peminjaman }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h5>Kategori Terpopuler</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Jumlah Dipinjam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bukuStats['kategori_terpopuler'] as $no => $kategori)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $kategori->name }}</td>
                                <td>{{ $kategori->total_peminjaman }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
