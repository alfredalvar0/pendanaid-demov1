<?php
  $no=1;
  foreach ($dataBisnis->result() as $bisnis) {
    // $tamp=$bisnis->gambar_ecommerce;
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><img src="<?php echo "assets/img/bisnis/".$bisnis->foto; ?>" style="width:100px; height:70px"></td>
      
      <td><?php echo $bisnis->nama_binsis; ?></td>
	  <td><?php echo $bisnis->finansial_rata; ?></td>
	  <td><?php echo $bisnis->finansial_dividen; ?></td>
	  <td><?php echo $bisnis->finansial_dividen_waktu; ?></td>
	  <td><?php echo $bisnis->finansial_balik_modal; ?></td>	 
	  <td><?php echo $bisnis->kategori; ?></td>
	  <td><?php echo $bisnis->pemilik; ?></td>
	  <td><?php echo $bisnis->tahun_berdiri; ?></td>
	  <td><div class="break-word"> <?php echo $bisnis->tentang_bisnis  ?></div> </td>
	  <td><div class="break-word"> <?php echo $bisnis->lokasi; ?></div></td>
	  <td><?php echo $bisnis->datecreated; ?></td> 
      
 
     
      <td class="text-center" style="min-width:270px;">
		<a href="<?php echo base_url() ?>Produk?id=<?php echo $bisnis->id_bisnis ?>">
          
          <button class="btn btn-info">
            <input type="hidden" name="id_bisnis" value="<?php echo $bisnis->id_bisnis ?>">
            <i class="glyphicon glyphicon-th-list"></i> Daftar Bisnis
          </button>
        </a>
		
		<a href="<?php echo base_url() ?>Bisnis/update/<?php echo $bisnis->id_bisnis ?>">
          
          <button class="btn btn-warning">
            <input type="hidden" name="id_bisnis" value="<?php echo $bisnis->id_bisnis ?>">
            <i class="glyphicon glyphicon-repeat"></i> Update
          </button>
        </a>
		 
        <button class="btn btn-danger konfirmasiHapus-bisnis" data-id="<?php echo $bisnis->id_bisnis; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
        
      </td>
    </tr>
    <?php
    $no++;
  }
?>
