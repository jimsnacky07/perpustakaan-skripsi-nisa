<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel"
    aria-hidden="true">
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
                    <div class="form-group">
                        <label for="anggota_id">Anggota (Opsional)</label>
                        <select class="form-control" id="anggota_id" name="anggota_id">
                            <option value="">Semua Anggota</option>
                            @foreach(\App\Models\Anggota::where('status', 'aktif')->orWhereNull('status')->get() as $anggota)
                                <option value="{{ $anggota->id }}">{{ $anggota->nama }} ({{ $anggota->nisn }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Filter Laporan
                        </button>
                        <button type="button" class="btn btn-success" onclick="generateFaktur()">
                            <i class="fas fa-file-invoice"></i> Generate Faktur
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function generateFaktur() {
    var tglAwal = document.getElementById('tglAwal').value;
    var tglAkhir = document.getElementById('tglAkhir').value;
    var anggotaId = document.getElementById('anggota_id').value;
    
    if (!tglAwal || !tglAkhir) {
        alert('Mohon isi tanggal awal dan akhir!');
        return;
    }
    
    // Buat form untuk generate faktur
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("laporan.generateFakturPengembalian") }}';
    
    var csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';
    form.appendChild(csrfToken);
    
    var startDate = document.createElement('input');
    startDate.type = 'hidden';
    startDate.name = 'start_date';
    startDate.value = tglAwal;
    form.appendChild(startDate);
    
    var endDate = document.createElement('input');
    endDate.type = 'hidden';
    endDate.name = 'end_date';
    endDate.value = tglAkhir;
    form.appendChild(endDate);
    
    if (anggotaId) {
        var anggota = document.createElement('input');
        anggota.type = 'hidden';
        anggota.name = 'anggota_id';
        anggota.value = anggotaId;
        form.appendChild(anggota);
    }
    
    document.body.appendChild(form);
    form.submit();
}
</script>