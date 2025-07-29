<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>{{ $title ?? 'Laporan Buku Rusak' }}</title>
    <style>
        .table thead th {
            background-color: #007bff;
            color: #fff;
        }

        .table tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }

        .table tbody tr:nth-of-type(even) {
            background-color: #fff;
        }

        .table {
            border-color: #dee2e6;
        }

        .table td,
        .table th {
            border: 1px solid #dee2e6;
        }
    </style>
</head>

<body>
    @php $title = 'Laporan Buku Rusak'; @endphp
    @include('pages.laporan.header_laporan')
    <div class="container mt-3">
        <form method="get" class="row g-3 mb-3">
            <div class="col-auto">
                <label for="start" class="form-label">Tanggal Awal</label>
                <input type="date" name="start" id="start" class="form-control" value="{{ request('start') }}">
            </div>
            <div class="col-auto">
                <label for="end" class="form-label">Tanggal Akhir</label>
                <input type="date" name="end" id="end" class="form-control" value="{{ request('end') }}">
            </div>
            <div class="col-auto align-self-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
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
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Jumlah Rusak</th>
                    <th>Penyebab</th>
                    <th>Keterangan</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bukuRusak as $no => $data)
                <tr>
                    <td>{{ $bukuRusak->firstItem() + $no }}</td>
                    <td>{{ $data->judulbuku }}</td>
                    <td>{{ $data->jumlahrusak }}</td>
                    <td>{{ $data->penyebab }}</td>
                    <td>{{ $data->keterangan }}</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $bukuRusak->withQueryString()->links() }}
    </div>
    <script>
        window.print();
    </script>
</body>

</html>