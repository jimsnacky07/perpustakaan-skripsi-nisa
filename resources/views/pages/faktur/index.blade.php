@extends('layouts.main')

@section('title', 'Daftar Faktur')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Faktur</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Faktur</th>
                                <th>Jenis</th>
                                <th>Anggota</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($faktur as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="badge badge-info">{{ $item->nomor_faktur }}</span>
                                </td>
                                <td>
                                    @if($item->jenis_faktur == 'peminjaman')
                                        <span class="badge badge-primary">Peminjaman</span>
                                    @elseif($item->jenis_faktur == 'pengembalian')
                                        <span class="badge badge-warning">Pengembalian</span>
                                    @else
                                        <span class="badge badge-danger">Denda</span>
                                    @endif
                                </td>
                                <td>{{ $item->anggota->nama ?? 'N/A' }}</td>
                                <td>
                                    @if($item->total_amount > 0)
                                        <span class="text-danger font-weight-bold">
                                            Rp {{ number_format($item->total_amount, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-success">Gratis</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->status == 'dibayar')
                                        <span class="badge badge-success">Dibayar</span>
                                    @else
                                        <span class="badge badge-warning">Belum Dibayar</span>
                                    @endif
                                </td>
                                <td>{{ $item->tanggal_faktur->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('faktur.show', $item->id) }}" 
                                           class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                        <a href="{{ route('faktur.downloadPDF', $item->id) }}" 
                                           class="btn btn-success btn-sm">
                                            <i class="fas fa-download"></i> PDF
                                        </a>
                                        @if($item->status == 'belum_dibayar')
                                        <form action="{{ route('faktur.markAsPaid', $item->id) }}" 
                                              method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm" 
                                                    onclick="return confirm('Tandai sebagai dibayar?')">
                                                <i class="fas fa-check"></i> Dibayar
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data faktur</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
