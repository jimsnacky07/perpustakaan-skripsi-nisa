<!-- Modal -->
<div class="modal fade" id="editModalKategori" tabindex="-1" aria-labelledby="editModalKategoriLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('jenis-buku.update') }}" method="POST" id="editFormKategori">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalKategoriLabel">Edit Data Jenis Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="idKategori" id="idKategori">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="editModalKategoriLabel">Jenis Buku</label>
                                <input type="text" class="form-control" name="name" id="name">
                                <span class="text-danger error-text name_error_edit"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
