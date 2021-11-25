<?php
  $no=1;
  foreach ($dataBroadcast->result() as $bc) {

    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $bc->broadcast_type; ?></td>
      <td><?php echo $bc->nama_bisnis; ?></td>
      <td><?php echo $bc->judul; ?></td>
      <td><?php echo $bc->subject; ?></td>
      <td><?php echo date('d-m-Y H:i:s', strtotime($bc->sent_time)); ?></td>
      <td class="text-center">
        <!-- <a href="<?php echo base_url() ?>dana/detail/<?php //echo $dana->id_admin ?>">

          <button class="btn btn-success">
            <input type="hidden" name="id_admin" value="<?php //echo $dana->id_admin ?>">
            <i class="glyphicon glyphicon-fullscreen"></i> Detail
          </button>
        </a> -->

        <a href="<?php echo base_url() ?>broadcast/detail/<?php echo $bc->id ?>">

          <button class="btn btn-warning btn-sm">
            <input type="hidden" name="id_broadcast" value="<?php echo $bc->id ?>">Detail
          </button>
        </a>

          <!-- <button class="btn btn-danger konfirmasiHapus-dana" data-id="<?php //echo $dana->id_admin; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete </button> -->

      </td>
    </tr>
    <?php
    $no++;
  }
?>
