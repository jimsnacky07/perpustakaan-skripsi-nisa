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
            <tr>
                <td>Filter Tanggal</td>
                <td>:</td>
                {{-- {{ $tglAwal }} - {{ $tglAkhir }} --}}
                <td style="text-align: center;">{{ strftime('%d %B %Y', strtotime($tglAwal)) }}</td>
                <td style="text-align: center;">&nbsp;- &nbsp;</td>
                <td style="text-align: center;">{{ strftime('%d %B %Y', strtotime($tglAkhir)) }}</td>
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
                <th style="text-align: center;">Jumlah Kembali</th>
                <th style="text-align: center;">Tanggal Kembali</th>
                <th style="text-align: center;">Jumlah Hari Terlambat</th>
                <th style="width: 15%;">Denda</th>
            </tr>

            @foreach ($laporanPengembalian as $laporan)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td style="text-align: center;">{{ $laporan->nama }}</td>
                    <td style="text-align: center;">{{ $laporan->judul_buku }}</td>
                    <td style="text-align: center;">{{ $laporan->qty }}</td>
                    <td style="text-align: center;">{{ date('d F Y', strtotime($laporan->tanggal_pengembalian)) }}</td>
                    <td style="text-align: center;">{{ $laporan->jumlah_hari_terlambat }} Hari</td>
                    <td style="text-align: left;">Rp. {{ number_format($laporan->denda, '2', ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6" style="text-align: center;"><strong>Total Denda:</strong></td>
                <td style="text-align: left;"><strong>Rp.
                        {{ number_format($laporanPengembalian->sum('denda'), 2, ',', '.') }}</strong></td>
            </tr>


        </table>

        {{-- <table class="table table-bordered mb-4 table-striped">
            <tr>
                <th>No</th>
                <th style="text-align: center;">Nama Peminjam</th>
                <th style="text-align: center;">Judul Buku</th>
                <th style="text-align: center;">Jumlah Kembali</th>
                <th style="text-align: center;">Tanggal Kembali</th>
            </tr>

            @php
                $no = 1;
            @endphp

            @php
                setlocale(LC_TIME, 'id_ID'); // Untuk bahasa Indonesia
                // setlocale(LC_TIME, 'en_US'); // Untuk bahasa Inggris
            @endphp

            @foreach ($laporanPengembalian as $laporan)
                @if ($loop->first || $laporan->nama != $laporanPengembalian[$loop->index - 1]->nama)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td style="text-align: center;">{{ $laporan->nama }}</td>
                        <td>
                            <ul>
                @endif

                <li>{{ $laporan->judul_buku }} ({{ $laporan->isbn_buku }})</li>

                @if ($loop->last || $laporan->nama != $laporanPengembalian[$loop->index + 1]->nama)
                    </ul>
                    </td>
                    <td>
                        <ul>
                            @foreach ($laporanPengembalian as $peminjaman)
                                @if ($peminjaman->nama == $laporan->nama)
                                    <li>{{ $peminjaman->qty }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </td>

                    </tr>
                @endif
            @endforeach

            <tr>
                <td colspan="3" style="text-align: right;"><strong>Total Jumlah Pinjam:</strong></td>
                <td style="text-align: center;"><strong>{{ $laporanPengembalian->sum('qty') }}</strong></td>
                <td colspan="2"></td>
            </tr>
        </table> --}}


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
