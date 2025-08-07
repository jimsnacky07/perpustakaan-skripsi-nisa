<script>
  $(document).ready(function() {
      console.log('BukuHilang scripts loaded');
      
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      console.log('CSRF Token:', $('meta[name="csrf-token"]').attr('content'));

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

      // Auto-fill form fields when book is selected (Add Modal)
      $(document).on('change', '#book_id', function() {
          let selectedOption = $(this).find('option:selected');
          let judul = selectedOption.data('judul');
          let penerbit = selectedOption.data('penerbit');
          let pengarang = selectedOption.data('pengarang');
          let stok = selectedOption.data('stok');

          $('#judul_buku').val(judul);
          $('#penerbit_buku').val(penerbit);
          $('#pengarang_buku').val(pengarang);
          $('#stok_tersedia').text(stok);
          $('#jumlah_hilang').attr('max', stok);
      });

      // Auto-fill form fields when book is selected (Edit Modal)
      $(document).on('change', '#edit_book_id', function() {
          let selectedOption = $(this).find('option:selected');
          let judul = selectedOption.data('judul');
          let penerbit = selectedOption.data('penerbit');
          let pengarang = selectedOption.data('pengarang');
          let stok = selectedOption.data('stok');

          $('#edit_judul_buku').val(judul);
          $('#edit_penerbit_buku').val(penerbit);
          $('#edit_pengarang_buku').val(pengarang);
          $('#edit_stok_tersedia').text(stok);
          $('#edit_jumlah_hilang').attr('max', stok);
      });

      // Reset form when modal is closed
      $(document).on('hidden.bs.modal', '#addModalBukuHilang', function() {
          $('#addFormBukuHilang')[0].reset();
          $('#addFormBukuHilang').find('span.error-text').text('');
          $('#stok_tersedia').text('0');
      });

      // Test AJAX
      $(document).on('click', '#testAjax', function() {
          console.log('Testing AJAX...');
          $.ajax({
              type: 'GET',
              url: "{{ route('buku-hilang.test') }}",
              dataType: "json",
              success: function(response) {
                  console.log('Test AJAX Success:', response);
                  Swal.fire('Success', 'AJAX is working! User: ' + response.user + ', Role: ' + response.role, 'success');
              },
              error: function(xhr, status, error) {
                  console.error('Test AJAX Error:', xhr.responseText);
                  Swal.fire('Error', 'AJAX failed: ' + error, 'error');
              }
          });
      });

      // Test POST request
      $(document).on('click', '#testPost', function() {
          console.log('Testing POST request...');
          $.ajax({
              type: 'POST',
              url: "{{ route('buku-hilang.store') }}",
              data: {
                  _token: $('meta[name="csrf-token"]').attr('content'),
                  judul_buku: 'Test Book',
                  book_id: 1,
                  jumlah_hilang: 1,
                  keterangan: 'Test data'
              },
              dataType: "json",
              success: function(response) {
                  console.log('Test POST Success:', response);
                  Swal.fire('Success', 'POST request is working!', 'success');
              },
              error: function(xhr, status, error) {
                  console.error('Test POST Error:', xhr.responseText);
                  Swal.fire('Error', 'POST request failed: ' + error, 'error');
              }
          });
      });

      //  Menyimpan Data Buku Hilang
      $(document).on('submit', '#addFormBukuHilang', function(e) {
          e.preventDefault();

          // Client-side validation
          let bookId = $('#book_id').val();
          let judulBuku = $('#judul_buku').val();
          let jumlahHilang = $('#jumlah_hilang').val();
          let stokTersedia = parseInt($('#stok_tersedia').text());

          if (!bookId) {
              Swal.fire('Error', 'Pilih buku terlebih dahulu!', 'error');
              return;
          }

          if (!judulBuku) {
              Swal.fire('Error', 'Judul buku harus diisi!', 'error');
              return;
          }

          if (!jumlahHilang || jumlahHilang < 1) {
              Swal.fire('Error', 'Jumlah buku hilang minimal 1!', 'error');
              return;
          }

          if (parseInt(jumlahHilang) > stokTersedia) {
              Swal.fire('Error', 'Jumlah buku hilang tidak boleh melebihi stok yang tersedia!', 'error');
              return;
          }

          let dataForm = this;
          
          // Debug: Log form data
          let formData = new FormData(dataForm);
          console.log('Form data:');
          for (let pair of formData.entries()) {
              console.log(pair[0] + ': ' + pair[1]);
          }
          
          // Show loading
          Swal.fire({
              title: 'Menyimpan...',
              text: 'Mohon tunggu sebentar',
              allowOutsideClick: false,
              didOpen: () => {
                  Swal.showLoading();
              }
          });
          
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
                  Swal.close();
                  
                  if (response.status == 400) {
                      $.each(response.error, function(prefix, val) {
                          $('#addFormBukuHilang').find('span.' + prefix + '_error')
                              .text(val[0]);
                      });
                      Swal.fire('Error', 'Validasi gagal!', 'error');
                  } else if (response.status == 409) {
                      Swal.fire({
                          icon: 'error',
                          title: 'Gagal',
                          text: response.error.judul_buku[0],
                      });
                  } else if (response.status == 200) {
                      Swal.fire(
                          'Sukses',
                          response.success,
                          'success',
                      ).then(() => {
                          $('#addModalBukuHilang').modal('hide');
                          $('#addFormBukuHilang')[0].reset();
                          $('#stok_tersedia').text('0');
                          location.reload();
                      });
                  } else {
                      Swal.fire('Error', 'Terjadi kesalahan tidak diketahui!', 'error');
                  }
              },
              error: function(xhr, status, error) {
                  Swal.close();
                  console.error('AJAX Error:', xhr.responseText);
                  
                  let errorMessage = 'Terjadi kesalahan sistem!';
                  if (xhr.responseJSON && xhr.responseJSON.error) {
                      if (xhr.responseJSON.error.system) {
                          errorMessage = xhr.responseJSON.error.system[0];
                      } else {
                          errorMessage = Object.values(xhr.responseJSON.error)[0][0];
                      }
                  }
                  
                  Swal.fire('Error', errorMessage, 'error');
              }
          });
      });

      //edit Data Buku Hilang
      $(document).on('click', '#btnEditBukuHilang', function(e) {
          e.preventDefault();

          let idBukuHilang = $(this).data('id')

          $.get("{{ route('buku-hilang.edit') }}", {
                  idBukuHilang: idBukuHilang
              },
              function(data) {
                  $('#editModalBukuHilang').modal('show');
                  $('#idBukuHilang').val(idBukuHilang);
                  $('#edit_book_id').val(data.bukuHilang.book_id);
                  $('#edit_judul_buku').val(data.bukuHilang.judul_buku);
                  $('#edit_penerbit_buku').val(data.bukuHilang.penerbit_buku);
                  $('#edit_pengarang_buku').val(data.bukuHilang.pengarang_buku);
                  $('#edit_jumlah_hilang').val(data.bukuHilang.jumlah_hilang);
                  $('#edit_keterangan').val(data.bukuHilang.keterangan);
                  
                  // Update stok tersedia
                  let selectedOption = $('#edit_book_id').find('option:selected');
                  let stok = selectedOption.data('stok');
                  $('#edit_stok_tersedia').text(stok);
              },
              "json"
          );
      });

      //  Update Data Buku Hilang
      $(document).on('submit', '#editFormBukuHilang', function(e) {
          e.preventDefault();

          // Client-side validation
          let bookId = $('#edit_book_id').val();
          let judulBuku = $('#edit_judul_buku').val();
          let jumlahHilang = $('#edit_jumlah_hilang').val();
          let stokTersedia = parseInt($('#edit_stok_tersedia').text());

          if (!bookId) {
              Swal.fire('Error', 'Pilih buku terlebih dahulu!', 'error');
              return;
          }

          if (!judulBuku) {
              Swal.fire('Error', 'Judul buku harus diisi!', 'error');
              return;
          }

          if (!jumlahHilang || jumlahHilang < 1) {
              Swal.fire('Error', 'Jumlah buku hilang minimal 1!', 'error');
              return;
          }

          if (parseInt(jumlahHilang) > stokTersedia) {
              Swal.fire('Error', 'Jumlah buku hilang tidak boleh melebihi stok yang tersedia!', 'error');
              return;
          }

          let dataForm = this;
          
          // Show loading
          Swal.fire({
              title: 'Mengupdate...',
              text: 'Mohon tunggu sebentar',
              allowOutsideClick: false,
              didOpen: () => {
                  Swal.showLoading();
              }
          });
          
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
                  Swal.close();
                  
                  if (response.status == 400) {
                      $.each(response.error, function(prefix, val) {
                          $('#editFormBukuHilang').find('span.' + prefix +
                                  '_error_edit')
                              .text(val[0]);
                      });
                      Swal.fire('Error', 'Validasi gagal!', 'error');
                  } else if (response.status == 409) {
                      Swal.fire({
                          icon: 'error',
                          title: 'Gagal',
                          text: response.error.judul_buku[0],
                      });
                  } else if (response.status == 200) {
                      Swal.fire(
                          'Sukses',
                          response.success,
                          'success',
                      ).then(() => {
                          $('#editModalBukuHilang').modal('hide');
                          $('#editFormBukuHilang')[0].reset();
                          location.reload();
                      });
                  } else {
                      Swal.fire('Error', 'Terjadi kesalahan tidak diketahui!', 'error');
                  }
              },
              error: function(xhr, status, error) {
                  Swal.close();
                  console.error('AJAX Error:', xhr.responseText);
                  
                  let errorMessage = 'Terjadi kesalahan sistem!';
                  if (xhr.responseJSON && xhr.responseJSON.error) {
                      if (xhr.responseJSON.error.system) {
                          errorMessage = xhr.responseJSON.error.system[0];
                      } else {
                          errorMessage = Object.values(xhr.responseJSON.error)[0][0];
                      }
                  }
                  
                  Swal.fire('Error', errorMessage, 'error');
              }
          });
      });

      //Delete Data Buku Hilang
      $(document).on('click', '#btnDeleteBukuHilang', function(e) {
          e.preventDefault();

          let idBukuHilang = $(this).data('id')

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
