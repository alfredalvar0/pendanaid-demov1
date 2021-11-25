<?php
  $no=1;
  foreach ($dataSaldo->result() as $saldo) {

    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $saldo->nama_pengguna ?></td>
      <td><?php echo $saldo->username ?></td>
      <td>Rp. <?php echo number_format($saldo->saldo) ?></td>
      
    </tr>
    <?php
    $no++;
  }
?>
