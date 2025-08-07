<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>{{ $title }}</title>
    <style>
        .table thead th {
            background-color: #007bff;
            color: #fff;
        }

        .table tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }

        .table tbody tr:nth-of-type(even) {
            background-color: #ffffff;
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
    {{-- header laporan --}}
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
                    <th width="1%">No</th>
                    <th style="text-align: center;">Nama Kategori</th>
                    <th style="text-align: center;">Jumlah Buku</th>
                    <th style="text-align: center;">Total Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategoriBuku as $no => $data)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td style="text-align: center;">{{ $data->name }}</td>
                        <td style="text-align: center;">{{ $data->books_count }}</td>
                        <td style="text-align: center;">
                            @php
                                $totalStok = $data->books->sum('jumlah_buku');
                            @endphp
                            {{ $totalStok }}
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
                        <td><strong>Total Kategori</strong></td>
                        <td><strong>{{ $kategoriBuku->count() }}</strong></td>
                    </tr>
                    <tr>
                        <td>Total Buku</td>
                        <td>{{ $kategoriBuku->sum('books_count') }}</td>
                    </tr>
                    <tr>
                        <td>Total Stok</td>
                        <td>
                            @php
                                $totalStok = $kategoriBuku->sum(function($kategori) {
                                    return $kategori->books->sum('jumlah_buku');
                                });
                            @endphp
                            {{ $totalStok }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <br>
        <br>

        <div class="float-end text-center" style="padding: 1cm;padding-top:0%">
            <span>Kepala Pustaka</span><br><br><br><br>
            <span>( ..................................... )</span><br>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>
