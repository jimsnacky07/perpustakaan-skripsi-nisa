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
    <h5 class="text-center mt-2">Laporan Data Jenis Buku</h5>
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
        </table>
    </div>
    <br>

    <div class="container">

        <table class="table table-bordered mb-4 table-striped">
            <thead>
                <tr>
                    <th width="1%">No</th>
                    <th style="text-align: center;">Kategori Buku</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategoriBuku as $no => $data)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td style="text-align: center;">{{ $data->name }}</td>
                    </tr>
                @endforeach
            </tbody>



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
