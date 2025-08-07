<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Faktur {{ $faktur->nomor_faktur }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            font-size: 14px;
        }
        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .invoice-details {
            width: 45%;
        }
        .customer-details {
            width: 45%;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .total-section {
            text-align: right;
            margin-top: 20px;
        }
        .total-amount {
            font-size: 18px;
            font-weight: bold;
            color: #d9534f;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        .status {
            padding: 5px 10px;
            border-radius: 3px;
            font-weight: bold;
        }
        .status-paid {
            background-color: #d4edda;
            color: #155724;
        }
        .status-unpaid {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>PERPUSTAKAAN SEKOLAH</h1>
        <p>Jl. Pendidikan No. 123, Kota Pendidikan</p>
        <p>Telp: (021) 1234567 | Email: perpus@sekolah.sch.id</p>
    </div>

    <div class="invoice-info">
        <div class="invoice-details">
            <h3>FAKTUR</h3>
            <p><strong>Nomor:</strong> {{ $faktur->nomor_faktur }}</p>
            <p><strong>Tanggal:</strong> {{ $faktur->tanggal_faktur->format('d/m/Y') }}</p>
            <p><strong>Jenis:</strong> 
                @if($faktur->jenis_faktur == 'peminjaman')
                    Peminjaman Buku
                @elseif($faktur->jenis_faktur == 'pengembalian')
                    Pengembalian Buku
                @else
                    Denda Terlambat
                @endif
            </p>
            <p><strong>Status:</strong> 
                <span class="status {{ $faktur->status == 'dibayar' ? 'status-paid' : 'status-unpaid' }}">
                    {{ $faktur->status == 'dibayar' ? 'Dibayar' : 'Belum Dibayar' }}
                </span>
            </p>
            @if($faktur->tanggal_jatuh_tempo)
            <p><strong>Jatuh Tempo:</strong> {{ $faktur->tanggal_jatuh_tempo->format('d/m/Y') }}</p>
            @endif
        </div>
        <div class="customer-details">
            <h3>DATA ANGGOTA</h3>
            <p><strong>Nama:</strong> {{ $faktur->anggota->nama ?? 'N/A' }}</p>
            <p><strong>NISN:</strong> {{ $faktur->anggota->nisn ?? 'N/A' }}</p>
            <p><strong>Kelas:</strong> {{ $faktur->anggota->kelas ?? 'N/A' }}</p>
            <p><strong>Alamat:</strong> {{ $faktur->anggota->alamat ?? 'N/A' }}</p>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                @if($faktur->jenis_faktur == 'peminjaman')
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                @elseif($faktur->jenis_faktur == 'pengembalian')
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Hari Terlambat</th>
                    <th>Denda</th>
                @else
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Hari Terlambat</th>
                    <th>Denda</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($faktur->detail_items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item['judul_buku'] ?? 'N/A' }}</td>
                @if($faktur->jenis_faktur == 'peminjaman')
                    <td>{{ $item['jumlah'] ?? 'N/A' }}</td>
                    <td>{{ $item['tanggal_pinjam'] ?? 'N/A' }}</td>
                    <td>{{ $item['tanggal_kembali'] ?? 'N/A' }}</td>
                @elseif($faktur->jenis_faktur == 'pengembalian')
                    <td>{{ $item['tanggal_pinjam'] ?? 'N/A' }}</td>
                    <td>{{ $item['tanggal_kembali'] ?? 'N/A' }}</td>
                    <td>{{ $item['jumlah_hari_terlambat'] ?? 0 }} hari</td>
                    <td>Rp {{ number_format($item['total_denda'] ?? 0, 0, ',', '.') }}</td>
                @else
                    <td>{{ $item['tanggal_peminjaman'] ?? 'N/A' }}</td>
                    <td>{{ $item['tanggal_pengembalian'] ?? 'N/A' }}</td>
                    <td>{{ $item['jumlah_hari_terlambat'] ?? 0 }} hari</td>
                    <td>Rp {{ number_format($item['total_denda'] ?? 0, 0, ',', '.') }}</td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <h3>TOTAL: 
            @if($faktur->total_amount > 0)
                <span class="total-amount">Rp {{ number_format($faktur->total_amount, 0, ',', '.') }}</span>
            @else
                <span class="total-amount">GRATIS</span>
            @endif
        </h3>
    </div>

    @if($faktur->keterangan)
    <div style="margin-top: 20px;">
        <p><strong>Keterangan:</strong> {{ $faktur->keterangan }}</p>
    </div>
    @endif

    <div class="footer">
        <p>Faktur ini dibuat secara otomatis oleh sistem perpustakaan</p>
        <p>Terima kasih telah menggunakan layanan perpustakaan kami</p>
    </div>
</body>
</html>
