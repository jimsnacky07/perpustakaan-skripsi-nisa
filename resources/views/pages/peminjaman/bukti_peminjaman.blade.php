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
    <div class="row">
        <center>
            <img src="{{ asset('gambar/perpus.png') }}" class="img-circle" width="8%" alt="">
        </center>

    </div>
    <h2 class="text-center mt-2">Perpustakaan Mulia Bersama</h2>
    <h5 class="text-center mt-2">Jalan Anggrek No. 25 B Flamboyan Baru, Kota Padang</h5>
    <hr style="border:1px solid black;">
    <center>
        <p>KARTU PEMINJAMAN DAN PENGEMBALIAN BUKU</p>
    </center>
    <div class="container">
        <table class="table table-bordered mb-4 table-striped">
            <thead>
                <tr>
                    <th style="text-align: center;">No Isbn</th>
                    <th style="text-align: center;">Judul Buku</th>
                    <th style="text-align: center;">Tanggal Pinjam</th>
                    <th style="text-align: center;">Tanggal Kembali</th>
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
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <tr>
            <td>Nisn Anggota</td>
            <td>:</td>
            <td>
                {{ $item->nisn }}
            </td>
        </tr>
        <br>
        <tr>
            <td>Nama Anggota</td>
            <td>:</td>
            <td>
                {{ $item->nama }}
            </td>
        </tr>
        <br>
        <tr>
            <td>Kode Peminjaman</td>
            <td>:</td>
            <td>
                {{ $item->kode_peminjaman }}
            </td>
        </tr>
    </div>

    <br>

    <div class="container">
        <table>
            <tr>
                <td>
                    <span>Keterangan : </span><br>
                    <span><i>Lembaran ini wajib dibawa meminjam/mengembalikan buku</i></span>
                </td>
            </tr>
        </table>

        <br>
        <br>

        <div class="float-end text-center" style="padding: 1cm;padding-top:0%">
            <!-- <h6 class="text-center" style="margin-bottom: 2cm;">{{ date('d F Y') }}</h6> -->
            <span>Petugas Pustaka</span><br><br><br><br>
            <span>( ..................................... )</span><br>

        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
