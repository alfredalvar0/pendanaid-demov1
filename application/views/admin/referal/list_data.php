<?php
  $no=1;
  foreach ($dataReferal->result() as $referal) {
    
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $referal->nama_pengguna; ?></td>
      <td><?php echo $referal->kode_referral; ?></td>
      
      <td class="text-center" style="min-width:270px;">
        

        <a href="<?php echo base_url() ?>referal/update/<?php echo $referal->id_referral ?>">

          <button class="btn btn-warning">
            <input type="hidden" name="id_referal" value="<?php echo $referal->id_referral ?>">
            <i class="glyphicon glyphicon-repeat"></i> Update
          </button>
        </a>
        
        
      </td>
    </tr>
    <?php
    $no++;
  }
?>
