<?php
  $no=1;
  foreach ($dataDana->result() as $dana) {
    
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $dana->username." (".$dana->login_from.")"; ?></td>
      <!-- <td><?php //echo $dana->nama_akun; ?></td> -->
      <td><?php echo $dana->nama_bank; ?></td>
      <td><?php echo $dana->no_rek; ?></td>

      <?php if ($dana->type_dana == 'tambah'){ ?>
        <td>Tambah</td>
      <?php }elseif($dana->type_dana == 'tarik'){ ?>
        <td>Tarik</td>
      <?php }elseif($dana->type_dana == 'promo'){ ?>
        <td>Promo</td>
      <?php }elseif($dana->type_dana == 'referral'){ ?>
        <td>Referral</td>
      <?php } else { ?>
		  <td><?php echo $dana->type_dana ?></td>
	  <?php } ?>

      <td>Rp. <?php echo $dana->jumlah_dana; ?></td>

      <?php if ($dana->status_approve == 'refuse'){ ?>
        <td>Refuse</td>
      <?php }elseif($dana->status_approve == 'approve'){ ?>
        <td>Approve</td>
      <?php }elseif($dana->status_approve == 'pending'){ ?>
        <td>Pending</td>
      <?php } ?>
      <td><?php echo $dana->createddate; ?></td>
      <td class="text-center" style="min-width:270px;">
        <!-- <a href="<?php echo base_url() ?>dana/detail/<?php //echo $dana->id_admin ?>">

          <button class="btn btn-success">
            <input type="hidden" name="id_admin" value="<?php //echo $dana->id_admin ?>">
            <i class="glyphicon glyphicon-fullscreen"></i> Detail
          </button>
        </a> -->

        <a href="<?php echo base_url() ?>dana/update/<?php echo $dana->id_dana ?>">

          <button class="btn btn-warning">
            <input type="hidden" name="id_dana" value="<?php echo $dana->id_dana ?>">
            <i class="glyphicon glyphicon-repeat"></i> Update
          </button>
        </a>
        
          <!-- <button class="btn btn-danger konfirmasiHapus-dana" data-id="<?php //echo $dana->id_admin; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete </button> -->
        
      </td>
    </tr>
    <?php
    $no++;
  }
?>
