<?php
  $no = 1;
  foreach ($dataProduk->result() as $produk) {
?>
  <tr>
    <td><?php echo $no++; ?></td>
	  <td style="text-align: center;"><?= $produk->created_at ?></td> 
	  <td>
	  	<?php
	  		switch ($produk->status) {
	  			case 'pending':
	  				echo '<label class="label label-default">Pending</label>';
	  				break;

	  			case 'success':
	  				echo '<label class="label label-success">Success</label>';
	  				break;

	  			case 'cancel':
	  				echo '<label class="label label-danger">Cancel</label>';
	  				break;
	  			
	  			default:
	  				// code...
	  				break;
	  		}
	 		?>	
	  </td>
    <td><?= $produk->judul ?></td>
    <td><?= $produk->nama_binsis ?></td>
	  <td style="text-align: center;">
	  	<?php
	  		echo ($produk->jenis_transaksi == 'jual') ? '<label class="label label-danger">Jual</label>' : '<label class="label label-success">Beli</label>';
	  	?>
	  </td>
	  <td><?php echo $produk->lembar_saham; ?> Lembar</td>
	  <td><?php echo number_format($produk->harga_per_lembar, 0, ',', '.'); ?></td>
	  <td><?php echo number_format($produk->total, 0, ',', '.'); ?></td>
    <td class="text-center" style="min-width:270px;">
			<a href="<?php echo base_url() ?>TransaksiPasarSekunder/update/<?php echo $produk->id_dana ?>">
			<button class="btn btn-warning">
			<input type="hidden" name="id_produk" value="<?php echo $produk->id_produk ?>">
			<i class="glyphicon glyphicon-repeat"></i> Update
			</button>
			</a>
    </td>
  </tr>
<?php } ?>
