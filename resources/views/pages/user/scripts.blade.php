<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetchUser()

        function fetchUser() {
            let datatable = $('#tableUser').DataTable({

                processing: true,
                info: true,
                serverSide: true,

                ajax: {
                    url: "{{ route('user.fetch') }}",
                    type: "get"
                },
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            }).on('draw', function() {
                $('input[name="user_checkbox"]').each(function() {
                    this.checked = false;
                })

                $('input[name="main_checkbox"]').prop('checked', false);
                $('#deleteAll').addClass('d-none');
            });
        }

        //  Menyimpan Data User
        $(document).on('submit', '#addFormUser', function(e) {
            e.preventDefault();

            let dataForm = this;
            //  console.log(dataForm);
            $.ajax({
                type: $('#addFormUser').attr('method'),
                url: $('#addFormUser').attr('action'),
                data: new FormData(dataForm),
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#addFormUser').find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.error, function(prefix, val) {
                            $('#addFormUser').find('span.' + prefix + '_error')
                                .text(val[0]);
                        });
                    } else {
                        Swal.fire(
                            'Sukses',
                            response.success,
                            'success',
                        )
                        $('#addModalUser').modal('hide');
                        $('#tableUser').DataTable().ajax.reload(null, false);
                        $('#addFormUser')[0].reset();
                    }
                }
            });
        });

        //edit Data User
        $(document).on('click', '#btnEditUser', function(e) {
            e.preventDefault();

            let idUser = $(this).data('id')
            //  alert(idUser);

            $.get("{{ route('user.edit') }}", {
                    idUser: idUser
                },
                function(data) {
                    $('#editModalUser').modal('show');
                    $('#idUser').val(idUser);
                    $('#name').val(data.user.name);
                    $('#email').val(data.user.email);
                    $('#role').val(data.user.role);
                },
                "json"
            );
        });


        //  Update Data User
        $(document).on('submit', '#editFormUser', function(e) {
            e.preventDefault();

            let dataForm = this;
            //  console.log(dataForm);
            $.ajax({
                type: $('#editFormUser').attr('method'),
                url: $('#editFormUser').attr('action'),
                data: new FormData(dataForm),
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#editFormUser').find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.error, function(prefix, val) {
                            $('#editFormUser').find('span.' + prefix +
                                    '_error_edit')
                                .text(val[0]);
                        });
                    } else {
                        Swal.fire(
                            'Sukses',
                            response.success,
                            'success',
                        )
                        $('#editModalUser').modal('hide');
                        $('#tableUser').DataTable().ajax.reload(null, false);
                        $('#editFormUser')[0].reset();
                    }
                }
            });
        });

        //Delete Data User
        $(document).on('click', '#btnDeleteUser', function(e) {
            e.preventDefault();

            let idUser = $(this).data('id')
            //  console.log(idUser);

            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Kamu Ingin Menghapus Data Ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{ route('user.destroy') }}", {
                            idUser: idUser
                        },
                        function(data) {
                            if (data.status == 400) {
                                Swal.fire(
                                    'Error',
                                    data.error,
                                    'error'
                                )
                            } else {
                                Swal.fire(
                                        'Sukses',
                                        data.success,
                                        'success',
                                    ),
                                    $('#tableUser').DataTable().ajax.reload(null, false);
                            }
                        },
                        "json"
                    );
                }
            })
        });

        function toggleDeleteAllBtn() {
            if ($('input[name="user_checkbox"]:checked').length > 0) {
                $('#deleteAll').text('Hapus (' + $('input[name="user_checkbox"]:checked').length + ')')
                    .removeClass('d-none');
            } else {
                $('#deleteAll').addClass('d-none');
            }
        }

        $(document).on('click', '#main_checkbox', function() {
            if (this.checked) {
                $('input[name="user_checkbox"]').each(function() {
                    this.checked = true;
                });
            } else {
                $('input[name="user_checkbox"]').each(function() {
                    this.checked = false;
                });
            }
            toggleDeleteAllBtn();
        });

        $(document).on('click', '#user_checkbox', function() {
            if ($('input[name="user_checkbox"]').length == $('input[name="user_checkbox"]:checked')
                .length) {
                $('#main_checkbox').prop('checked', true);
            } else {
                $('#main_checkbox').prop('checked', false);
            }
            toggleDeleteAllBtn();
        });

        $(document).on('click', '#deleteAll', function(e) {
            e.preventDefault()

            let idUsers = []

            $('input[name="user_checkbox"]:checked').each(function() {
                idUsers.push($(this).data('id'));
            });

            //  alert(idUsers);
            if (idUsers.length > 0) {
                Swal.fire({
                    title: 'Apakah Kamu Yakin?',
                    html: "Kamu Ingin Menghapus <b>(" + idUsers.length + ")</b> Data User",
                    icon: 'warning',
                    showCancelButton: true,
                    showCloseButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Tidak',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("{{ route('user.destroySelected') }}", {
                                idUsers: idUsers
                            },
                            function(data) {
                                Swal.fire(
                                        'Sukses',
                                        data.success,
                                        'success',
                                    ),
                                    $('#tableUser').DataTable().ajax.reload(null, false);
                            },
                            "json"
                        );
                    }
                })
            }

        });
    });
</script>
