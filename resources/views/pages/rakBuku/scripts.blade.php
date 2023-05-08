<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetchRakBuku()

        function fetchRakBuku() {
            let datatable = $('#tableRakBuku').DataTable({

                processing: true,
                info: true,
                serverSide: true,

                ajax: {
                    url: "{{ route('rak-buku.fetch') }}",
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
                        data: 'no_rak',
                        name: 'no_rak'
                    },
                    {
                        data: 'nama_rak',
                        name: 'nama_rak'
                    },
                    {
                        data: 'kapasitas_rak',
                        name: 'kapasitas_rak'
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
        $(document).on('submit', '#addFormRakBuku', function(e) {
            e.preventDefault();

            let dataForm = this;
            //  console.log(dataForm);
            $.ajax({
                type: $('#addFormRakBuku').attr('method'),
                url: $('#addFormRakBuku').attr('action'),
                data: new FormData(dataForm),
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#addFormRakBuku').find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.error, function(prefix, val) {
                            $('#addFormRakBuku').find('span.' + prefix + '_error')
                                .text(val[0]);
                        });
                    } else {
                        Swal.fire(
                            'Sukses',
                            response.success,
                            'success',
                        )
                        $('#addModalRakBuku').modal('hide');
                        $('#tableRakBuku').DataTable().ajax.reload(null, false);
                        $('#addFormRakBuku')[0].reset();
                    }
                }
            });
        });

        //edit Data User
        $(document).on('click', '#btnEditRak', function(e) {
            e.preventDefault();

            let idRakBuku = $(this).data('id')
            //  alert(idRakBuku);

            $.get("{{ route('rak-buku.edit') }}", {
                    idRakBuku: idRakBuku
                },
                function(data) {
                    $('#editModalRakBuku').modal('show');
                    $('#idRakBuku').val(idRakBuku);
                    $('#no_rak').val(data.rakBuku.no_rak);
                    $('#nama_rak').val(data.rakBuku.nama_rak);
                    $('#kapasitas_rak').val(data.rakBuku.kapasitas_rak);
                },
                "json"
            );
        });


        //  Update Data User
        $(document).on('submit', '#editFormRakBuku', function(e) {
            e.preventDefault();

            let dataForm = this;
            //  console.log(dataForm);
            $.ajax({
                type: $('#editFormRakBuku').attr('method'),
                url: $('#editFormRakBuku').attr('action'),
                data: new FormData(dataForm),
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#editFormRakBuku').find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.error, function(prefix, val) {
                            $('#editFormRakBuku').find('span.' + prefix +
                                    '_error_edit')
                                .text(val[0]);
                        });
                    } else {
                        Swal.fire(
                            'Sukses',
                            response.success,
                            'success',
                        )
                        $('#editModalRakBuku').modal('hide');
                        $('#tableRakBuku').DataTable().ajax.reload(null, false);
                        $('#editFormRakBuku')[0].reset();
                    }
                }
            });
        });

        //Delete Data User
        $(document).on('click', '#btnDeleteRak', function(e) {
            e.preventDefault();

            let idRakBuku = $(this).data('id')
            //  console.log(idRakBuku);

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
                    $.post("{{ route('rak-buku.destroy') }}", {
                            idRakBuku: idRakBuku
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
                                    $('#tableRakBuku').DataTable().ajax.reload(null, false);
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

            let idRakBukus = []

            $('input[name="user_checkbox"]:checked').each(function() {
                idRakBukus.push($(this).data('id'));
            });

            //  alert(idRakBukus);
            if (idRakBukus.length > 0) {
                Swal.fire({
                    title: 'Apakah Kamu Yakin?',
                    html: "Kamu Ingin Menghapus <b>(" + idRakBukus.length + ")</b> Data User",
                    icon: 'warning',
                    showCancelButton: true,
                    showCloseButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Tidak',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("{{ route('rak-buku.destroySelected') }}", {
                                idRakBukus: idRakBukus
                            },
                            function(data) {
                                Swal.fire(
                                        'Sukses',
                                        data.success,
                                        'success',
                                    ),
                                    $('#tableRakBuku').DataTable().ajax.reload(null, false);
                            },
                            "json"
                        );
                    }
                })
            }

        });
    });
</script>
