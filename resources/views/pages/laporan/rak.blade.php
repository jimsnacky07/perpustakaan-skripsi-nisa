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
            background-color: #007bff; /* Blue background */
            color: #ffffff; /* White text */
        }

        /* Styling table rows */
        .table tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9; /* Light gray for odd rows */
        }

        .table tbody tr:nth-of-type(even) {
            background-color: #ffffff; /* White for even rows */
        }

        .table {
            border-color: #dee2e6;
        }

        .table td, .table th {
            border: 1px solid #dee2e6;
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
        <table class="table table-bordered mb-4 table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th style="text-align: center;">Nomor Rak Buku</th>
                    <th style="text-align: center;">Nama Rak</th>
                    <th style="text-align: center;">Kapasitas Tampung</th>
                    <th style="text-align: center;">Jumlah Buku</th>
                    <th style="text-align: center;">Total Stok</th>
                    <th style="text-align: center;">Persentase Terisi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rak as $no => $data)
                    @php
                        $totalStok = $data->books->sum('jumlah_buku');
                        $persentase = $data->kapasitas_rak > 0 ? round(($totalStok / $data->kapasitas_rak) * 100, 1) : 0;
                    @endphp
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td style="text-align: center;">{{ $data->no_rak }}</td>
                        <td style="text-align: center;">{{ $data->nama_rak }}</td>
                        <td style="text-align: center;">{{ $data->kapasitas_rak }}</td>
                        <td style="text-align: center;">{{ $data->books_count }}</td>
                        <td style="text-align: center;">{{ $totalStok }}</td>
                        <td style="text-align: center;">{{ $persentase }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <td><strong>Total Rak</strong></td>
                        <td><strong>{{ $rak->count() }}</strong></td>
                    </tr>
                    <tr>
                        <td>Total Buku</td>
                        <td>{{ $rak->sum('books_count') }}</td>
                    </tr>
                    <tr>
                        <td>Total Stok</td>
                        <td>
                            @php
                                $totalStok = $rak->sum(function($rak) {
                                    return $rak->books->sum('jumlah_buku');
                                });
                            @endphp
                            {{ $totalStok }}
                        </td>
                    </tr>
                    <tr>
                        <td>Total Kapasitas</td>
                        <td>{{ $rak->sum('kapasitas_rak') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <br>
        <br>

        <div class="float-end text-center" style="padding: 1cm; padding-top:0%">
            <span>Kepala Pustaka</span><br><br><br><br>
            <span>( ..................................... )</span><br>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
