<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>{{ $title }}</title>
    <style>
        /* Styling header */
        .table thead th {
            background-color: #007bff;
            color: #ffffff;
        }

        /* Styling table rows */
        .table tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }

        .table tbody tr:nth-of-type(even) {
            background-color: #ffffff;
        }

        /* Styling table borders */
        .table {
            border-color: #dee2e6;
        }

        .table td,
        .table th {
            border: 1px solid #dee2e6;
        }

        /* Styling for denda column */
        .denda-tinggi {
            background-color: #dc3545;
            color: #ffffff;
        }

        .denda-sedang {
            background-color: #ffc107;
            color: #000000;
        }

        .denda-rendah {
            background-color: #28a745;
            color: #ffffff;
        }

        .stat-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #f8f9fa;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
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
        </table>
    </div>
    <br>

    <div class="container">
        <!-- Form Filter -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Filter Laporan Denda</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('laporan.denda') }}">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Tanggal Mulai</label>
                                    <input type="date" name="start" class="form-control" value="{{ request('start') }}">
                                </div>
                                <div class="col-md-2">
                                    <label>Tanggal Akhir</label>
                                    <input type="date" name="end" class="form-control" value="{{ request('end') }}">
                                </div>
                                <div class="col-md-2">
                                    <label>Anggota</label>
                                    <select name="anggota" class="form-control">
                                        <option value="">Semua Anggota</option>
                                        @foreach($anggota as $a)
                                        <option value="{{ $a->id }}" {{ request('anggota')==$a->id ? 'selected' : '' }}>
                                            {{ $a->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Min Denda</label>
                                    <input type="number" name="min_denda" class="form-control"
                                        value="{{ request('min_denda') }}" placeholder="0">
                                </div>
                                <div class="col-md-2">
                                    <label>Max Denda</label>
                                    <input type="number" name="max_denda" class="form-control"
                                        value="{{ request('max_denda') }}" placeholder="0">
                                </div>
                                <div class="col-md-2">
                                    <label>&nbsp;</label>
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-filter"></i> Filter
                                        </button>
                                        <a href="{{ route('laporan.denda') }}" class="btn btn-secondary">
                                            <i class="fas fa-refresh"></i> Reset
                                        </a>
                                        <button type="button" class="btn btn-success" onclick="generateFakturDenda()">
                                            <i class="fas fa-file-invoice"></i> Generate Faktur
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Denda -->
        <div class="row mb-4">
            <div class="col-md-12">
                <h4>Statistik Denda</h4>
                <div class="row">
                    <div class="col-md-2">
                        <div class="stat-card text-center">
                            <div class="stat-number">Rp {{ number_format($statistik['total_denda']) }}</div>
                            <div class="stat-label">Total Denda</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="stat-card text-center">
                            <div class="stat-number">{{ $statistik['total_transaksi'] }}</div>
                            <div class="stat-label">Total Transaksi</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="stat-card text-center">
                            <div class="stat-number">Rp {{ number_format($statistik['rata_rata_denda']) }}</div>
                            <div class="stat-label">Rata-rata Denda</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="stat-card text-center">
                            <div class="stat-number">Rp {{ number_format($statistik['denda_tertinggi']) }}</div>
                            <div class="stat-label">Denda Tertinggi</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="stat-card text-center">
                            <div class="stat-number">{{ round($statistik['rata_hari_terlambat'], 1) }}</div>
                            <div class="stat-label">Rata-rata Hari Terlambat</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="stat-card text-center">
                            <div class="stat-number">{{ $statistik['total_hari_terlambat'] }}</div>
                            <div class="stat-label">Total Hari Terlambat</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top 5 Anggota dengan Denda Tertinggi -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h5>Top 5 Anggota dengan Denda Tertinggi</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Anggota</th>
                            <th>Total Denda</th>
                            <th>Jumlah Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topAnggota as $no => $anggota)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $anggota['nama'] }}</td>
                            <td>Rp {{ number_format($anggota['total_denda']) }}</td>
                            <td>{{ $anggota['jumlah_transaksi'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Detail Denda -->
        <table class="table table-bordered mb-4 table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th style="text-align: center;">Nama Anggota</th>
                    <th style="text-align: center;">Judul Buku</th>
                    <th style="text-align: center;">Jumlah Buku</th>
                    <th style="text-align: center;">Tanggal Pengembalian</th>
                    <th style="text-align: center;">Hari Terlambat</th>
                    <th style="text-align: center;">Denda (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($denda as $no => $data)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $data->anggota->nama ?? '-' }}</td>
                    <td>{{ $data->book->judul_buku ?? '-' }}</td>
                    <td style="text-align: center;">{{ $data->qty }}</td>
                    <td style="text-align: center;">
                        @if($data->tanggal_pengembalian)
                        {{ date('d F Y', strtotime($data->tanggal_pengembalian)) }}
                        @else
                        -
                        @endif
                    </td>
                    <td style="text-align: center;">{{ $data->jumlah_hari_terlambat }} hari</td>
                    <td class="{{ $data->denda > 50000 ? 'denda-tinggi' : ($data->denda > 20000 ? 'denda-sedang' : 'denda-rendah') }}"
                        style="text-align: center;">
                        {{ number_format($data->denda) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <br>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <td><strong>Total Denda</strong></td>
                        <td><strong>Rp {{ number_format($denda->sum('denda')) }}</strong></td>
                    </tr>
                    <tr>
                        <td>Jumlah Transaksi</td>
                        <td>{{ $denda->count() }}</td>
                    </tr>
                    <tr>
                        <td>Rata-rata Denda</td>
                        <td>Rp {{ number_format($denda->avg('denda')) }}</td>
                    </tr>
                    <tr>
                        <td>Total Hari Terlambat</td>
                        <td>{{ $denda->sum('jumlah_hari_terlambat') }} hari</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <script>
        function generateFakturDenda() {
    var start = document.querySelector('input[name="start"]').value;
    var end = document.querySelector('input[name="end"]').value;
    var anggota = document.querySelector('select[name="anggota"]').value;
    
    if (!start || !end) {
        alert('Mohon isi tanggal mulai dan akhir!');
        return;
    }
    
    // Buat form untuk generate faktur
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("laporan.generateFakturDenda") }}';
    
    var csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';
    form.appendChild(csrfToken);
    
    var startDate = document.createElement('input');
    startDate.type = 'hidden';
    startDate.name = 'start_date';
    startDate.value = start;
    form.appendChild(startDate);
    
    var endDate = document.createElement('input');
    endDate.type = 'hidden';
    endDate.name = 'end_date';
    endDate.value = end;
    form.appendChild(endDate);
    
    if (anggota) {
        var anggotaInput = document.createElement('input');
        anggotaInput.type = 'hidden';
        anggotaInput.name = 'anggota_id';
        anggotaInput.value = anggota;
        form.appendChild(anggotaInput);
    }
    
    document.body.appendChild(form);
    form.submit();
}
    </script>
</body>

</html>