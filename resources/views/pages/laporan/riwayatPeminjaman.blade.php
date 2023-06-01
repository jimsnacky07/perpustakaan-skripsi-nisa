<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>{{ $title }}</title>
</head>

<body>
    @include('pages.laporan.header_laporan')

    <div class="container">
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
            <tr>
                <th>No</th>
                <th style="text-align: center;">Nama Peminjam</th>
                <th style="text-align: center;">Judul Buku</th>
                <th style="text-align: center;">Jumlah Pinjam</th>
                <th style="text-align: center;">Tanggal Pinjam</th>
                <th style="text-align: center;">Tanggal Wajib Kembali</th>
                <th style="text-align: center;">Status</th>

            </tr>

            @foreach ($riwayatPeminjamanBuku as $no => $data)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $data->nama }}</td>
                    <td style="text-align: center;">{{ $data->judul_buku }}</td>
                    <td style="text-align: center;">{{ $data->jumlah_buku }}</td>
                    <td style="text-align: center;">{{ date('d F Y', strtotime($data->tgl_pinjam)) }}</td>
                    <td style="text-align: center;">{{ date('d F Y', strtotime($data->tgl_kembali)) }}</td>
                    <td style="text-align: center;">{{ $data->status == 0 ? 'DIPINJAM' : 'DIKEMBALIKAN' }}</td>


                </tr>
            @endforeach

        </table>

        <br>
        <br>

        <div class="float-end text-center" style="padding: 1cm;padding-top:0%">
            <!-- <h6 class="text-center" style="margin-bottom: 2cm;">{{ date('d F Y') }}</h6> -->
            <span>Kepala Pustaka</span><br><br><br><br>
            <span>( ..................................... )</span><br>

        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
