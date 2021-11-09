<br>
<!--==========================
   Home Section
============================-->
<section id="team" >
    <section style="background-color: rgb(214, 134, 44);">
        <div class="container" >
            <div class="section-header">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <h3 style="color:white;text-align: justify;" class="mt-3 mb-0">Portofolio</h3>
                    </div>
					<div class="col-md-6 mb-4" style="color:white;text-align: justify;" >
						<label>Dana Investasi</label><br/>
						<label>Rp. <?php echo number_format($totalInvest->total);?></label>
					</div>
					<div class="col-md-6 mb-4" style="color:white;text-align: justify;" >
						<label>Investasi on Proses</label><br/>
						<label>Rp. <?php echo number_format($totalInvestBerlangsung->total);?></label>
					</div>
					<div class="col-md-6 mb-4" style="color:white;text-align: justify;" >
						<label>Total Bagi hasil yang sudah diterima</label><br/>
						<label>Rp. <?php echo number_format($totalInvestbunga);?></label>
					</div>
					<div class="col-md-6 mb-4" style="color:white;text-align: justify;" >
						<label>Total pokok yang sudah diterima</label><br/>
						<label>Rp. <?php echo number_format($totalInvestPokok->total);?></label>
					</div>
                </div>
            </div>
        </div>
    </section>
	<div class="container mt-4">
		<nav class="nav nav-pills nav-justified mb-4">
		  <a class="nav-item nav-link active" data-toggle="tab" role="tab" aria-controls="berlangsung" aria-selected="true" href="#berlangsung" data-toggle="tab">Berlangsung (<?php echo count($data_berlangsung->result());?>)</a>
		  <!--
		  <a class="nav-item nav-link " data-toggle="tab" role="tab" aria-controls="telat" aria-selected="false" href="#telat" data-toggle="tab">Telat (<?php //echo count($data_telat->result());?>)</a>
		  -->
		  <a class="nav-item nav-link " data-toggle="tab" role="tab" aria-controls="lunas" aria-selected="false" href="#lunas" data-toggle="tab">Lunas (<?php echo count($data_lunas->result());?>)</a>
		</nav>
		<div class="tab-content" id="myTabContent">
		  <div class="tab-pane fade show active table-responsive" id="berlangsung" role="tabpanel" aria-labelledby="berlangsung-tab">
			<table class="table  mt-5">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Judul</th>
						<th scope="col">Nominal</th>
						<th scope="col">Bagi Hasil</th>
						<th scope="col">Kembali</th>
						<th scope="col">Frek. Angsuran</th>
						<th scope="col">Berakhir</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$num=0;
					foreach($data_berlangsung->result() as $par){
						$num++;
					
						?>
						<tr>
							<td><?php echo $num; ?></td>
							<td><a href="<?php echo base_url()?>invest/detail/<?php echo $par->siteurl; ?>"><?php echo $par->judul; ?></a></td>
							
							<td>Rp. <?php echo number_format($par->invested); ?></td>
							<td><?php echo $par->bagi_hasil; ?>%</td>
							<td>Rp. <?php echo number_format($par->invested+(($par->invested*$par->bagi_hasil)/100)); ?></td>
							<td><?php echo $par->frekuensi_angsuran; ?></td>
							<td><?php echo date('d F Y', strtotime($par->tglakhir)); ?></td>
							
						</tr>
						<?php
						
					}
					?>
				</tbody>
			</table>
		  </div>
		  <!-- 
		  <div class="tab-pane fade" id="telat" role="telat" aria-labelledby="telat-tab">
			<table class="table mt-5">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Judul</th>
						<th scope="col">Nominal</th>
						<th scope="col">Bagi Hasil</th>
						<th scope="col">Kembali</th>
						<th scope="col">Frek. Angsuran</th>
						<th scope="col">Berakhir</th>
						
					</tr>
				</thead>
				<tbody>
					<?php
					/* $num=0;
					foreach($data_telat->result() as $par){
						$num++;
					
						?>
						<tr>
							<td><?php echo $num; ?></td>
							<td><a href="<?php echo base_url()?>invest/detail/<?php echo $par->siteurl; ?>"><?php echo $par->judul; ?></a></td>
							
							<td>Rp. <?php echo number_format($par->invested); ?></td>
							<td><?php echo $par->bagi_hasil; ?>%</td>
							<td>Rp. <?php echo number_format($par->invested+(($par->invested*$par->bagi_hasil)/100)); ?></td>
							<td><?php echo $par->frekuensi_angsuran; ?></td>
							<td><?php echo date('d F Y', strtotime($par->tglakhir)); ?></td>
							
						</tr>
						<?php
						
					} */
					?>
				</tbody>
			</table>
		  </div>
		  -->
		  <div class="tab-pane fade" id="lunas" role="lunas" aria-labelledby="lunas-tab">
			<table class="table mt-5">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Judul</th>
						<th scope="col">Nominal</th>
						<th scope="col">Bagi Hasil</th>
						<th scope="col">Kembali</th>
						<th scope="col">Frek. Angsuran</th>
						<th scope="col">Berakhir</th>
						
					</tr>
				</thead>
				<tbody>
					<?php
					$num=0;
					foreach($data_lunas->result() as $par){
						$num++;
					
						?>
						<tr>
							<td><?php echo $num; ?></td>
							<td><a href="<?php echo base_url()?>invest/detail/<?php echo $par->siteurl; ?>"><?php echo $par->judul; ?></a></td>
							
							<td>Rp. <?php echo number_format($par->invested); ?></td>
							<td><?php echo $par->bagi_hasil; ?>%</td>
							<td>Rp. <?php echo number_format($par->invested+(($par->invested*$par->bagi_hasil)/100)); ?></td>
							<td><?php echo $par->frekuensi_angsuran; ?></td>
							<td><?php echo date('d F Y', strtotime($par->tglakhir)); ?></td>
							
						</tr>
						<?php
						
					}
					?>
				</tbody>
			</table>
		  </div>
		</div>
	</div>
</section>