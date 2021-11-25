<?php
  $no=1;
  foreach ($dataDanaInvest->result() as $dana) {

    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $dana->id_dana; ?></td>  
      <td><?php echo $dana->judul; ?></td>

      <td>Rp. <?php echo $dana->jumlah_dana; ?></td>

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
        <!-- <a href="<?php echo base_url() ?>dana/detail/<?php echo $dana->id_admin ?>">

          <button class="btn btn-success">
            <input type="hidden" name="id_admin" value="<?php echo $dana->id_admin ?>">
            <i class="glyphicon glyphicon-fullscreen"></i> Detail
          </button>
        </a> -->

        <a href="<?php echo base_url() ?>DanaInvest/update/<?php echo $dana->id_dana ?>">

          <button class="btn btn-warning">
            <input type="hidden" name="id_dana" value="<?php echo $dana->id_dana ?>">
            <i class="glyphicon glyphicon-repeat"></i> Update
          </button>
        </a>
        
          <!-- <button class="btn btn-danger konfirmasiHapus-dana" data-id="<?php echo $dana->id_admin; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete </button> -->
        
      </td>
    </tr>
    <?php
    $no++;
  }
?>
