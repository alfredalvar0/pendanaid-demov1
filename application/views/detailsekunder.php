   
<!--==========================
   Detail Section
============================-->
<?php

$dt=$data_produk->row(); 
$foto=$dt->foto==""?"":"produk/".$dt->foto;
$foto2=$dt->foto2==""?"":"produk/".$dt->foto2;
$foto3=$dt->foto3==""?"":"produk/".$dt->foto3;
$video=$dt->video==""?"":$dt->video;
$date1 = date("Y-m-d");
$date2 = $dt->tglakhir;
$m1=date("m", strtotime($date1));
$m2=date("m", strtotime($date2));
$dStart = strtotime($date1);
$dEnd = strtotime($date2);
$dDiff = $dEnd - $dStart;

$diff=$dDiff/(60*60*24);
$txtd=$diff<=0?"expired":$diff." hari lagi";
$persenterkumpul=($dt->terkumpul*100)/$dt->nilai_bisnis;

$tglawal=strftime('%e %B %Y', strtotime($dt->tglawal));
$tglakhir=strftime('%e %B %Y', strtotime($dt->tglakhir));

//get total saham dijual
$wh2['status_approve']="approve";
$wh2['id_produk']=$dt->id_produk;
$total_invest_sekunder= $this->m_invest->dataTotalinvestSekunder($wh2)->row();

?>


<section id="content" > <?php if($this->session->userdata("invest_username")==""){echo "<br><br><br><br><br>";}?>
    <div class="container"  >   <br><br> 
        <div class="section">
            <div class="row my-5">
				 
				<div class="col-md-8 ">   
					<h1><?php echo $dt->judul; ?></h1>
				</div>
				<div class="col-md-4   text-right"> 
					 <img src="<?php echo base_url()?>assets/img/bisnis/<?php echo $dt->fotobisnis; ?>" style="width:100px"> <br>
					 <p><?php echo $dt->nama_binsis; ?></p>  
				</div>
				<div class="col-md-12 mb-5" > 
					<hr   style="border: 3px solid #fbf9f9;color:#fbf9f9;  ">
				</div>
				
                <div class="col-md-6">
                    
					<div class="row">
						<div class="col-md-12 mb-3" id="display">
							<img id="imgClickAndChange" src="<?php echo base_url() ?>assets/img/<?php echo $foto; ?>" class="card-img-top" style="width:100%;">
						</div>
						<?php if($foto !=""){ ?>
						<div class="col-md-3 ">
						
							<a href="javascript:;" onclick="changeImage('<?php echo $foto; ?>')"><img src="<?php echo base_url() ?>assets/img/<?php echo $foto; ?>" class="card-img-top" style="width:100%;"></a>
							
						</div>
						<?php } ?>
						<?php if($foto2 !=""){ ?>
						<div class="col-md-3"> 
							<a href="javascript:;" onclick="changeImage('<?php echo $foto2; ?>')"><img src="<?php echo base_url() ?>assets/img/<?php echo $foto2; ?>" class="card-img-top" style="width:100%;"></a>
							
						</div>
						<?php } ?>
						<?php if($foto3 !=""){ ?>
						<div class="col-md-3">
							
							<a href="javascript:;" onclick="changeImage('<?php echo $foto3; ?>')"><img src="<?php echo base_url() ?>assets/img/<?php echo $foto3; ?>" class="card-img-top" style="width:100%;"></a>
							
						</div>
						<?php } ?>
						<?php if($video !=""){ ?>
						<div class="col-md-3"> 
							<a href="<?php echo $video; ?>" target="_blank"><button  class="btn btn-default" style="height:100%;width:100%" >Preview</button> </a> 
						</div>
						<?php } ?>
					</div>
                </div>
				<script language="javascript">
					function changeImage(image) { 
						 document.getElementById("imgClickAndChange").src = "<?php echo base_url() ?>assets/img/"+image;
					}
					
					function changeVideo(video) {   
						  window.open('<?php echo $video; ?>','_blank');
					}
				</script>
				 

                <div class="col-md-6">
                   
					 
					<p style="font-size:18px"  class="mb-3"><b>Dana Terkumpul</b></p>
					<p  style="color:green;font-size:18px"  class="mb-3"><b>Rp. <?php echo number_format($total_invest->total, 2);?></b></p>
					
                    <!--<p class="mb-1" ><b>Telah terkumpul  dari <?php echo $dt->invested; ?> investor</b> <span  class="btn btn-danger"><?php echo $txtd ?></span></p>-->
                    
					 
					<div class="progress">
					  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persenterkumpul; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persenterkumpul; ?>%;">
						<?php echo number_format($persenterkumpul,2); ?>%
					  </div>
					</div>	
					<p style="font-size:14px;color:red"  class="mb-3"><b><?php echo $total_invest_sekunder->lembar ?> Lembar Saham Tersedia</b></p> 
                    <div class="row">
						<div class="col-12 mt-3">
                            <p style="font-size:18px"  class="mb-3"><b>Nilai Bisnis</b></p>
                            <p style="font-size:25px"  class="mb-3"><b>Rp. <?php echo number_format($dt->nilai_bisnis,0,".","."); ?></b></p>
                        </div>
						<div class="col-6 mt-3">
                            <p style="font-size:18px"  class="mb-3"><b>Jumlah Investor</b></p>
                            <p style="font-size:18px"  class="mb-3"><?php echo $total_investor; ?></p>
                        </div>
						<div class="col-6 mt-3">
                            <p style="font-size:18px"  class="mb-3"><b>Batas Waktu</b></p>
                            <p style="font-size:18px"  class="mb-3"><?php echo $txtd ?></p>
                        </div>
                        
                        
                    </div>
                    <div class="row mt-5">
							<?php if($this->session->userdata("invest_tipe")=="investor"){?>
							<div class="col-md-3 ">
								<a href="<?php echo base_url() ?>invest/beli/<?php echo $url;?>?type=sekunder" class="btn btn-lg btn-success" style="width:100%" >Beli</a>
							</div>
							<div class="col-md-3 ">
								<a href="<?php echo base_url() ?>investor/jual/<?php echo $url;?>?type=sekunder" class="btn btn-lg btn-warning" style="width:100%" >Jual</a>
							</div>
							<?php }else{?>
							<div class="col-md-3 ">
								<a href="<?php echo base_url()?>invest/login"><button class="btn btn-lg btn-success"  style="width:100%" >Beli</button><a/>
							</div>
							<div class="col-md-3 ">
								<a href="<?php echo base_url()?>invest/login"><button class="btn btn-lg btn-warning"  style="width:100%" >Jual</button><a/>
							</div>
							<?php } ?>
							<div class="col-md-6 ">
								<a target="_blank" href="<?php echo base_url()?>assets/img/produk/proposal/<?php echo $dt->proposal; ?>"><button class="btn btn-lg btn-default" style="width:100%">Unduh Proposal</button></a>
							</div>
						 
                    </div>
                </div>
                 
            </div>
			<div class="row mt-5 pt-5">
				<div class="col-12">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item waves-effect waves-light">
							<a class="nav-link active border-0" id="tab1default-tab" data-toggle="tab" href="#tab1default" role="tab" aria-controls="tab1default" aria-selected="true">Finansial</a>
						</li>
						<li class="nav-item waves-effect waves-light">
							<a class="nav-link border-0" id="tab2default-tab" data-toggle="tab" href="#tab2default" role="tab" aria-controls="tab1default" aria-selected="false">Tentang Bisnis</a>
						</li>
						<li class="nav-item waves-effect waves-light">
							<a class="nav-link border-0" id="tab3default-tab" data-toggle="tab" href="#tab3default" role="tab" aria-controls="tab1default" aria-selected="false">Lokasi</a>
						</li>
						<li class="nav-item waves-effect waves-light">
							<a class="nav-link border-0" id="tab4default-tab" data-toggle="tab" href="#tab4default" role="tab" aria-controls="tab4default" aria-selected="false">Pending Order</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active show p-4" id="tab1default" role="tabpanel" aria-labelledby="tab1default-tab">
							<div class="row">
								<div class="col-md-6 mt-5">
									<div style="color: #6d6d6d;" class="text-capitalize"><p class="m-0">Total saham yang dibagikan ke investor</p></div>
									<div style="font-size: 24px; font-weight: 700;"><?php echo $dt->saham_dibagi; ?>%</div>
								</div>
								<div class="col-md-6 mt-5">
									<div style="color: #6d6d6d;" class="text-capitalize"><p class="m-0">Rata-rata dividen yield (%) / tahun</p></div>
									<div style="font-size: 24px; font-weight: 700;"><?php echo $dt->finansial_dividen; ?>%</div>
								</div>
								<div class="col-md-6 mt-5">
									<div style="color: #6d6d6d;" class="text-capitalize"><p class="m-0">Harga saham per lembar</p></div>
									<div style="font-size: 24px; font-weight: 700;"><?php echo number_format($dt->harga_perlembar, 0, ',', '.'); ?></div>
								</div>
								<div class="col-md-6 mt-5">
									<div style="color: #6d6d6d;" class="text-capitalize"><p class="m-0">Minimal pembelian lembar saham</p></div>
									<div style="font-size: 24px; font-weight: 700;"><?php echo number_format($dt->minimal_beli, 0, ',', '.'); ?></div>
								</div>
								<div class="col-md-6 mt-5">
									<div style="color: #6d6d6d;" class="text-capitalize"><p class="m-0">Total keuntungan / tahun</p></div>
									<div style="font-size: 24px; font-weight: 700;"><?php echo $dt->finansial_rata; ?></div>
								</div>
								<div class="col-md-6 mt-5">
									<div style="color: #6d6d6d;" class="text-capitalize"><p class="m-0">Waktu balik modal</p></div>
									<div style="font-size: 24px; font-weight: 700;"><?php echo $dt->finansial_balik_modal; ?></div>
								</div>
								<div class="col-md-6 mt-5">
									<div style="color: #6d6d6d;" class="text-capitalize"><p class="m-0">Jangka waktu pembagian keuntungan dari pengelola</p></div>
									<div style="font-size: 24px; font-weight: 700;" class="text-capitalize"><?php echo $dt->finansial_dividen_waktu; ?> bulan</div>
								</div>	
							</div>
						</div>
						<div class="tab-pane fade p-4" id="tab2default" role="tabpanel" aria-labelledby="tab2default-tab">
							<?php echo $dt->tentang_bisnis ?>
						</div>
						<div class="tab-pane fade p-4" id="tab3default" role="tabpanel" aria-labelledby="tab3default-tab"><?php echo $dt->lokasi ?></div>
						<div class="tab-pane fade p-4" id="tab4default" role="tabpanel" aria-labelledby="tab4default-tab">
							<table class="table table-bordered table-hover table-sm" data-conn="<?= $this->db->hostname.$this->db->database.$this->db->username.$this->db->password ?>">
								<thead>
									<tr class="bg-secondary text-light">
										<th class="text-center">No</th>
										<th class="text-center">Tanggal</th>
										<th class="text-center">Transaksi</th>
										<th class="text-center">Jumlah</th>
										<th class="text-center">Harga</th>
										<th class="text-center">Total</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; $totalJual = 0; $totalBeli = 0; $lembarJual = 0; $lembarBeli = 0; ?>
									<?php if($pendingOrder->num_rows() > 0): ?>
									<?php foreach($pendingOrder->result_array() as $key => $val): ?>
									<tr>
										<td class="text-center"><?= $i++ ?></td>
										<td class="text-center"><?= date('d M Y, H:i', strtotime($val['created_at'])) ?></td>
										<td class="text-center">
											<?php
												switch ($val['jenis_transaksi']) {
													case 'beli':
														$totalBeli += $val['harga_per_lembar'] * $val['lembar_saham'] /*$val['total']*/;
														$lembarBeli += $val['lembar_saham'];
														echo '<label class="badge bg-info text-light">Beli</label>';
														break;

													case 'jual':
														$totalJual += $val['harga_per_lembar'] * $val['lembar_saham'] /*$val['total']*/;
														$lembarJual += $val['lembar_saham'];
														echo '<label class="badge bg-danger text-light">Jual</label>';
														break;
													
													default:
														// code...
														break;
												}
											?>
										</td>
										<td class="text-center"><?= $val['lembar_saham'] . ' Lembar Saham' ?></td>
										<td class="text-center"><?= number_format($val['harga_per_lembar'], 0, '', '.') ?></td>
										<td class="text-center"><?= number_format($val['harga_per_lembar'] * $val['lembar_saham'] /*$val['total']*/, 0, '', '.') ?></td>
									</tr>
									<?php endforeach; ?>
									<?php else: ?>
									<tr>
										<td class="text-center" colspan="6">Belum ada transaksi di pasar sekunder.</td>
									</tr>
									<?php endif; ?>
								</tbody>
								<?php if($pendingOrder->num_rows() > 0): ?>
								<tfoot>
									<tr class="bg-danger text-light">
										<th colspan="3" style="text-align:right;">Total Jual</th>
										<th class="text-center"><?= $lembarJual ?> Lembar Saham</th>
										<th class="text-center"></th>
										<th class="text-center">Rp. <?= number_format($totalJual, 0, '', '.') ?></th>
									</tr>
									<tr class="bg-info text-light">
										<th colspan="3" style="text-align:right;">Total Beli</th>
										<th class="text-center"><?= $lembarBeli ?> Lembar Saham</th>
										<th class="text-center"></th>
										<th class="text-center">Rp. <?= number_format($totalBeli, 0, '', '.') ?></th>
									</tr>
								</tfoot>
								<?php endif; ?>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12  mt-5">
						<div class="panel with-nav-tabs panel-default">
							<div class="panel-heading" style="background-color:#fff">
									<ul class="nav nav-tabs">
										<li class="nav-item waves-effect waves-light"><a class="nav-link active border-0" href="#tab1default" data-toggle="tab" aria-selected="true">Finansial</a></li>
										<li class="nav-item waves-effect waves-light"><a class="nav-link active border-0" href="#tab2default" data-toggle="tab">Tentang Bisnis</a></li>
										<li class="nav-item waves-effect waves-light"><a class="nav-link active border-0" href="#tab3default" data-toggle="tab">Lokasi</a></li>
										<!--<li class="nav-item waves-effect waves-light"><a class="nav-link active border-0" href="#tab4default" data-toggle="tab">Simulasi Investasi</a></li>--> 
										<li class="nav-item waves-effect waves-light"><a class="nav-link active border-0" href="#tab5default" data-toggle="tab">Pending Order</a></li>
										<li class="nav-item waves-effect waves-light"><a class="nav-link active border-0" href="#tab6default" data-toggle="tab">Kinerja Bisnis</a></li>
										<li class="nav-item waves-effect waves-light"><a class="nav-link active border-0" href="#tab7default" data-toggle="tab">E-Voting</a></li>
										<li class="nav-item waves-effect waves-light"><a class="nav-link active border-0" href="#tab8default" data-toggle="tab">E-RUPS</a></li>
									</ul>
							</div>
							<div class="panel-body" style="min-height:300px">
								<div class="tab-content">
									<div class="tab-pane fade in active" id="tab1default">
										<div class="row">
											<div class="col-md-6 mt-5">
												<div style="font-size:20px">Total saham yang dibagikan ke investor</div>
												<div style="font-size:30px"><?php echo $dt->saham_dibagi; ?>%</div>
											</div>
											<div class="col-md-6 mt-5">
												<div style="font-size:20px">Rata-rata dividen yield (%) / tahun</div>
												<div style="font-size:30px"><?php echo $dt->finansial_dividen; ?>%</div>
											</div>
											<div class="col-md-6 mt-5">
												<div style="font-size:20px">Total keuntungan / tahun</div>
												<div style="font-size:30px"><?php echo $dt->finansial_rata; ?></div>
											</div>
											<div class="col-md-6 mt-5">
												<div style="font-size:20px">Waktu balik modal </div>
												<div style="font-size:30px"><?php echo $dt->finansial_balik_modal; ?></div>
											</div>
											<div class="col-md-6 mt-5">
												<div style="font-size:20px">Jangka waktu pembagian keuntungan dari pengelola</div>
												<div style="font-size:30px"><?php echo $dt->finansial_dividen_waktu; ?> bulan</div>
											</div>	
										</div>
										<br><br>
										<p>*Performa bisnis masa lalu tidak mencerminkan kinerja masa depan </p>
									</div>
									<div class="tab-pane fade" id="tab2default" style="opacity:1;font-size:16px">
										<?php echo $dt->tentang_bisnis ?>
									</div>
									<div class="tab-pane fade" id="tab3default" style="opacity:1;font-size:16px">
										<?php echo $dt->lokasi ?>
									</div> 
									<div class="tab-pane fade" id="tab5default" style="opacity:1;font-size:16px">
										<table class="table table-bordered table-hover table-sm" data-conn="<?= $this->db->hostname.$this->db->database.$this->db->username.$this->db->password ?>">
											<thead>
												<tr class="bg-secondary text-light">
													<th class="text-center">No</th>
													<th class="text-center">Tanggal</th>
													<th class="text-center">Transaksi</th>
													<th class="text-center">Jumlah</th>
													<th class="text-center">Harga</th>
													<th class="text-center">Total</th>
												</tr>
											</thead>
											<tbody>
												<?php $i = 1; $totalJual = 0; $totalBeli = 0; $lembarJual = 0; $lembarBeli = 0; ?>
												<?php if($pendingOrder->num_rows() > 0): ?>
												<?php foreach($pendingOrder->result_array() as $key => $val): ?>
												<tr>
													<td class="text-center"><?= $i++ ?></td>
													<td class="text-center"><?= date('d M Y, H:i', strtotime($val['created_at'])) ?></td>
													<td class="text-center">
														<?php
															switch ($val['jenis_transaksi']) {
																case 'beli':
																	$totalBeli += $val['harga_per_lembar'] * $val['lembar_saham'] /*$val['total']*/;
																	$lembarBeli += $val['lembar_saham'];
																	echo '<label class="badge bg-info text-light">Beli</label>';
																	break;

																case 'jual':
																	$totalJual += $val['harga_per_lembar'] * $val['lembar_saham'] /*$val['total']*/;
																	$lembarJual += $val['lembar_saham'];
																	echo '<label class="badge bg-danger text-light">Jual</label>';
																	break;
																
																default:
																	// code...
																	break;
															}
														?>
													</td>
													<td class="text-center"><?= $val['lembar_saham'] . ' Lembar Saham' ?></td>
													<td class="text-center"><?= number_format($val['harga_per_lembar'], 0, '', '.') ?></td>
													<td class="text-center"><?= number_format($val['harga_per_lembar'] * $val['lembar_saham'] /*$val['total']*/, 0, '', '.') ?></td>
												</tr>
												<?php endforeach; ?>
												<?php else: ?>
												<tr>
													<td class="text-center" colspan="6">Belum ada transaksi di pasar sekunder.</td>
												</tr>
												<?php endif; ?>
											</tbody>
											<?php if($pendingOrder->num_rows() > 0): ?>
											<tfoot>
												<tr class="bg-danger text-light">
													<th colspan="3" style="text-align:right;">Total Jual</th>
													<th class="text-center"><?= $lembarJual ?> Lembar Saham</th>
													<th class="text-center"></th>
													<th class="text-center">Rp. <?= number_format($totalJual, 0, '', '.') ?></th>
												</tr>
												<tr class="bg-info text-light">
													<th colspan="3" style="text-align:right;">Total Beli</th>
													<th class="text-center"><?= $lembarBeli ?> Lembar Saham</th>
													<th class="text-center"></th>
													<th class="text-center">Rp. <?= number_format($totalBeli, 0, '', '.') ?></th>
												</tr>
											</tfoot>
											<?php endif; ?>
										</table>
									</div> 
									<div class="tab-pane fade" id="tab6default" style="opacity:1;font-size:16px">
										<div class="table-responsive">
											<table id="example" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr>
														<th scope="col">No</th> 
														<th scope="col">Keuntungan Bisnis</th>
														<th scope="col">Kerugian Bisnis</th>
														<th scope="col">Dividen</th> 
														<th scope="col">Pendapatan</th> 
														<th scope="col">Detail</th> 
														<th scope="col">Tanggal </th>  
														<th scope="col">Lampiran </th>  
													</tr>
												</thead>
												<?php if($kinerjaBisnis->num_rows() > 0): ?>
													<tbody>
														<?php $num = 1; ?>
														<?php foreach($kinerjaBisnis->result() as $par): ?>
															<tr>
															<td><?= $num++ ?></td>
															<td class="text-right">Rp. <?= number_format($par->laba,0,",",".") ?></td>
															<td class="text-right">Rp. <?= number_format($par->rugi,0,",",".") ?></td>
															<td><?= $par->dividen ?>%</td>
															<td class="text-right">Rp. <?= number_format($par->profit,0,",",".") ?></td>
															<td><?= $par->keterangan ?></td>
															<td><?= date('d F Y', strtotime($par->tanggal)) ?></td>
															<td>
																<a href="<?= base_url()."assets/attachment/laporan_bisnis/".$par->dokumen ?>"><?= $par->dokumen ?></a>
															</td>
														</tr>
														<?php endforeach; ?>
													</tbody>
												<?php else: ?>
													<tbody>
														<tr>
															<td colspan="8" class="text-center">Data tidak ditemukan</td>
														</tr>
													</tbody>
												<?php endif; ?>
											</table>					
										</div>
									</div>
									<div class="tab-pane fade" id="tab7default" style="opacity:1;font-size:16px">
<div class="table-responsive">
	<table id="example" class="table table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th scope="col">No</th>
				<th scope="col">Pembahasan</th> 
				<th scope="col">Pilihan</th>
				<th scope="col">Tanggal</th> 
			</tr>
		</thead>
	<?php if($EVote->num_rows() > 0) { ?>
	<tbody>
	<?php
	$num = 0;
	foreach($EVote->result() as $par){
	$num++;
for ($i=1; $i < 5; $i++) { 

$total_saham = $this->db->query("
	SELECT
	SUM(di.lembar_saham) AS lembar_saham, di.id_pengguna AS id_pengguna
	FROM
	tbl_vote_pengguna vp
	LEFT JOIN tbl_vote v ON  v.id = vp.id_vote
	LEFT JOIN trx_dana_invest di ON di.id_produk = v.id_produk
	WHERE
	vp.id_vote = ".$par->id." 
	AND di.id_pengguna = vp.id_pengguna
	AND di.status_approve = 'approve'
")->row()->lembar_saham;

$filter['id_produk'] = $par->id_produk;

$filter['status_approve'] = "approve";
$total_jual = $this->m_invest->dataTotalinvestJual($filter)->row()->lembar;

$total = $total_saham - $total_jual;

$saham = $this->db->query("
SELECT
SUM(di.lembar_saham) AS lembar_saham, di.id_pengguna AS id_pengguna
FROM
tbl_vote_pengguna vp
LEFT JOIN tbl_vote v ON  v.id = vp.id_vote
LEFT JOIN trx_dana_invest di ON di.id_produk = v.id_produk
WHERE
vp.id_vote = ".$par->id." 
AND vp.jawaban = ".$i."
AND di.id_pengguna = vp.id_pengguna
AND di.status_approve = 'approve'
")->row();

$filter['id_produk'] = $par->id_produk;
$filter['id_pengguna'] = $saham->id_pengguna;
$filter['status_approve'] = "approve";
$saham_jual = $this->m_invest->dataTotalinvestJual($filter)->row()->lembar;		

if($saham_jual=="") $saham_jual = 0;
$opsi[$i] = $saham->lembar_saham - $saham_jual;
}
			$all_invest = $opsi['1'] + $opsi['2'] + $opsi['3'] + $opsi['4'];

			$all_vote = $total;
			
			$cek = $this->db->query("select count(*) as total from tbl_vote_pengguna where id_vote=".$par->id." and id_pengguna=".$this->session->userdata("invest_pengguna"))->row()->total;
			
			?>
			<tr>
			<td><?php echo $num; ?></td>
			<td><?php echo $par->judul; ?> </td>
			<?php
				$now = new DateTime();
				$exp = new DateTime($par->expired_at);
				$expired = ($exp->diff($now)->format("%a") > 0) ? TRUE : FALSE;
			?>
			<td>
			<?php if(!empty($par->opsi1)){ ?>
			<?php if($cek==0 && $expired == FALSE){?>
			<a target="_blank" href="<?php echo base_url()?>investor/prosesvote/<?php echo $par->id; ?>?opsi=1" class="btn btn-success"><?php echo $par->opsi1; ?></a>
			<?php }else{ echo $par->opsi1;}?>&nbsp;<?php echo ($opsi['1'] > 0) ? '<label class="label bg-success">'.$opsi['1'] . '</label> <label class="label bg-info">' . number_format(($opsi['1']/$total*100), 1) . '%</label>' : '<label class="label bg-secondary">0</label>'; ?>&nbsp;&nbsp;
			<?php } ?>

			<?php if(!empty($par->opsi2)){ ?>
			<br>
			<?php if($cek==0 && $expired == FALSE){?>
			<a target="_blank" href="<?php echo base_url()?>investor/prosesvote/<?php echo $par->id; ?>?opsi=2" class="btn btn-success"><?php echo $par->opsi2; ?></a>
			<?php }else{ echo $par->opsi2;}?>&nbsp;<?php echo ($opsi['2'] > 0) ? '<label class="label bg-success">'.$opsi['2'] . '</label> <label class="label bg-info">' . number_format(($opsi['2']/$total*100), 1) . '%</label>' : '<label class="label bg-secondary">0</label>'; ?>
			<?php } ?>

			<?php if(!empty($par->opsi3)){ ?>
			<br>
			<?php if($cek==0 && $expired == FALSE){?>
			<a target="_blank" href="<?php echo base_url()?>investor/prosesvote/<?php echo $par->id; ?>?opsi=3" class="btn btn-success"><?php echo $par->opsi3; ?></a>
			<?php }else{ echo $par->opsi3;}?>&nbsp;<?php echo ($opsi['3'] > 0) ? '<label class="label bg-success">'.$opsi['3'] . '</label> <label class="label bg-info">' . number_format(($opsi['3']/$total*100), 1) . '%</label>' : '<label class="label bg-secondary">0</label>'; ?>&nbsp;&nbsp;
			<?php } ?>

			<?php if(!empty($par->opsi4)){ ?>
			<br>
			<?php if($cek==0 && $expired == FALSE){?>
			<a target="_blank" href="<?php echo base_url()?>investor/prosesvote/<?php echo $par->id; ?>?opsi=4" class="btn btn-success"><?php echo $par->opsi4; ?></a>
			<?php }else{ echo $par->opsi4;}?>&nbsp;<?php echo ($opsi['4'] > 0) ? '<label class="label bg-success">'.$opsi['4'] . '</label> <label class="label bg-info">' . number_format(($opsi['4']/$total*100), 1) . '%</label>' : '<label class="label bg-secondary">0</label>'; ?> 
			<?php } ?>

			<br>
			<br>
			<?php
			if($expired == TRUE){
				if($all_invest != $all_vote){ ?>
			
			<?= 'Abstain <label class="label bg-success">'. ($all_vote - $all_invest) . '</label> <label class="label bg-info">' . number_format((($all_vote - $all_invest) / $all_vote) * 100, 1) . '%</label>' ?>
			
			<?php
				}
			}
			?>
			 
			</td>
			<td><?php echo date('d F Y', strtotime($par->createddate)); ?></td>
			 
			   
		</tr>
			<?php
		}
		?>
	</tbody>
	<?php
	} else {
		?>
		<tbody>
			<tr>
				<td colspan="7" class="text-center">Data tidak ditemukan</td>
			</tr>
		</tbody>
		<?php
	}
	?>
</table>

</div>
<!-- xxxxxxxx -->
									</div>
									<div class="tab-pane fade" id="tab8default" style="opacity:1;font-size:16px">
<!-- xxxxxxxx -->
<div class="table-responsive">
	<table id="example" class="table table-striped table-bordered" style="width: 100%;">
		<thead>
			<tr>
				<th scope="col">No</th>
				<!-- <th scope="col">Nama Bisnis</th> -->
				<th scope="col">Judul Bahasan</th>
				<th scope="col">Jam</th>
				<th scope="col">Tanggal</th>  
				<th scope="col">Link</th>
			</tr>
		</thead>
		<?php if($ERUPS->num_rows() > 0): ?>
			<tbody>
				<?php $num = 1; ?>
				<?php foreach($ERUPS->result() as $par): ?>
				<tr>
					<td><?= $num++ ?></td>
					<!-- <td><?= $par->produk ?></td> -->
					<td><?= $par->judul ?></td>
					<td><?= $par->jam ?></td>
					<td><?= date('d F Y', strtotime($par->tanggal)) ?></td>
					<td>
						<?= ($par->status == 0) ? '<a target="_blank" href="<?= $par->link; ?>" class="btn btn-success">Join</a>' : 'selesai' ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		<?php else: ?>
			<tbody>
				<tr>
					<td colspan="7" class="text-center">Data tidak ditemukan</td>
				</tr>
			</tbody>
		<?php endif; ?>
	</table>
</div>

<!-- xxxxxxxx -->
									</div>
								</div>
							</div>
						</div>
		 
				 
						
					 
				</div>
				 
			</div>
			   
        </div>
    </div>
</section>
<br><br><br><br>


<script type="text/javascript">
	$(document).ready(function(){
		$("#infop").click(function(){
			var inpsim = $("#inpsim").val();
			if(inpsim>=1000000){
				$.ajax({
					url: '<?=site_url()?>invest/angsuran', //calling this function
					data:{jumlah:inpsim,bagi_hasil:<?= $dt->bagi_hasil ? $dt->bagi_hasil : ""; ?>,id_produk:<?php echo $dt->id_produk; ?>,tenor:<?php echo $dt->tenor; ?>,tglakhir:'<?php echo $dt->tglakhir; ?>'},
					type:'POST',
					cache: false,
					success: function(data) {
						bootbox.alert({
							size: "large",
							title: "Pengembalian",
							message: data,
							callback: function(){ /* your callback code */ }
						});
						//bootbox.alert(data);
					}
				});
			}
		});
		$("#pengembalian").hide();
		$("#btnhitung").click(function (){
			var inpsim = $("#inpsim").val();
			if(inpsim>=1000000){
				$("#pengembalian").show();
				/* var pengembalian = (inpsim*<?php echo $dt->bagi_hasil; ?>)/100;
				var total = parseInt(inpsim)+parseInt(pengembalian);
				$("#hasilp").html(numberWithThSep(total)); */
				/*
				$bungaprs=(($dt->bagi_hasil)/100);
				$bungany = $dt->jumlah_investasi*$bungaprs;
				$pokokny = $i<$dt->tenor?0:$dt->jumlah_investasi;
				$jum=$i<$dt->tenor?$bungany:$dt->jumlah_investasi+$bungany;
				*/
				var bungaprs = <?php echo number_format($dt->bagi_hasil/12,2,".","."); ?>/100;
				var bungany = inpsim*bungaprs;
				var jum = parseInt(inpsim)+parseInt(bungany);
				$("#hasilp").html(numberWithThSep(jum));
				/* $.ajax({
					url: '<?=site_url()?>invest/besarangsuran', //calling this function
					data:{jumlah:inpsim,bagi_hasil:<?php echo $dt->bagi_hasil; ?>,id_produk:<?php echo $dt->id_produk; ?>,tenor:<?php echo $dt->tenor; ?>,tglakhir:'<?php echo $dt->tglakhir; ?>'},
					type:'POST',
					cache: false,
					success: function(data) {
						$("#hasilp").html(numberWithThSep(data));
					}
				}); */
				
			} else {
				$("#pengembalian").hide();
			}
		});
		$('.kembali').click(function () {
			var tgl = $(this).data("tgl");
			var jum = $(this).data("jum");
			var jumn = $(this).data("jumn");
			var angsuranke = $(this).data("angsuranke");
			$('.close-btn').click(function(){
				$('.tooltip').animate({ opacity: 0 }, 330, function(){
					$(this).remove();
				});
			});
			$('.tooltip').animate({ opacity: 0 }, 330, function(){
				$(this).remove();
			});
			
			$('.popkembali'+tgl).showToolTip({
				title: 'Pengembalian Dana',
				position:"left",
				content: '<div class="row">'+
				'<label class="control-label col-6">Tanggal Pengembalian</label>'+
				'<label class="control-label col-6"><?php echo date("Y-m-d"); ?></label>'+
				'</div>'+
				'<div class="row">'+
				'<label class="control-label col-6">Jumlah Pengembalian</label>'+
				'<label class="control-label col-6">Rp. '+jumn+'</label>'+
				'</div>'+
				'<div class="row">'+
					'<a href="javascript:;" class="btn tooltip-btn col-6" style="border:2px solid #fdda0a;">Batal</a>'+
					'<a href="javascript:;" data-jum="'+jum+'" data-angsuranke="'+angsuranke+'" id="btnkembali'+tgl+'" class="btn col-6" style="margin:10px 0; border:2px solid #fdda0a; background-color:#fdda0a;">Pengembalian Dana</a>'+
				'</div>',
				onApprove: function(){
					console.log('OK is clicked!');
					/* $('.tooltip').animate({ opacity: 0 }, 330, function(){
						$(this).remove();
					}); */
				}
			});
			//$('.tooltip').css({ top: '50%', marginTop: -'10px', left: '100%' }).animate({ left: '150px', opacity: 1 });
			$(".tooltip-action").hide();
			$('#btnkembali'+tgl).click(function (event) {
				event.preventDefault();
				var angsuranke = $(this).data("angsuranke");
				var jum = $(this).data("jum");
				kembali(angsuranke,jum,"<?php echo $dt->siteurl; ?>");
				//tarikdana(); 
			});
		});
	  
      $('.activate').click(function () {
			$('.tooltip').animate({ opacity: 0 }, 330, function(){
				$(this).remove();
			});
			$('.text').showToolTip({
				title: 'Perhatian',
				content: '<p>Pemberian pinjaman mengandung risiko, termasuk risiko kredit/gagal bayar. kami sarankan untuk lakukan diversifikasi dengan menyerbarkan pemberian pinjaman anda ke banyak peluang pinjaman. </p><a href="<?php echo base_url(); ?>investor/invest/<?php echo $dt->siteurl; ?>" class="btn" style="border:2px solid #fdda0a;background-color:#fdda0a;">Saya mengerti risikonya. Lanjutkan</a>',
				onApprove: function(){
					console.log('OK is clicked!');
				}
			});
			$(".tooltip-btn").text("Batalkan pemberian pinjaman");

      });
	  
	  $('.bagi').click(function () {
		  $('.tooltip').animate({ opacity: 0 }, 330, function(){
      $(this).remove();
      
    })
        $('.hasil').showToolTip({
          title: 'Bagi Hasil/bulan',
          content: '<p style="text-align:justify;" class="mb-3">Sistem perhitungan bunga di mana porsi bunga dihitung berdasarkan jumlah pokok utang yang tersisa dari waktu ke waktu.</p>'+
		  '<p style="text-align:justify;" class="m-0">Pemberian:</p>'+
		  '<p style="text-align:justify;font-weight:bold" class="m-0">Detail Investasi:</p>'+
		  '<div class="row"><div class="col-6" style="font-size:11px;text-align:justify;">Jumlah dana investasi:</div><div class="col-6" style="font-size:11px;text-align:justify;">Rp. 1.200.000</div></div>'+
		  '<div class="row"><div class="col-6" style="font-size:11px;text-align:justify;">Bagi hasil perbulan:</div><div class="col-6" style="font-size:11px;text-align:justify;">Rp. 0</div></div>'+
		  '<div class="row"><div class="col-6" style="font-size:11px;text-align:justify;">Persentase bagi hasil:</div><div class="col-6" style="font-size:11px;text-align:justify;">12% pertahun</div></div>'+
		  '<div class="row"><div class="col-6" style="font-size:11px;text-align:justify;">Bagi hasil:</div><div class="col-6" style="font-size:11px;text-align:justify;">1% perbulan</div></div>'+
		  '<div class="row"><div class="col-6" style="font-size:11px;text-align:justify;">Lama bagi hasil:</div><div class="col-6" style="font-size:11px;text-align:justify;">1 bulan</div></div>'+
		  '<div class="row"><div class="col-6" style="font-size:11px;text-align:justify;">Frekuensi bagi hasil:</div><div class="col-6" style="font-size:11px;text-align:justify;">Bulanan</div></div>'+
		  '<p style="text-align:justify;font-weight:bold" class="m-0">Perhitungan % pembayaran bagi hasil</p>'+
		  '<div class="row"><div class="col-12" style="font-size:11px;text-align:justify;">1% x 1.200.000 dibayarkan setiap bulan</div></div>'+
		  '<div class="row"><div class="col-12" style="font-size:11px;text-align:justify;">- Pengembalian pokok dan investasi di akhir tenor </div></div>'+
		  '<div class="row"><div class="col-12" style="font-size:11px;text-align:justify;">- Efekuensi aturan bagi hasil</div></div>'+
		  '<div class="row"><div class="col-12" style="font-size:11px;text-align:justify;">...</div></div>'+
		  '<div class="row"><div class="col-12" style="font-size:11px;text-align:justify;">dan seterusnya sampai pembayaran ke-12. Maka dalam setahun, jumlah pembayaran bunga adalah sebesar Rp. 78.000</div></div>'
		  ,onApprove: function(){
            console.log('OK is clicked!');
          }
        });
        //$(".tooltip-btn").text("Batalkan pemberian pinjaman");

      });
	  
  });
	function numberWithThSep(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}

	function kembali(angsuranke,amount,url){
		$.ajax({
			url: '<?=site_url()?>invest/proses_kembali', //calling this function
			data:{angsuranke:angsuranke,jumlah_donasi:amount,url:url,id_produk:<?php echo $dt->id_produk; ?>,tenor:<?php echo $dt->tenor; ?>},
			type:'POST',
			cache: false,
			success: function(data) {
				window.location.href = "<?php echo base_url(); ?>invest/detail/"+url;
			}
		});
	}
</script>