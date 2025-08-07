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
                    <th style="text-align: center;">Jumlah Pinjam</th>
                    <th style="text-align: center;">Tanggal Pinjam</th>
                    <th style="text-align: center;">Tanggal Wajib Kembali</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp

                @foreach ($peminjaman as $laporan)
                @if ($loop->first || $laporan->anggota->nama != $peminjaman[$loop->index - 1]->anggota->nama)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td style="text-align: center;">{{ $laporan->anggota->nama }}</td>
                    <td>
                        <ul>
                            @endif

                            @foreach($laporan->detailPeminjaman as $detail)
                            <li>{{ $detail->judul_buku }} ({{ $detail->isbn_buku }})</li>
                            @endforeach

                            @if ($loop->last || $laporan->anggota->nama != $peminjaman[$loop->index + 1]->anggota->nama)
                        </ul>
                    </td>
                    <td style="text-align: center;">
                        {{ $laporan->detailPeminjaman->sum(function($detail) { return (int)$detail->jumlah_buku; }) }}
                    </td>
                    <td style="text-align: center;">{{ date('d F Y', strtotime($laporan->tgl_pinjam)) }}</td>
                    <td style="text-align: center;">{{ date('d F Y', strtotime($laporan->tgl_kembali)) }}</td>
                </tr>
                @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Total Jumlah Pinjam:</strong></td>
                    <td style="text-align: center;"><strong>{{ $peminjaman->sum(function($p) {
                            return $p->detailPeminjaman->sum(function($detail) {
                            return (int)$detail->jumlah_buku;
                            });
                            }) }}</strong></td>
                    <td colspan="2"></td>
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