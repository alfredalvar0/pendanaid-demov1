<?php
  $no=1;
  foreach ($dataLaporanbisnis->result() as $laporanbisnis) {

    ?>
    <tr>
      <td><?php echo $no; ?></td>
	  <td><?php echo $laporanbisnis->id; ?></td>
      <td><?php echo $laporanbisnis->judul; ?></td>
	   <td>Rp. <?php echo number_format($laporanbisnis->laba); ?></td>
       <td>Rp. <?php echo number_format($laporanbisnis->rugi); ?></td>
	   <td><?php echo $laporanbisnis->dividen; ?>%</td>
	   <td><?php echo $laporanbisnis->dividen_gadai; ?>%</td>
	   <td><?php echo date('d F Y', strtotime($laporanbisnis->createddate)); ?></td>
	   <td><a href="<?= base_url() ?>assets/attachment/laporan_bisnis/<?= $laporanbisnis->dokumen ?>" target="_blank"><?php echo $laporanbisnis->dokumen ?></a></td>
      <td class="text-center" style="min-width:270px;">


		<?php if( $laporanbisnis->status==0){ ?>

        <a href="<?php echo base_url() ?>laporanbisnis/share/<?php echo $laporanbisnis->id ?>">

          <button class="btn btn-success">
            <input type="hidden" name="id" value="<?php echo $laporanbisnis->id ?>">
            <i class="glyphicon glyphicon-send"></i> Share Profit
          </button>
        </a>


		 <a href="<?php echo base_url() ?>laporanbisnis/update/<?php echo $laporanbisnis->id ?>">

          <button class="btn btn-warning">
            <input type="hidden" name="id" value="<?php echo $laporanbisnis->id ?>">
            <i class="glyphicon glyphicon-repeat"></i> Update
          </button>
        </a>

          <button class="btn btn-danger konfirmasiHapus-laporanbisnis" data-id="<?php echo $laporanbisnis->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete </button>
        <?php }else{ ?>
		Dibagikan
		<?php } ?>
      </td>
    </tr>
    <?php
    $no++;
  }
?>
