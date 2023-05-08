<!-- Modal -->
<div class="modal fade" id="addModalRakBuku" tabindex="-1" aria-labelledby="addModalRakBukuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('rak-buku.store') }}" method="POST" id="addFormRakBuku">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalRakBukuLabel">Tambah Rak Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="addModalRakBukuLabel">Nomor Rak Buku</label>
                                <input type="text" class="form-control" name="no_rak">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="addModalRakBukuLabel">Nama Rak Buku</label>
                                <input type="text" class="form-control" name="nama_rak" autocomplete="off">
                                <span class="text-danger error-text email_error"></span>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="addModalRakBukuLabel">Kapasitas Rak Buku</label>
                                <input type="text" class="form-control" name="kapasitas_rak">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
