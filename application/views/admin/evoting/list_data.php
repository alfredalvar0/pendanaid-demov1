<?php
  $no=1;
  foreach ($dataEvoting->result() as $evoting) {
    
	//get persentase
	// $opsi1 = $this->db->query("select count(*) as total from tbl_vote_pengguna where id_vote=".$evoting->id." and jawaban=1")->row()->total;
	// $opsi2 = $this->db->query("select count(*) as total from tbl_vote_pengguna where id_vote=".$evoting->id." and jawaban=2")->row()->total;
	// $opsi3 = $this->db->query("select count(*) as total from tbl_vote_pengguna where id_vote=".$evoting->id." and jawaban=3")->row()->total;
	// $opsi4 = $this->db->query("select count(*) as total from tbl_vote_pengguna where id_vote=".$evoting->id." and jawaban=4")->row()->total;

  for ($i=1; $i < 5; $i++) { 
		$opsi[$i] = $this->db->query("
			SELECT
				SUM(di.lembar_saham) AS lembar_saham
			FROM
				tbl_vote_pengguna vp
				LEFT JOIN tbl_vote v ON  v.id = vp.id_vote
				LEFT JOIN trx_dana_invest di ON di.id_produk = v.id_produk
			WHERE
				id_vote = ".$evoting->id." 
				AND jawaban = ".$i."
				AND di.id_pengguna = vp.id_pengguna
				AND di.status_approve = 'approve'
		")->row()->lembar_saham;
  }
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $evoting->produk; ?></td> 
	  <td><?php echo $evoting->judul; ?></td> 
	  <td>
	  	<?php echo $evoting->opsi1; ?>
	  	<br>
	  	<?php echo empty($opsi[1]) ? '(0 Lembar Saham)' : '(<a href="#" data-toggle="modal" data-target="#voteDetailModal" data-vote="'.$evoting->id.'" data-jawaban="1" class="btn-vote-detail">'.$opsi[1].' Lembar Saham</a>)'; ?>
	  </td>  
	  <td>
	  	<?php echo $evoting->opsi2; ?>
	  	<br>
	  	<?php echo empty($opsi[2]) ? '(0 Lembar Saham)' : '(<a href="#" data-toggle="modal" data-target="#voteDetailModal" data-vote="'.$evoting->id.'" data-jawaban="2" class="btn-vote-detail">'.$opsi[2].' Lembar Saham</a>)'; ?>
	  </td> 
	  <td>
	  	<?php echo $evoting->opsi3; ?>
	  	<br>
	  	<?php echo empty($opsi[3]) ? '(0 Lembar Saham)' : '(<a href="#" data-toggle="modal" data-target="#voteDetailModal" data-vote="'.$evoting->id.'" data-jawaban="3" class="btn-vote-detail">'.$opsi[3].' Lembar Saham</a>)'; ?>
	  </td> 
	  <td>
	  	<?php echo $evoting->opsi4; ?>
	  	<br>
	  	<?php echo empty($opsi[4]) ? '(0 Lembar Saham)' : '(<a href="#" data-toggle="modal" data-target="#voteDetailModal" data-vote="'.$evoting->id.'" data-jawaban="4" class="btn-vote-detail">'.$opsi[4].' Lembar Saham</a>)'; ?>
	  </td>  
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
