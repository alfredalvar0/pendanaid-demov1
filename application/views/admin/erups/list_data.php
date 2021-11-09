<?php
  $no=1;
  foreach ($dataErups->result() as $erups) {
    
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $erups->produk; ?></td> 
	  <td><?php echo $erups->judul; ?></td> 
	  <td><?php echo $erups->jam; ?></td>  
	   <td><?php echo date('d F Y', strtotime($erups->tanggal)); ?></td> 
	  <td><?php echo $erups->link; ?></td>
	  <td><?php  if($erups->status==0) echo "Aktif"; else echo "selesai"; ?></td>
      <td class="text-center" style="min-width:270px;">
        
		
	 
		
		 <a href="<?php echo base_url() ?>erups/update/<?php echo $erups->id ?>">

          <button class="btn btn-warning">
            <input type="hidden" name="id" value="<?php echo $erups->id ?>">
            <i class="glyphicon glyphicon-repeat"></i> Update
          </button>
        </a>
        
          <button class="btn btn-danger konfirmasiHapus-erups" data-id="<?php echo $erups->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete </button>
  
      </td>
    </tr>
    <?php
    $no++;
  }
?>
