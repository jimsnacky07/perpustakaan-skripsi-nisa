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
    </style>
</head>

<body>
    {{-- header laporan --}}
    @include('pages.laporan.header_laporan')

    <div class="container">
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
            <span>Kepala Pustaka</span><br><br><br><br>
            <span>( ..................................... )</span><br>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>
