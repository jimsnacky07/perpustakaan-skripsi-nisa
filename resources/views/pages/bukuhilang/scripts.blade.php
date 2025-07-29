<script>
  $(document).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      fetchBukuHilang()

      function fetchBukuHilang() {
          let datatable = $('#tableBukuHilang').DataTable({
              processing: true,
              info: true,
              serverSide: true,

              ajax: {
                  url: "{{ route('buku-hilang.fetch') }}",
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
                      data: 'judul_buku',
                      name: 'judul_buku'
                  },
                  {
                      data: 'penerbit_buku',
                      name: 'penerbit_buku'
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

      //  Menyimpan Data Buku Hilang
      $(document).on('submit', '#addFormBukuHilang', function(e) {
          e.preventDefault();

          let dataForm = this;
          //  console.log(dataForm);
          $.ajax({
              type: $('#addFormBukuHilang').attr('method'),
              url: $('#addFormBukuHilang').attr('action'),
              data: new FormData(dataForm),
              dataType: "json",
              processData: false,
              contentType: false,
              beforeSend: function() {
                  $('#addFormBukuHilang').find('span.error-text').text('');
              },
              success: function(response) {
                  if (response.status == 400) {
                      $.each(response.error, function(prefix, val) {
                          $('#addFormBukuHilang').find('span.' + prefix + '_error')
                              .text(val[0]);
                      });
                  } else {
                      Swal.fire(
                          'Sukses',
                          response.success,
                          'success',
                      )
                      $('#addModalBukuHilang').modal('hide');
                      $('#tableBukuHilang').DataTable().ajax.reload(null, false);
                      $('#addFormBukuHilang')[0].reset();
                  }
              }
          });
      });

      //edit Data Buku Hilang
      $(document).on('click', '#btnEditBukuHilang', function(e) {
          e.preventDefault();

          let idBukuHilang = $(this).data('id')
          //  alert(idBukuHilang);

          $.get("{{ route('buku-hilang.edit') }}", {
                  idBukuHilang: idBukuHilang
              },
              function(data) {
                  $('#editModalBukuHilang').modal('show');
                  $('#idBukuHilang').val(idBukuHilang);
                  $('#judul_buku').val(data.bukuHilang.judul_buku);
                  $('#penerbit_buku').val(data.bukuHilang.penerbit_buku);
              },
              "json"
          );
      });


      //  Update Data Buku Hilang
      $(document).on('submit', '#editFormBukuHilang', function(e) {
          e.preventDefault();

          let dataForm = this;
          //  console.log(dataForm);
          $.ajax({
              type: $('#editFormBukuHilang').attr('method'),
              url: $('#editFormBukuHilang').attr('action'),
              data: new FormData(dataForm),
              dataType: "json",
              processData: false,
              contentType: false,
              beforeSend: function() {
                  $('#editFormBukuHilang').find('span.error-text').text('');
              },
              success: function(response) {
                  if (response.status == 400) {
                      $.each(response.error, function(prefix, val) {
                          $('#editFormBukuHilang').find('span.' + prefix +
                                  '_error_edit')
                              .text(val[0]);
                      });
                  } else {
                      Swal.fire(
                          'Sukses',
                          response.success,
                          'success',
                      )
                      $('#editModalBukuHilang').modal('hide');
                      $('#tableBukuHilang').DataTable().ajax.reload(null, false);
                      $('#editFormBukuHilang')[0].reset();
                  }
              }
          });
      });

      //Delete Data Buku Hilang
      $(document).on('click', '#btnDeleteBukuHilang', function(e) {
          e.preventDefault();

          let idBukuHilang = $(this).data('id')
          //  console.log(idBukuHilang);

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
                  $.post("{{ route('buku-hilang.destroy') }}", {
                          idBukuHilang: idBukuHilang
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
                                  $('#tableBukuHilang').DataTable().ajax.reload(null,
                                      false);
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

          let idBukuHilangs = []

          $('input[name="user_checkbox"]:checked').each(function() {
              idBukuHilangs.push($(this).data('id'));
          });

          //  alert(idBukuHilangs);
          if (idBukuHilangs.length > 0) {
              Swal.fire({
                  title: 'Apakah Kamu Yakin?',
                  html: "Kamu Ingin Menghapus <b>(" + idBukuHilangs.length + ")</b> Data Ini",
                  icon: 'warning',
                  showCancelButton: true,
                  showCloseButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  cancelButtonText: 'Tidak',
                  confirmButtonText: 'Ya, Hapus!'
              }).then((result) => {
                  if (result.isConfirmed) {
                      $.post("{{ route('buku-hilang.destroySelected') }}", {
                              idBukuHilangs: idBukuHilangs
                          },
                          function(data) {
                              Swal.fire(
                                      'Sukses',
                                      data.success,
                                      'success',
                                  ),
                                  $('#tableBukuHilang').DataTable().ajax.reload(null,
                                      false);
                          },
                          "json"
                      );
                  }
              })
          }

      });
  });
</script>
