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
            background-color: #007bff; /* Blue background for header */
            color: #ffffff; /* White text */
        }

        /* Styling table rows */
        .table tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2; /* Light gray for odd rows */
        }

        .table tbody tr:nth-of-type(even) {
            background-color: #ffffff; /* White for even rows */
        }

        /* Styling table borders */
        .table {
            border-color: #dee2e6; /* Light gray border */
        }

        .table td, .table th {
            border: 1px solid #dee2e6; /* Light gray border for table cells */
        }

        /* Styling images in the table */
        .table td img {
            max-width: 100px; /* Ensure images are not too large */
            height: auto; /* Maintain aspect ratio */
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
                <td>
                    {{ date('d F Y') }}
                </td>
            </tr>
        </table>
    </div>
    <br>

    <div class="container">
        <table class="table table-bordered mb-4 table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th style="text-align: center;">No ISBN</th>
                    <th style="text-align: center;">Judul</th>
                    <th style="text-align: center;">Tahun Terbit</th>
                    <th style="text-align: center;">Penerbit</th>
                    <th style="text-align: center;">Pengarang</th>
                    <th style="text-align: center;">Kategori</th>
                    <th style="text-align: center;">Lokasi / Rak</th>
                    <th style="text-align: center;">Jumlah Stok Buku</th>
                    <th style="text-align: center;">Gambar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buku as $no => $data)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $data->no_isbn }}</td>
                        <td>{{ $data->judul_buku }}</td>
                        <td style="text-align: center;">{{ $data->tahun_terbit }}</td>
                        <td style="text-align: center;">{{ $data->penerbit_buku }}</td>
                        <td style="text-align: center;">{{ $data->pengarang_buku }}</td>
                        <td style="text-align: center;">{{ $data->kategoriBuku->name ?? '-' }}</td>
                        <td style="text-align: center;">{{ $data->rakBuku->no_rak ?? '-' }} | {{ $data->rakBuku->nama_rak ?? '-' }}</td>
                        <td style="text-align: center;">{{ $data->jumlah_buku }}</td>
                        <td style="text-align: center;">
                            @if($data->gambar)
                                <img src="{{ Storage::url('public/buku/' . $data->gambar) }}" alt="Gambar Buku">
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

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
