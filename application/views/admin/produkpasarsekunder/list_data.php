<?php
  $no = 1;
  foreach ($dataProduk->result() as $produk) {
?>
  <tr>
    <td><?php echo $no++; ?></td>
	  <td style="text-align: center;">
	  	<?php
	  		echo ($produk->publish == '1') ? '<label class="label label-success">Ya</label>' : '<label class="label label-danger">Tidak</label>';
	  	?>
  	</td> 
	  <td><?php echo $produk->status_approve; ?></td>
    <td><?php echo $produk->judul; ?></td>
	  <td><?php echo $produk->nama_binsis; ?></td>
	  <td style="text-align: right;"><?php echo number_format($produk->harga_perlembar, 0, ',', '.'); ?></td>
	  <td style="text-align: right;"><?php echo number_format($produk->min_harga_perlembar, 0, ',', '.'); ?></td>
	  <td style="text-align: right;"><?php echo number_format($produk->maks_harga_perlembar, 0, ',', '.'); ?></td>
	  <td style="text-align: center;">
	  	<?php
	  		echo ($produk->jenis_kelipatan == 'nominal') ? 'Rp ' : '';
	  		echo number_format($produk->nilai_kelipatan, 0, ',', '.');
	  		echo ($produk->jenis_kelipatan == 'persen') ? '%' : '';
	  	?>
	  </td>
	  <td style="text-align: center;">
	  	<?php
	  		echo ($produk->jenis_biaya_admin == 'nominal') ? 'Rp ' : '';
	  		echo number_format($produk->nilai_biaya_admin, 0, ',', '.');
	  		echo ($produk->jenis_biaya_admin == 'persen') ? '%' : '';
	  	?>
	  </td>
	  <td style="text-align: center;">
	  	<?php
	  		echo ($produk->jenis_biaya_kustodian == 'nominal') ? 'Rp ' : '';
	  		echo number_format($produk->nilai_biaya_kustodian, 0, ',', '.');
	  		echo ($produk->jenis_biaya_kustodian == 'persen') ? '%' : '';
	  	?>
	  </td>
    <td class="text-center" style="min-width:270px;">
			<a href="<?php echo base_url() ?>ProdukPasarSekunder/update/<?php echo $produk->id_produk ?>?id=<?php echo $produk->id_bisnis ?>">
			<button class="btn btn-warning">
			<input type="hidden" name="id_produk" value="<?php echo $produk->id_produk ?>">
			<i class="glyphicon glyphicon-repeat"></i> Update
			</button>
			</a>
    </td>
  </tr>
<?php } ?>
