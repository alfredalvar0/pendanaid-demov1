 <br><br><br> 
<section id="team" >
    <div class="container"  >
       <div class="row">
			<div class="col-md-12 mt-5 text-center">
				<h3><b>Daftar Rekening Deposit</b></h3>
			</div>
			<?php foreach($data_rekening->result() as $val){?>
			<div class="col-md-12 mt-5 text-center">
				<h3><?php echo $val->nama_bank?></h3>
				<center>
				<table>
					<tr>
						<td><b>Nomor Rekening</b></td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo $val->no_rek?></td>
					</tr>
					<tr>
						<td><b>Atas Nama Rekening</b></td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo $val->atas_nama?></td>
					</tr>
				</table>
				</center>
			</div>
			<?php } ?>
			
			<div class="col-md-12 mt-5 text-center">
			<br><br> 
				<a href="<?php echo base_url()?>investor/dana_anda"><button type="button" class=" btn  btn-success"  >Mulai Deposit</button> </a>
			</div>
	   </div>
    </div>
</section>
<br><br><br><br>
  

  