<!-- Modal -->
<div class="modal fade" id="editModalUser" tabindex="-1" aria-labelledby="editModalUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('user.update') }}" method="POST" id="editFormUser">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalUserLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="idUser" id="idUser">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="editModalUserLabel">Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                                <span class="text-danger error-text name_error_edit"></span>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="editModalUserLabel">Email</label>
                                <input type="email" class="form-control" name="email" id="email">
                                <span class="text-danger error-text email_error_edit"></span>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="editModalUserLabel">role</label>
                                <select name="role" id="role" class="custom-select">
                                    <option value="anggota">Anggota</option>
                                    <option value="admin">Admin</option>
                                    <option value="pimpinan">Pimpinan</option>
                                </select>
                                <span class="text-danger error-text role_error_edit"></span>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="editModalUserLabel">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                                <span class="text-danger error-text password_error_edit"></span>
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
