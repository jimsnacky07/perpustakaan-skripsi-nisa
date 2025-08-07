@extends('layouts.main')

@section('title', 'Detail Faktur')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Faktur</h3>
                <div class="card-tools">
                    <a href="{{ route('faktur.downloadPDF', $faktur->id) }}" 
                       class="btn btn-success btn-sm">
                        <i class="fas fa-download"></i> Download PDF
                    </a>
                    <a href="{{ route('faktur.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Nomor Faktur:</strong></td>
                                <td>{{ $faktur->nomor_faktur }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Faktur:</strong></td>
                                <td>
                                    @if($faktur->jenis_faktur == 'peminjaman')
                                        <span class="badge badge-primary">Peminjaman</span>
                                    @elseif($faktur->jenis_faktur == 'pengembalian')
                                        <span class="badge badge-warning">Pengembalian</span>
                                    @else
                                        <span class="badge badge-danger">Denda</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    @if($faktur->status == 'dibayar')
                                        <span class="badge badge-success">Dibayar</span>
                                    @else
                                        <span class="badge badge-warning">Belum Dibayar</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Faktur:</strong></td>
                                <td>{{ $faktur->tanggal_faktur->format('d/m/Y') }}</td>
                            </tr>
                            @if($faktur->tanggal_jatuh_tempo)
                            <tr>
                                <td><strong>Jatuh Tempo:</strong></td>
                                <td>{{ $faktur->tanggal_jatuh_tempo->format('d/m/Y') }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Anggota:</strong></td>
                                <td>{{ $faktur->anggota->nama ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>NISN:</strong></td>
                                <td>{{ $faktur->anggota->nisn ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Kelas:</strong></td>
                                <td>{{ $faktur->anggota->kelas ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Total:</strong></td>
                                <td>
                                    @if($faktur->total_amount > 0)
                                        <span class="text-danger font-weight-bold">
                                            Rp {{ number_format($faktur->total_amount, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-success">Gratis</span>
                                    @endif
                                </td>
                            </tr>
                            @if($faktur->keterangan)
                            <tr>
                                <td><strong>Keterangan:</strong></td>
                                <td>{{ $faktur->keterangan }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>

                <hr>

                <h5>Detail Items:</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
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
                </div>

                @if($faktur->status == 'belum_dibayar')
                <div class="mt-3">
                    <form action="{{ route('faktur.markAsPaid', $faktur->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning" 
                                onclick="return confirm('Tandai faktur ini sebagai dibayar?')">
                            <i class="fas fa-check"></i> Tandai Sebagai Dibayar
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
