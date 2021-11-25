<?php
if($data_produk->num_rows()>0){
	foreach($data_produk->result() as $dt){
		$foto=$dt->foto==""?"default.jpg":"produk/".$dt->foto;
		$img=base_url()."assets/img/".$foto;
		$result=get_headers($img);
		$res= stripos($result[0],"200 OK")?true:false;
		if(!$res){
			$img=base_url()."assets/img/default.jpg";
		}
		$date1 = date("Y-m-d");
		$date2 = $dt->tglakhir;
		
		$dStart = strtotime($date1);
		$dEnd = strtotime($date2);
		$dDiff = $dEnd - $dStart;
		
		$diff=$dDiff/(60*60*24);
		$url=base_url()."invest/detail/".$dt->siteurl."?type=sekunder";
		$persenterkumpul=($dt->terkumpul*100)/$dt->nilai_bisnis;
		
		$wh2=array();
		$wh2['status_approve']="approve";
		$wh2['id_produk']=$dt->id_produk;
		$total_invest= $this->m_invest->dataTotalinvest($wh2)->row();
		
		 
		//get total saham dijual
		$wh2['status_approve']="approve";
		$wh2['id_produk']=$dt->id_produk;
		$total_invest_sekunder= $this->m_invest->dataTotalinvestSekunder($wh2)->row();
		
		?>
		<div class="col-md-4 mt-4">
			<!--<div class="card <?php echo $dt->id_pengguna==$this->session->userdata("invest_pengguna")?"border border-success":"";?>">-->
			<div class="card ">
				<div class="container-produk">
					<a href="<?php echo $url; ?>">
					<img src="<?php echo $img; ?>" class="card-img-top" style="width: 100%;height: 250px;">
					<?php if($this->m_invest->checkRole()=="investor" && $this->session->userdata("invest_pengguna")!="" && isset($dt->invested) && $dt->invested>0){ 
						if($dt->status_approve=="approve"){
						?>
						<span class="invested">Invested</span>
						<?php 
						} else if($dt->status_approve=="pending"){
						?>
						<span class="invested">Pending</span>
						<?php 
						} else if($dt->status_approve=="complete"){
						?>
						<span class="invested">Complete</span>
						<?php 
						}
					} ?>
					<h4 class="bottom-left" style="color:white;text-shadow: 2px 2px black;"><?php echo $dt->judul; ?></h4>
					</a>
				</div>
				<div class="card-body">
					<a href="<?php echo $url; ?>" style="color:black;">
						<p class="mb-1" style="font-size:10px;"><b>Telah terkumpul <?php echo number_format($persenterkumpul,2); ?> % </b>  </p>
						<div class="progress mb-3">
						  <div class="progress-bar" role="progressbar" style="width: <?php echo $persenterkumpul; ?>%" aria-valuenow="<?php echo $persenterkumpul; ?>" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						
						<div class="row">
							<div class="col-8">
								<p style="font-size:14px;" class="mb-0"><b>Nilai Bisnis</b></p>
								<p style="font-size:14px;" class="mb-3">Rp. <?php echo number_format($dt->nilai_bisnis,2,".","."); ?></p>
							</div>
							<div class="col-4">
								<p style="font-size:14px;" class="mb-0"><b>Investor</b></p>
								<p style="font-size:14px;" class="mb-3"><?php 
								$wh2['status_approve']="approve";
								$wh2['id_produk']= $dt->id_produk;
								echo $this->m_invest->dataTotalinvestor($wh2)->num_rows();  ?> Orang</p>
							</div> 
							<div class="col-12">
								<p style="font-size:14px;" class="mb-0"><b>Dana Terkumpul</b></p>
								<p style="font-size:14px;" class="mb-3">Rp. <?php echo number_format($total_invest->total,2,".",".");?></p>
							</div>
							<div class="col-12">
								<p style="font-size:14px;" class="mb-0"><b>Saham Tersedia</b></p>
								<p style="font-size:14px;" class="mb-3"><?php echo  $total_invest_sekunder->lembar?> Lembar</p>
							</div>
							
						</div>
					</a>
				</div>
			</div>
		</div>
		<?php
	}
} else {
	?>
	<div class="col-md-12 mt-4">
		<h3 align="center">Data not Found</h3>
	</div>
	<?php
}
?>