<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">
                    Filter Laporan Data Pengembalian Buku
                    {{-- FIlter Laporan Data Pengembalian Buku --}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('laporan.pengembalian-buku') }}" method="POST" id="submitForm">
                    @csrf
                    <div class="form-group">
                        <label for="tglAwal">Tanggal Awal</label>
                        <input type="date" class="form-control" id="tglAwal" name="tglAwal" required>
                    </div>
                    <div class="form-group">
                        <label for="tglAkhir">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tglAkhir" name="tglAkhir" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>
    </div>
</div>
