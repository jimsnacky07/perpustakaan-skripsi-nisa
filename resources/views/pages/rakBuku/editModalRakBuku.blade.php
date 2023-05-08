<!-- Modal -->
<div class="modal fade" id="editModalRakBuku" tabindex="-1" aria-labelledby="editModalRakBukuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('rak-buku.update') }}" method="POST" id="editFormRakBuku">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalRakBukuLabel">Edit Rak Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="idRakBuku" id="idRakBuku">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="editModalRakBukuLabel">No Rak Buku</label>
                                <input type="text" class="form-control" name="no_rak" id="no_rak">
                                <span class="text-danger error-text no_rak_error_edit"></span>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="editModalRakBukuLabel">Nama Rak Buku</label>
                                <input type="text" class="form-control" name="nama_rak" id="nama_rak">
                                <span class="text-danger error-text nama_rak_error_edit"></span>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="editModalRakBukuLabel">Kapasitas Rak Buku</label>
                                <input type="text" class="form-control" name="kapasitas_rak" id="kapasitas_rak">
                                <span class="text-danger error-text kapasitas_rak_error_edit"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
