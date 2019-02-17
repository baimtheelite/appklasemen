<!-- Modal -->
<div class="modal fade" id="tambahPemain" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Pendaftaran Team</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <?= form_open_multipart('Klasemen/insert'); ?>
            <h1 class="text-center">Tambah Pemain</h1>
            <table class="table" id="dynamic_field">
                <tr>
                  <?= form_hidden('id_team', $tim->id_team); ?>
                  <td><?= form_input('pemain[0][nama_pemain]', set_value('nama_pemain'), 'class="form-control col-12" id="namaPemain" placeholder="Masukkan Nama Pemain" required') ?></td>
                  <td><?= form_input('pemain[0][nomor_punggung]', set_value('nomor_punggung'), 'class="form-control col-4" id="nomorPunggung" placeholder="No." required') ?></td>
                  <td><?= form_input('pemain[0][posisi]', set_value('posisi'), 'class="form-control col-6" id="posisi" placeholder="Posisi" required') ?></td>
                  <td><button type="button" name="add" id="add" class="btn btn-primary mx-auto">Tambah</button></td>
                </tr>
            </table>
              
              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button onclick="return confirm('Tambah Pemain')" name="insert_pemain" type="submit" class="btn btn-primary">Save changes</button>
        <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    var i = 1;
    $("#add").click(function(){
      i++;
      $("#dynamic_field").append('<tr id="row'+i+'">'+
                                    '<td><input type="text" name="pemain['+i+'][nama_pemain]" class="form-control col-12" placeholder="Masukkan Nama Pemain" required></td>'+
                                    '<td><input type="text" name="pemain['+i+'][nomor_punggung]" class="form-control col-4" placeholder="No." required></td>'+
                                    '<td><input type="text" name="pemain['+i+'][posisi]" class="form-control col-6" placeholder="Posisi" required></td>'+
                                    '<td><button class="btn btn-danger btn_remove" type="button" name="remove" id="'+i+'">X</button></td>'+
                                  '</tr>'
                                );
    })
    $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });
  })
</script>