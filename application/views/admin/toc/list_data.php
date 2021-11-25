<?php
  $no=1;
  foreach ($dataToc->result() as $toc) {

    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $toc->title; ?></td>
      <td><?php echo date('d-m-Y', strtotime($toc->mulai_berlaku)); ?></td>
      <td><?php echo $toc->is_aktif == 1 ? 'Aktif' : 'Inactive'; ?></td>
      <td class="text-center">
        <!-- <a href="<?php echo base_url() ?>dana/detail/<?php //echo $dana->id_admin ?>">

          <button class="btn btn-success">
            <input type="hidden" name="id_admin" value="<?php //echo $dana->id_admin ?>">
            <i class="glyphicon glyphicon-fullscreen"></i> Detail
          </button>
        </a> -->

        <a href="<?php echo base_url() ?>toc/update/<?php echo $toc->id ?>">

          <button class="btn btn-warning">
            <input type="hidden" name="id_dana" value="<?php echo $toc->id ?>">
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
