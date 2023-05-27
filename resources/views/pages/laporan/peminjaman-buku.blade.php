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
    <h2 class="text-center mt-2">Perpustakaan</h2>
    <h5 class="text-center mt-2">{{ $title }}</h5>
    <hr style="border:1px solid black;">
    <br>
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

        {{-- <table class="table table-bordered mb-4 table-striped">
            <tr>
                <th>No</th>
                <th style="text-align: center;">Nama Peminjam</th>
                <th style="text-align: center;">Judul Buku</th>
                <th style="text-align: center;">Jumlah Pinjam</th>
                <th style="text-align: center;">Tanggal Pinjam</th>
                <th style="text-align: center;">Tanggal Wajib Kembali</th>
            </tr>

            @foreach ($laporanPeminjaman as $laporan)
                <p>Nama: {{ $laporan->nama }}</p>
                <ul>
                    @foreach ($laporanPeminjaman as $peminjaman)
                        @if ($peminjaman->nama == $laporan->nama)
                            <li>{{ $peminjaman->judul_buku }}</li>
                            <td style="text-align: center;">{{ $peminjaman->jumlah_buku }}</td>
                            <td style="text-align: center;">{{ $peminjaman->tgl_pinjam }}</td>
                            <td style="text-align: center;">{{ $peminjaman->tgl_kembali }}</td>
                            </td>
                        @endif
                    @endforeach
                </ul>
            @endforeach

            @foreach ($laporanPeminjaman as $no => $data)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $data->nama }}</td>
                    <td style="text-align: center;">{{ $data->judul_buku }}</td>
                    <td style="text-align: center;">{{ $data->jumlah_buku }}</td>
                    <td style="text-align: center;">{{ $data->tgl_pinjam }}</td>
                    <td style="text-align: center;">{{ $data->tgl_kembali }}</td>
                    <td style="text-align: center;">{{ $data->status == 0 ? 'DIPINJAM' : 'DIKEMBALIKAN' }}
                    </td>


                </tr>
            @endforeach

        </table> --}}

        <table class="table table-bordered mb-4 table-striped">
            <tr>
                <th>No</th>
                <th style="text-align: center;">Nama Peminjam</th>
                <th style="text-align: center;">Judul Buku</th>
                <th style="text-align: center;">Jumlah Pinjam</th>
                <th style="text-align: center;">Tanggal Pinjam</th>
                <th style="text-align: center;">Tanggal Wajib Kembali</th>
            </tr>

            @php
                $no = 1;
            @endphp

            @php
                setlocale(LC_TIME, 'id_ID'); // Untuk bahasa Indonesia
                // setlocale(LC_TIME, 'en_US'); // Untuk bahasa Inggris
            @endphp

            @foreach ($laporanPeminjaman as $laporan)
                @if ($loop->first || $laporan->nama != $laporanPeminjaman[$loop->index - 1]->nama)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td style="text-align: center;">{{ $laporan->nama }}</td>
                        <td>
                            <ul>
                @endif

                <li>{{ $laporan->judul_buku }} ({{ $laporan->isbn_buku }})</li>

                @if ($loop->last || $laporan->nama != $laporanPeminjaman[$loop->index + 1]->nama)
                    </ul>
                    </td>
                    <td>
                        <ul>
                            @foreach ($laporanPeminjaman as $peminjaman)
                                @if ($peminjaman->nama == $laporan->nama)
                                    <li>{{ $peminjaman->jumlah_buku }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </td>
                    <td style="text-align: center;">{{ strftime('%d %B %Y', strtotime($laporan->tgl_pinjam)) }}</td>
                    <td style="text-align: center;">{{ strftime('%d %B %Y', strtotime($laporan->tgl_kembali)) }}</td>
                    </tr>
                @endif
            @endforeach

            <tr>
                <td colspan="3" style="text-align: right;"><strong>Total Jumlah Pinjam:</strong></td>
                <td style="text-align: center;"><strong>{{ $laporanPeminjaman->sum('jumlah_buku') }}</strong></td>
                <td colspan="2"></td>
            </tr>
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
