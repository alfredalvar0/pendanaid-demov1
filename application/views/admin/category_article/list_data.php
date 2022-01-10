<?php
  $no=1;
  foreach ($category as $cat) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $cat->category; ?></td>
      <td>
        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#formAddModal" data-category="<?= $cat->category ?>" data-action="<?= base_url() ?>Article/category_update/<?= $cat->id ?>" data-label="Edit Category"><i class="glyphicon glyphicon-repeat"></i> Update</button>
        <a href="<?= base_url() ?>Article/category_delete/<?= $cat->id ?>" class="btn btn-danger btn-sm" onclick="javascript:return confirm('Anda Yakin ?')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
      </td>
    </tr>
    <?php
    $no++;
  }
?>
