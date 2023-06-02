<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    @include('pages.laporan.header_laporan')

    <div class="container mt-3">
        <table>
            <tr>
                <td>NISN Anggota</td>
                <td>&nbsp;&nbsp; : </td>
                <td>
                    &nbsp;&nbsp; {{ $peminjaman->first()->nisn }}
                </td>
            </tr>
            <tr>
                <td>Nama Anggota</td>
                <td>&nbsp;&nbsp; : </td>
                <td>
                    &nbsp;&nbsp; {{ $peminjaman->first()->nama }}

                </td>
            </tr>
            <tr>
                <td>Kode Peminjaman</td>
                <td>&nbsp;&nbsp; : </td>
                <td>
                    &nbsp;&nbsp; {{ $peminjaman->first()->kode_peminjaman }}
                </td>
            </tr>
        </table>
    </div>

    <div class="container">

        <table class="table table-bordered mb-4 table-striped mt-3">
            <thead>
                <tr>
                    <th style="text-align: center;">No Isbn</th>
                    <th style="text-align: center;">Judul Buku</th>
                    <th style="text-align: center;">Tanggal Pinjam</th>
                    <th style="text-align: center;">Tanggal Buku Wajib Kembali</th>
                    <th style="text-align: center;">Jumlah Pinjam</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjaman as $item)
                    <tr>
                        <td>{{ $item->isbn_buku }}</td>
                        <td>{{ $item->judul_buku }}</td>
                        <td style="text-align: center;">{{ date('d F Y', strtotime($item->tgl_pinjam)) }}</td>
                        <td style="text-align: center;">{{ date('d F Y', strtotime($item->tgl_kembali)) }}</td>
                        <td>{{ $item->jumlah_buku }}</td>
                        <td>{{ $item->status == 0 ? 'Dipinjam' : 'Dikembalikan' }}</td>

                        {{-- <td style="text-align: center;">{{ date('d F Y', strtotime($item->tanggal_pengembalian)) }}</td> --}}
                        {{-- <td>{{ $item->denda }}</td> --}}

                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>

    <br>

    <div class="container">
        <table>
            <tr>
                <td>
                    <span>Keterangan : </span><br>
                    <span><i>Kartu ini wajib dibawa saat Meminjam / Mengembalikan buku</i></span>
                </td>
            </tr>
        </table>

        <br>
        <br>

        <div class="float-end text-center" style="padding: 1cm;padding-top:0%">
            <!-- <h6 class="text-center" style="margin-bottom: 2cm;">{{ date('d F Y') }}</h6> -->
            <span>Petugas Pustaka</span><br><br><br><br><br>
            <span>( ..................................... )</span><br>

        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
