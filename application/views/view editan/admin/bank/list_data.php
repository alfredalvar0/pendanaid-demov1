<?php
  $no=1;
  foreach ($dataBank->result() as $bank) {
    
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $bank->nama_bank; ?></td>
	  <td><?php echo $bank->no_rek; ?></td>
	  <td><?php echo $bank->atas_nama; ?></td>
      
      <td class="text-center" style="min-width:270px;">
        

        <a href="<?php echo base_url() ?>bank/update/<?php echo $bank->id_bank ?>">

          <button class="btn btn-warning">
            <input type="hidden" name="id_bank" value="<?php echo $bank->id_bank ?>">
            <i class="glyphicon glyphicon-repeat"></i> Update
          </button>
        </a>
        
          <button class="btn btn-danger konfirmasiHapus-bank" data-id="<?php echo $bank->id_bank; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete </button>
        
      </td>
    </tr>
    <?php
    $no++;
  }
?>
