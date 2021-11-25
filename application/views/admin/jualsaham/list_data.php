<?php
  $no=1;
  foreach ($dataJualSaham->result() as $dana) {

    ?>
    <tr>
      <td><?php echo $no; ?></td>
	  <td><?php echo $dana->id_jual; ?></td>
      <td><?php echo $dana->judul; ?></td>

       <td><?php echo $dana->nama_pengguna; ?></td> 
	   <td><?php echo $dana->lembar_saham; ?> Lembar</td>
      <td>Rp. <?php echo number_format($dana->jumlah_dana); ?></td>

      <?php if ($dana->status_approve == 'refuse'){ ?>
        <td>Refuse</td>
      <?php }elseif($dana->status_approve == 'approve'){ ?>
        <td>Approve</td>
      <?php }elseif($dana->status_approve == 'pending'){ ?>
        <td>Pending</td>
      <?php }elseif($dana->status_approve == 'complete'){ ?>
        <td>Complete</td>
      <?php } ?>
      <td><?php echo $dana->createddate; ?></td>
      <td class="text-center" style="min-width:270px;">
         <?php if($dana->status_approve == 'pending'){ ?>
        <a href="<?php echo base_url() ?>JualSaham/update/<?php echo $dana->id_jual ?>">
			
          <button class="btn btn-warning">
            <input type="hidden" name="id_jual" value="<?php echo $dana->id_jual ?>">
            <i class="glyphicon glyphicon-repeat"></i> Update
          </button>
        </a>
		 <?php } ?>
        
          <!-- <button class="btn btn-danger konfirmasiHapus-dana" data-id="<?php echo $dana->id_admin; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete </button> -->
        
      </td>
    </tr>
    <?php
    $no++;
  }
?>
