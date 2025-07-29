<!-- Modal -->
<div class="modal fade" id="editModalBukuHilang" tabindex="-1" aria-labelledby="editModalBukuHilangLabel" aria-hidden="true">
  <div class="modal-dialog">
      <form action="{{ route('buku-hilang.update') }}" method="POST" id="editFormBukuHilang">
          @csrf
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="editModalBukuHilangLabel">Edit Data Buku Hilang</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <input type="hidden" name="idBukuHilang" id="idBukuHilang">
                      <div class="col-md-12 col-sm-12">
                          <div class="form-group">
                              <label for="editModalBukuHilangLabel">Judul Buku</label>
                              <input type="text" class="form-control" name="judul_buku" id="judul_buku">
                              <span class="text-danger error-text judul_buku_error_edit"></span>
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
