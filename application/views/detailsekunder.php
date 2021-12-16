   
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

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
 
.panel.with-nav-tabs .panel-heading{
    padding: 5px 5px 0 5px;
}
.panel.with-nav-tabs .nav-tabs{
	border-bottom: none;
}
.panel.with-nav-tabs .nav-justified{
	margin-bottom: -1px;
}
/********************************************************************/
/*** PANEL DEFAULT ***/
.with-nav-tabs.panel-default .nav-tabs > li > a,
.with-nav-tabs.panel-default .nav-tabs > li > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li > a:focus {
    color: #777;
}
.with-nav-tabs.panel-default .nav-tabs > .open > a,
.with-nav-tabs.panel-default .nav-tabs > .open > a:hover,
.with-nav-tabs.panel-default .nav-tabs > .open > a:focus,
.with-nav-tabs.panel-default .nav-tabs > li > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li > a:focus {
    color: #fff;
	background-color: #428bca;
	border-color: transparent;
}
.with-nav-tabs.panel-default .nav-tabs > li.active > a,
.with-nav-tabs.panel-default .nav-tabs > li.active > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li.active > a:focus {
	color: #555;
	background-color: #fff;
	border-color: #ddd;
	border-bottom-color: transparent;
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu {
    background-color: #f5f5f5;
    border-color: #ddd;
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a {
    color: #777;   
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
    background-color: #ddd;
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a,
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
    color: #fff;
    background-color: #555;
}
 

 
</style>


<section id="team" > <?php if($this->session->userdata("invest_username")==""){echo "<br><br><br><br><br>";}?>
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
			<div class="row">
				<div class="col-12  mt-5">
					  
						<div class="panel with-nav-tabs panel-default">
							<div class="panel-heading" style="background-color:#fff">
									<ul class="nav nav-tabs">
										<li ><a href="#tab1default" data-toggle="tab">Finansial</a></li>
										<li ><a href="#tab2default" data-toggle="tab">Tentang Bisnis</a></li>
										<li><a href="#tab3default" data-toggle="tab">Lokasi</a></li>
										<!--<li><a href="#tab4default" data-toggle="tab">Simulasi Investasi</a></li>--> 
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
					data:{jumlah:inpsim,bagi_hasil:<?php echo $dt->bagi_hasil; ?>,id_produk:<?php echo $dt->id_produk; ?>,tenor:<?php echo $dt->tenor; ?>,tglakhir:'<?php echo $dt->tglakhir; ?>'},
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