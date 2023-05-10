   @foreach ($tmp as $i => $a)
       <tr>
           <td>{{ $i + 1 }}</td>
           <td>{{ $a->isbn }}</td>
           <td>{{ $a->judul }}</td>
           <td>{{ $a->jumlah }}</td>
           <td>
               <a href="#" role="button" onclick="hapuss('<?= $a->id ?>')" class="btn btn-danger btn-xs"
                   id="hapusItem"><i class="fas fa-trash"></i></a>
           </td>
       </tr>
   @endforeach

   <script>
       function hapuss(id) {
           $.ajax({
               url: "delete-temp-item/" + id,
               type: 'GET',
               dataType: 'JSON',
               success: function(response) {
                   if (response.success == 200) {
                       $('#confirmasiItem').modal('hide');
                       load()
                   } else {
                       alert('Oppzz... Periksa Kembali Inputan');
                   }
               }
           });
       }
   </script>
