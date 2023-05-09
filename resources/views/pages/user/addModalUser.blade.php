<!-- Modal -->
<div class="modal fade" id="addModalUser" tabindex="-1" aria-labelledby="addModalUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('user.store') }}" method="POST" id="addFormUser">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalUserLabel">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="addModalUserLabel">Name</label>
                                <input type="text" class="form-control" name="name">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="addModalUserLabel">Email</label>
                                <input type="email" class="form-control" name="email" autocomplete="off">
                                <span class="text-danger error-text email_error"></span>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="addModalUserLabel">Role</label>
                                <select name="role" class="custom-select">
                                    <option value="" selected disabled>--Pilih Role--</option>
                                    <option value="0">Anggota</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Pimpinan</option>
                                </select>
                                <span class="text-danger error-text role_error"></span>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="addModalUserLabel">Password</label>
                                <input type="password" class="form-control" name="password" autocomplete="off">
                                <span class="text-danger error-text password_error"></span>
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
