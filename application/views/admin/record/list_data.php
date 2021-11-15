<?php
  $no=1;
  foreach ($dataRecord->result() as $rec) {

    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $rec->nama_pengguna ?></td>
      <td><?php echo $rec->record_type ?></td>
      <td><?php echo $rec->time ?></td>
      <td><?php echo $rec->device ?></td>
      <td><?php echo $rec->ip_address ?></td>
      <td><?php echo $rec->mac_address ?></td>
      <td><?php echo $rec->latitude ?></td>
      <td><?php echo $rec->longitude ?></td>

    </tr>
    <?php
    $no++;
  }
?>
