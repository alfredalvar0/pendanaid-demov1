<?php
  $no=1;
  foreach ($dataProduk->result() as $produk) {
    // $tamp=$produk->gambar_ecommerce;
    ?>
    <tr>
      <td><?php echo $no; ?></td>
	  <td><?php echo $produk->status_approve; ?></td> 
 
      <td><?php echo $produk->judul; ?></td>
	  <td><?php echo $produk->nama_binsis; ?></td>
	  <td><?php echo $produk->nilai_bisnis; ?></td>
	  <td><?php echo $produk->lembar_saham; ?></td>
	  <td><?php echo $produk->harga_perlembar; ?></td>
	  <td><?php echo $produk->minimal_beli; ?></td>
	  <td><?php echo $produk->saham_dibagi; ?></td>
	  <td><?php echo $produk->finansial_dividen; ?></td>
	  <td><?php echo $produk->finansial_dividen_waktu; ?></td>
	  <td><?php echo $produk->finansial_rata; ?></td>
	  <td><?php echo $produk->finansial_balik_modal; ?></td>
	  <td><div class="break-word"><?php echo $produk->tentang_bisnis; ?></div></td>
	  <td><div class="break-word"><?php echo $produk->lokasi; ?></div></td>
	  <td><?php echo $produk->pemilik; ?></td>
	  <td><?php echo $produk->tglawal; ?></td>
	  <td><?php echo $produk->tglakhir; ?></td>
	  <td><?php if($produk->proposal!=""){?><a target="_blank" href="<?php echo base_url() ?>assets/img/produk/proposal/<?php echo $produk->proposal; ?>">Download</a><?php }else{echo "tidak ada";}?></td>
	  
	  <td><?php if($produk->foto!=""){?>
			<a target="_blank" href="<?php echo base_url() ?>assets/img/produk/<?php echo $produk->foto; ?>">
			<img src="<?php echo "assets/img/produk/".$produk->foto; ?>" style="width:100px; height:70px">
			</a>
		  <?php } ?>
		  <?php if($produk->foto2!=""){?>
			<a target="_blank" href="<?php echo base_url() ?>assets/img/produk/<?php echo $produk->foto2; ?>">
			<img src="<?php echo "assets/img/produk/".$produk->foto2; ?>" style="width:100px; height:70px">
			</a>
		  <?php } ?>
		  <?php if($produk->foto3!=""){?>
			<a target="_blank" href="<?php echo base_url() ?>assets/img/produk/<?php echo $produk->foto3; ?>">
			<img src="<?php echo "assets/img/produk/".$produk->foto3; ?>" style="width:100px; height:70px">
			</a>
		  <?php } ?>
		  </td>
	  <td><?php echo $produk->datecreated; ?></td>
      
      
      <td class="text-center" style="min-width:270px;">
		<a href="<?php echo base_url() ?>Produk/update/<?php echo $produk->id_produk ?>?id="<?php echo $produk->id_bisnis ?>>
          
          <button class="btn btn-warning">
            <input type="hidden" name="id_produk" value="<?php echo $produk->id_produk ?>">
            <i class="glyphicon glyphicon-repeat"></i> Update
          </button>
        </a>
		<?php
		if($produk->jum>0){
		?>
		<a href="<?php echo base_url() ?>Produk/history/<?php echo $produk->id_produk ?>" class="btn btn-success">
			<i class="fa fa-history"></i> History
		</a>
		<?php 
		}else{
		?>
        
        
          <button class="btn btn-danger konfirmasiHapus-produk" data-id="<?php echo $produk->id_produk; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
        <?php
		}
		?>
      </td>
    </tr>
    <?php
    $no++;
  }
?>
