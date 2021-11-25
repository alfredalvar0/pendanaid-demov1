<?php
  $no=1;
  foreach ($dataDeposit->result() as $deposit) {
    
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $deposit->username; ?></td>
      <td><?php echo $deposit->nama_akun; ?></td> 
      <td><?php echo $deposit->nama_bank; ?></td>
      <td><?php echo $deposit->no_rek; ?></td>

      <?php if ($deposit->type_dana == 'tambah'){ ?>
        <td>Tambah</td>
      <?php }elseif($deposit->type_dana == 'tarik'){ ?>
        <td>Tarik</td>
      <?php }elseif($deposit->type_dana == 'promo'){ ?>
        <td>Promo</td>
      <?php }elseif($deposit->type_dana == 'referral'){ ?>
        <td>Referral</td>
      <?php } else { ?>
		  <td><?php echo $deposit->type_dana ?></td>
	  <?php } ?>

      <td>Rp. <?php echo number_format($deposit->jumlah_dana); ?></td>

      <?php if ($deposit->status_approve == 'refuse'){ ?>
        <td>Refuse</td>
      <?php }elseif($deposit->status_approve == 'approve'){ ?>
        <td>Approve</td>
      <?php }elseif($deposit->status_approve == 'pending'){ ?>
        <td>Pending</td>
      <?php } ?>
      <td><?php echo $deposit->createddate; ?></td>
      <td class="text-center" style="min-width:270px;">
        <!-- <a href="<?php echo base_url() ?>deposit/detail/<?php //echo $deposit->id_admin ?>">

          <button class="btn btn-success">
            <input type="hidden" name="id_admin" value="<?php //echo $deposit->id_admin ?>">
            <i class="glyphicon glyphicon-fullscreen"></i> Detail
          </button>
        </a> 

        <a href="<?php echo base_url() ?>deposit/update/<?php echo $deposit->id_deposit ?>">

          <button class="btn btn-warning">
            <input type="hidden" name="id_deposit" value="<?php echo $deposit->id_deposit ?>">
            <i class="glyphicon glyphicon-repeat"></i> Update
          </button>
        </a>-->
        
          <!-- <button class="btn btn-danger konfirmasiHapus-deposit" data-id="<?php //echo $deposit->id_admin; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete </button> -->
        
      </td>
    </tr>
    <?php
    $no++;
  }
?>
