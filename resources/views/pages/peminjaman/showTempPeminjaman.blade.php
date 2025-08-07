@if(count($tmp) > 0)
    @foreach ($tmp as $i => $a)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $a->isbn }}</td>
            <td>{{ $a->judul }}</td>
            <td>{{ $a->jumlah }}</td>
            <td>
                <a href="#" role="button" onclick="hapuss('{{ $a->id }}')" class="btn btn-danger btn-xs"
                    id="hapusItem" title="Hapus Item"><i class="fas fa-trash"></i></a>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" class="text-center">Tidak ada buku yang dipilih</td>
    </tr>
@endif

<script>
    function hapuss(id) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menghapus buku ini dari keranjang?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('hapus-temp-item', ':id') }}".replace(':id', id),
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.success == 200) {
                            Swal.fire('Berhasil!', 'Buku berhasil dihapus dari keranjang', 'success');
                            load();
                        } else {
                            Swal.fire('Error!', 'Gagal menghapus buku', 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'Terjadi kesalahan sistem', 'error');
                    }
                });
            }
        });
    }
</script>
