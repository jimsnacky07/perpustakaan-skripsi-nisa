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
                              <label for="edit_book_id">Pilih Buku <span class="text-danger">*</span></label>
                              <select name="book_id" id="edit_book_id" class="form-control" required>
                                  <option value="" disabled selected>Pilih Buku</option>
                                  @foreach($books ?? [] as $book)
                                      <option value="{{ $book->id }}" 
                                          data-judul="{{ $book->judul_buku }}"
                                          data-penerbit="{{ $book->penerbit_buku }}"
                                          data-pengarang="{{ $book->pengarang_buku }}"
                                          data-stok="{{ $book->jumlah_buku }}">
                                          {{ $book->judul_buku }} (Stok: {{ $book->jumlah_buku }})
                                      </option>
                                  @endforeach
                              </select>
                              <span class="text-danger error-text book_id_error_edit"></span>
                          </div>
                      </div>
                      <div class="col-md-12 col-sm-12">
                          <div class="form-group">
                              <label for="edit_judul_buku">Judul Buku <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="judul_buku" id="edit_judul_buku" required readonly>
                              <span class="text-danger error-text judul_buku_error_edit"></span>
                          </div>
                      </div>
                      <div class="col-md-12 col-sm-12">
                          <div class="form-group">
                              <label for="edit_penerbit_buku">Penerbit Buku</label>
                              <input type="text" class="form-control" name="penerbit_buku" id="edit_penerbit_buku" readonly>
                              <span class="text-danger error-text penerbit_buku_error_edit"></span>
                          </div>
                      </div>
                      <div class="col-md-12 col-sm-12">
                          <div class="form-group">
                              <label for="edit_pengarang_buku">Pengarang Buku</label>
                              <input type="text" class="form-control" name="pengarang_buku" id="edit_pengarang_buku" readonly>
                              <span class="text-danger error-text pengarang_buku_error_edit"></span>
                          </div>
                      </div>
                      <div class="col-md-12 col-sm-12">
                          <div class="form-group">
                              <label for="edit_jumlah_hilang">Jumlah Buku Hilang <span class="text-danger">*</span></label>
                              <input type="number" class="form-control" name="jumlah_hilang" id="edit_jumlah_hilang" min="1" required>
                              <small class="form-text text-muted">Stok tersedia: <span id="edit_stok_tersedia">0</span></small>
                              <span class="text-danger error-text jumlah_hilang_error_edit"></span>
                          </div>
                      </div>
                      <div class="col-md-12 col-sm-12">
                          <div class="form-group">
                              <label for="edit_keterangan">Keterangan</label>
                              <textarea name="keterangan" id="edit_keterangan" class="form-control" rows="3" placeholder="Masukkan keterangan buku hilang..."></textarea>
                              <span class="text-danger error-text keterangan_error_edit"></span>
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
