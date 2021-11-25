<section id="team" >
    <div class="container"  >
        <div class="section">
            <div class="row mt-5">
                <div class="col-12" >
                    <h3>My Invest</h3>
                </div>
            </div>
			<div class="row">
				<?php
				
				foreach($data_produk->result() as $dt){
					$foto=$dt->foto==""?"default.jpg":$dt->foto;
					
					$date1 = date("Y-m-d");
					$date2 = $dt->tglakhir;
					
					$dStart = strtotime($date1);
					$dEnd = strtotime($date2);
					$dDiff = $dEnd - $dStart;
					
					$diff=$dDiff/(60*60*24);
					$url=$diff>0?base_url()."invest/detail/".$dt->siteurl:"javascript:;";
					?>
					<div class="col-4">
						<div class="card" style="width: 18rem;">
							<div class="container-produk">
								<a href="<?php echo $url; ?>">
									<img src="<?php echo base_url() ?>assets/img/<?php echo $foto; ?>" class="card-img-top" style="width:100%;">
									<?php if($dt->invested>0){ ?>
									<span class="invested">Invested</span>
									<?php } ?>
									<h5 class="bottom-left" style="color:white;"><?php echo $dt->judul; ?></h5>
								</a>
							</div>
							<div class="card-body">
								<a href="<?php echo $url; ?>" style="color:black;">
									<p class="mb-1" style="font-size:10px;"><b>Telah terkumpul - % dari - lender</b> <span style="font-size:10px;" class="btn btn-danger"><?php echo $diff<=0?'Expired':$diff." hari lagi"; ?></span></p>
									<div class="progress mb-3">
									  <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<div class="row">
										<div class="col-6">
											<p style="font-size:10px;" class="mb-0">Jumlah pinjaman</p>
											<p style="font-size:10px;" class="mb-3">Rp. <?php echo number_format($dt->jumlah_investasi,0,".","."); ?></p>
										</div>
										<div class="col-6">
											<p style="font-size:10px;" class="mb-0">Tenor</p>
											<p style="font-size:10px;" class="mb-3"><?php echo $dt->tenor ?> bulan</p>
										</div>
										<div class="col-6">
											<p style="font-size:10px;" class="mb-0">Bunga Efektif</p>
											<p style="font-size:10px;" class="mb-3"><?php echo $dt->bagi_hasil; ?> %</p>
										</div>
										<div class="col-6">
											<p style="font-size:10px;" class="mb-0">Agunan</p>
											<p style="font-size:10px;" class="mb-3"><?php echo $dt->agunan ?></p>
										</div>
										<div class="col-6">
											<p style="font-size:10px;" class="mb-0">Frek. Angsuran pokok</p>
											<p style="font-size:10px;" class="mb-3"><?php echo $dt->pengembalian_pokok; ?></p>
										</div>
										<div class="col-6">
											<p style="font-size:10px;" class="mb-0">Frek. Angsuran bunga</p>
											<p style="font-size:10px;" class="mb-3"><?php echo $dt->frekuensi_angsuran; ?></p>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
					<?php
				}
				?>
			</div>
        </div>
    </div>
</section>