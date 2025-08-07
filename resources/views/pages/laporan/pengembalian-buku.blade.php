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
            @if(request('tglAwal') && request('tglAkhir'))
            <tr>
                <td>Filter Tanggal</td>
                <td>:</td>
                <td style="text-align: center;">{{ date('d F Y', strtotime(request('tglAwal'))) }}</td>
                <td style="text-align: center;">&nbsp;- &nbsp;</td>
                <td style="text-align: center;">{{ date('d F Y', strtotime(request('tglAkhir'))) }}</td>
            </tr>
            @endif
        </table>
    </div>
    <br>

    <div class="container">
        <table class="table table-bordered mb-4 table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th style="text-align: center;">Nama Peminjam</th>
                    <th style="text-align: center;">Judul Buku</th>
                    <th style="text-align: center;">Jumlah Kembali</th>
                    <th style="text-align: center;">Tanggal Kembali</th>
                    <th style="text-align: center;">Jumlah Hari Terlambat</th>
                    <th style="width: 15%;">Denda</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengembalian as $laporan)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td style="text-align: center;">{{ $laporan->anggota->nama }}</td>
                    <td style="text-align: center;">{{ $laporan->book->judul_buku }}</td>
                    <td style="text-align: center;">{{ $laporan->qty }}</td>
                    <td style="text-align: center;">{{ date('d F Y', strtotime($laporan->tanggal_pengembalian)) }}</td>
                    <td style="text-align: center;">{{ $laporan->jumlah_hari_terlambat }} Hari</td>
                    <td style="text-align: left;">Rp. {{ number_format($laporan->denda, '2', ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" style="text-align: center;"><strong>Total Denda:</strong></td>
                    <td style="text-align: left;"><strong>Rp.
                            {{ number_format($pengembalian->sum('denda'), 2, ',', '.') }}</strong></td>
                </tr>
            </tfoot>
        </table>

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