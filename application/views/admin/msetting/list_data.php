<?php
  $no=1;
  foreach ($dataMsetting->result() as $msetting) {
    
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $msetting->modul; ?></td>
      <td><?php echo $msetting->value; ?></td>
      
      <td class="text-center" style="min-width:270px;">
        

        <a href="<?php echo base_url() ?>msetting/update/<?php echo $msetting->id_setting ?>">

          <button class="btn btn-warning">
            <input type="hidden" name="id_setting" value="<?php echo $msetting->id_setting ?>">
            <i class="glyphicon glyphicon-repeat"></i> Update
          </button>
        </a>
        
          <!-- <button class="btn btn-danger konfirmasiHapus-msetting" data-id="<?php echo $msetting->id_setting; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete </button> -->
        
      </td>
    </tr>
    <?php
    $no++;
  }
?>
