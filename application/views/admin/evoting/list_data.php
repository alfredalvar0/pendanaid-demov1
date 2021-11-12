<?php
  $no=1;
  foreach ($dataEvoting->result() as $evoting) {
    
	//get persentase
	$opsi1 = $this->db->query("select count(*) as total from tbl_vote_pengguna where id_vote=".$evoting->id." and jawaban=1")->row()->total;
	$opsi2 = $this->db->query("select count(*) as total from tbl_vote_pengguna where id_vote=".$evoting->id." and jawaban=2")->row()->total;
	$opsi3 = $this->db->query("select count(*) as total from tbl_vote_pengguna where id_vote=".$evoting->id." and jawaban=3")->row()->total;
	$opsi4 = $this->db->query("select count(*) as total from tbl_vote_pengguna where id_vote=".$evoting->id." and jawaban=4")->row()->total;
	
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $evoting->produk; ?></td> 
	  <td><?php echo $evoting->judul; ?></td> 
	  <td><?php echo $evoting->opsi1; ?><br>(<?php echo $opsi1; ?>)</td>  
	  <td><?php echo $evoting->opsi2; ?><br>(<?php echo $opsi2; ?>)</td> 
	  <td><?php echo $evoting->opsi3; ?><br>(<?php echo $opsi3; ?>)</td> 
	  <td><?php echo $evoting->opsi4; ?><br>(<?php echo $opsi4; ?>)</td>  
	  <td><?php  if($evoting->status==0) echo "Aktif"; else echo "selesai"; ?></td>
	   <td><?php echo date('d F Y', strtotime($evoting->createddate)); ?></td> 
	   <td><?php echo !empty($evoting->expired_at) ? date('d F Y', strtotime($evoting->expired_at)) : ''; ?></td> 
      <td class="text-center" style="min-width:270px;">
        
		
	 
		
		 <a href="<?php echo base_url() ?>evoting/update/<?php echo $evoting->id ?>">

          <button class="btn btn-warning">
            <input type="hidden" name="id" value="<?php echo $evoting->id ?>">
            <i class="glyphicon glyphicon-repeat"></i> Update
          </button>
        </a>
        
          <button class="btn btn-danger konfirmasiHapus-evoting" data-id="<?php echo $evoting->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete </button>
  
      </td>
    </tr>
    <?php
    $no++;
  }
?>
