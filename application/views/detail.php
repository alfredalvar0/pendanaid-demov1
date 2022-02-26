   
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
?>
<section id="content" class="detail-invest">
	<div class="container py-5">
		<div class="img-wrapper border d-flex align-items-center justify-content-center" style="width: 102px; height: 100px;">
			<img src="<?= base_url()?>assets/img/bisnis/<?= $dt->fotobisnis; ?>" style="width: 100px;">
		</div>
		<h1 class="font-weight-bold mb-5"><?php echo $dt->judul; ?></h1>

		<div class="row">
			<div class="col-md-6 col-lg-7">
				<div class="row">
					<div class="col-md-12 mb-3" id="display">
						<img id="imgClickAndChange" src="<?php echo base_url() ?>assets/img/<?php echo $foto; ?>" class="card-img-top" style="width:100%;">
					</div>
				</div>
				<div class="row no-gutters">
					<?php if($foto != "") { ?>
						<div class="col-4 col-lg-3 my-2" style="padding: 0 5px;">
							<a href="javascript:;" onclick="changeImage('<?php echo $foto; ?>')">
								<div class="img-thumbnail w-100"  style="height:75px; background-image: url('<?= base_url()?>assets/img/<?php echo $foto; ?>'); background-size: cover; background-position: center;">
								</div>
							</a>
						</div>
					<?php } ?>
					<?php if($foto2 !== "") { ?>
						<div class="col-4 col-lg-3 my-2" style="padding: 0 5px;"> 
							<a href="javascript:;" onclick="changeImage('<?php echo $foto2; ?>')">
								<div class="img-thumbnail w-100"  style="height:75px; background-image: url('<?= base_url()?>assets/img/<?php echo $foto2; ?>'); background-size: cover; background-position: center;">
								</div>
							</a>
						</div>
					<?php } ?>
					<?php if($foto3 !== "") { ?>
						<div class="col-4 col-lg-3 my-2" style="padding: 0 5px;"> 
							<a href="javascript:;" onclick="changeImage('<?php echo $foto3; ?>')">
								<div class="img-thumbnail w-100"  style="height:75px; background-image: url('<?= base_url()?>assets/img/<?php echo $foto3; ?>'); background-size: cover; background-position: center;">
								</div>
							</a>
						</div>
					<?php } ?>
					<?php if($video !=""){ ?>
						<div class="col-4 col-lg-3 my-2" style="padding: 0 5px;"> 
							<div class="border" style="height: 75px;">
								<a href="<?php echo $video; ?>" target="_blank"><button  class="btn btn-default" style="height:100%;width:100%" >Preview</button> </a> 
							</div>
						</div>
					<?php } ?>
				<script language="javascript">
					function changeImage(image) { 
							document.getElementById("imgClickAndChange").src = "<?php echo base_url() ?>assets/img/"+image;
					}
					
					function changeVideo(video) {   
							window.open('<?php echo $video; ?>','_blank');
					}
				</script>
				</div>
			</div>
			<div class="col-md-6 col-lg-5 pl-md-4"> 
				<p class="mb-2" style="color: #6D6D6D;">Dana Terkumpul</p>
				<p style="color:#4c9a4c;font-size:18px;font-weight: 600;" class="mb-2">Rp. <?php echo number_format($total_invest->total, 2);?></p>
				
				<div class="progress mb-2" style="border-radius: 4px;">
					<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persenterkumpul; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persenterkumpul; ?>%;">
					<?php echo number_format($persenterkumpul,2); ?>%
					</div>
				</div>	

				<p style="font-size:14px;color:#FF5C58"  class="mb-2"><b><?php echo ($dt->lembar_saham-$total_invest->lembar)?> Lembar Saham Tersedia</b></p> 
				<div class="row">
					<div class="col-12 mt-5">
						<p class="font-weight-normal mb-1" style="color: #6d6d6d;">Nilai Bisnis</p>
						<p style="font-size: 24px;font-weight: 600;" class="mb-3">Rp. <?php echo number_format($dt->nilai_bisnis,0,".","."); ?></p>
					</div>
					<div class="col-6 mt-3">
						<p style="color: #6d6d6d;" class="mb-2">Jumlah Investor</p>
						<p style="font-size: 24px; font-weight: 600"class="mb-2"><?php echo $total_investor; ?></p>
					</div>
					<div class="col-6 mt-3">
						<p style="color: #6d6d6d;" class="mb-2">Batas Waktu</p>
						<p style="font-size:24px; font-weight: 600;" class="mb-2 text-capitalize"><?= $txtd == "expired" ? "-" : $txtd; ?></p>
					</div>
					
					
				</div>
				<div class="row mt-5">
					<?php 
					if($diff<=0){
						?>
						<div class="col-12">
							<button class="btn custom_btn-blue px-5">Expired</button>
						</div>
						<?php
					} else {
						if($dt->lembar_saham==$total_invest->lembar){
							?>
								<div class="col-md-12">
									<button class="btn custom_btn-blue px-5">Dana Terpenuhi</button>
								</div>
							<?php
						}
						else{
							if($this->session->userdata("invest_tipe")=="investor"){
								if($this->session->userdata("invest_tipe")=="investor" && $dt->status_approve!="complete"){
									if(isset($dt->invested) && $dt->invested>0){
										if($dt->status_approve=="approve" || $dt->status_approve=="running" || $dt->status_approve=="invest"){
										?>
										<!--<div class="col-md-12">
											<button class="btn btn-lg btn-success">Sudah Investasi</button>
										</div>-->
										<div class="col-md-6 ">
											<a href="<?php echo base_url()?>invest/beli/<?php echo $url;?>"><button class="btn custom_btn-blue" style="width:100%" >Beli</button><a/>
										</div>
										<div class="col-md-6 ">
											<a target="_blank" href="<?php echo base_url()?>assets/img/produk/proposal/<?php echo $dt->proposal; ?>"><button class="btn custom_btn-outline-blue" style="width:100%">Unduh Proposal</button></a>
										</div>
											
										<?php
										} else if($dt->status_approve=="pending"){
											?>
											<div class="col-md-12">
												<button class="btn btn-lg btn-success">Pending</button>
											</div>
											<?php
										}
									} else { ?>
									<div class="col-md-5">
										<a href="<?php echo base_url()?>invest/beli/<?php echo $url;?>"><button class="btn custom_btn-blue"  style="width:100%" >Beli</button><a/>
									</div>
									<div class="col-md-7">
										<a target="_blank" href="<?php echo base_url()?>assets/img/produk/proposal/<?php echo $dt->proposal; ?>"><button class="btn custom_btn-outline-blue" style="width:100%">Unduh Proposal</button></a>
									</div>
								<?php }
								} else {
									if($dt->status_approve=="complete"){
									?>
									<div class="col-md-12">
										<button class="btn btn-lg btn-success border rounded-pill">Complete</button>
									</div>
									<?php
									}
								}
							} else {
							?>
								<div class="col-md-5 px-1 mb-3 mb-md-0">
									<a href="<?php echo base_url() ?>invest/login" class="btn custom_btn-blue " style="width:100%" >Beli</a>
								</div>
								<div class="col-md-7 px-1">
										<a target="_blank" href="<?php echo base_url()?>assets/img/produk/proposal/<?php echo $dt->proposal; ?>"><button class="btn custom_btn-outline-blue" style="width:100%">Unduh Proposal</button></a>
									</div>
							<?php
							}
						
						}
					}
					?>
				</div>
			</div>
		</div>

		<div class="row mt-5 pt-5">
			<div class="col-12">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item waves-effect waves-light">
						<a class="nav-link active border-0" id="finansial-tab" data-toggle="tab" href="#finansial" role="tab" aria-controls="home" aria-selected="true">Finansial</a>
					</li>
					<li class="nav-item waves-effect waves-light">
						<a class="nav-link border-0" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="profile" aria-selected="false">Tentang Bisnis</a>
					</li>
					<li class="nav-item waves-effect waves-light">
						<a class="nav-link border-0" id="location-tab" data-toggle="tab" href="#location" role="tab" aria-controls="contact" aria-selected="false">Lokasi</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade active show p-4" id="finansial" role="tabpanel" aria-labelledby="finansial-tab">
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
					<div class="tab-pane fade p-4" id="about" role="tabpanel" aria-labelledby="about-tab">
						<?php echo $dt->tentang_bisnis ?>
					</div>
					<div class="tab-pane fade p-4" id="location" role="tabpanel" aria-labelledby="location-tab"><?php echo $dt->lokasi ?></div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function(){
		$("#infop").click(function(){
			var inpsim = $("#inpsim").val();
			if(inpsim>=1000000){
				$.ajax({
					url: '<?=site_url()?>invest/angsuran', //calling this function
					data:{jumlah:inpsim, bagi_hasil:<?= $dt->bagi_hasil ? $dt->bagi_hasil : ""; ?>,id_produk:<?php echo $dt->id_produk; ?>,tenor:<?php echo $dt->tenor; ?>,tglakhir:'<?php echo $dt->tglakhir; ?>'},
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
