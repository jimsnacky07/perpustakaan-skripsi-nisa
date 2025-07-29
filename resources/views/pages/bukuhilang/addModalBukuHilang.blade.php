<!-- Modal -->
<div class="modal fade" id="addModalBukuHilang" tabindex="-1" aria-labelledby="addModalBukuHilangLabel" aria-hidden="true">
  <div class="modal-dialog">
      <form action="{{ route('buku-hilang.store') }}" method="POST" id="addFormBukuHilang">
          @csrf
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="addModalBukuHilangLabel">Tambah Data Buku Hilang</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-md-12 col-sm-12">
                          <div class="form-group">
                              <label for="judul_buku">Judul Buku</label>
                              <input type="text" class="form-control" name="judul_buku" required>
                              <span class="text-danger error-text judul_buku_error"></span>
                          </div>
                      </div>
                      <div class="col-md-12 col-sm-12">
                          <div class="form-group">
                              <label for="penerbit_buku">Penerbit Buku</label>
                              <input type="text" class="form-control" name="penerbit_buku">
                              <span class="text-danger error-text penerbit_buku_error"></span>
                          </div>
                      </div>
                      <div class="col-md-12 col-sm-12">
                          <div class="form-group">
                              <label for="pengarang_buku">Pengarang Buku</label>
                              <textarea name="pengarang_buku" id="pengarang_buku" class="form-control"></textarea>
                              <span class="text-danger error-text pengarang_buku_error"></span>
                          </div>
                      </div>
                      <div class="col-md-12 col-sm-12">
                          <div class="form-group">
                              <label for="tanggal_hilang">Tanggal Hilang</label>
                              <input type="date" class="form-control" name="tanggal_hilang" required>
                              <span class="text-danger error-text tanggal_hilang_error"></span>
                          </div>
                      </div>
                      <div class="col-md-12 col-sm-12">
                          <div class="form-group">
                              <label for="book_id">Buku Utama</label>
                              <select name="book_id" class="form-control" required>
                                  <option value="" disabled selected>Pilih Buku</option>
                                  @foreach($books ?? [] as $book)
                                      <option value="{{ $book->id }}">{{ $book->judul_buku }}</option>
                                  @endforeach
                              </select>
                              <span class="text-danger error-text book_id_error"></span>
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
