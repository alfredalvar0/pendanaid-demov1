<?php
$dataBanner = $this->m_invest->banner()->row();
$wh=array("status"=>"1");
$dataSlider = $this->m_invest->slider($wh);
$wh=array("status_approve !="=>"refuse");
$dataSumAllProduk = $this->m_invest->dataSumAllProduk($wh);
$danaTerkumpul = $this->m_invest->danaTerkumpul();
$keuntunganDibagikan = $this->m_invest->keuntunganDibagikan();
$wh = array("kategori"=>"perhatian","status_delete"=>"0");
$dataPerhatian = $this->m_invest->getPage($wh);
?>

<section class="hero">
	<div class="container">
		<div class="row position-relative">
			<div class="col-md-6 my-auto">
				<h1 class="headline mb-4 font-red-hat-display">Securities
					Crowdfunding Yang
					<span class="text-blue">Profitable</span>
				</h1>
				<p class="sub-headline font-red-hat-display">Bursa Efek UMKM dan UMK yang aman, halal,
					berjaminan dan menguntungkan</p>

				<div class="row headline-points">
					<div class="col-md-6"><img src="<?= base_url(); ?>assets/img/new/check.png" alt="vector"
							class="mr-3">Berizin Dan
						Diawasi OJK</div>
					<div class="col-md-6"><img src="<?= base_url(); ?>assets/img/new/check.png" alt="vector"
							class="mr-3">Mudah</div>
					<div class="col-md-6"><img src="<?= base_url(); ?>assets/img/new/check.png" alt="vector"
							class="mr-3">100%
						Transparan</div>
					<div class="col-md-6"><img src="<?= base_url(); ?>assets/img/new/check.png" alt="vector"
							class="mr-3">Lebih Dari
						180+ Project</div>
				</div>
			</div>
			<?php if($this->session->userdata("invest_username") == "" && $this->session->userdata("invest_email") == ""){ ?>
				<div class="col-md-6 mt-5 my-lg-auto">
					<div class="row row-eq-height">
					<?php if($dataSumAllProduk->num_rows()>0){
						$dts=$dataSumAllProduk->row();
						$count = 1;
						foreach($dataSumAllProduk->result() as $dts){
							$rp="";
							$jum=$dts->jum;
							if ($dts->title=="Dana Terkumpul") {
								$rp="Rp ";
								$jum=$this->m_invest->terbilang($dts->jum);
							}
							$title= $dts->title;
							if ($dts->title=="Proyek") {
								$title= "Total Usaha";
							} ?>
								<div class="col-6 mb-4 text-center">
									<div class="card p-4" style="min-height:150px;">
										<h5 class="text-blue" style="font-weight: 600;font-size:48px;"><?php echo $rp.$jum; ?></h5>
										<p class="m-0 p-0 text-grey"><?= $title; ?></p>
									</div>
								</div>
						<?php  $count++; }

						$kumpul=0;
						foreach ($danaTerkumpul->result() as $dtku) {
							$kumpul=$kumpul+$dtku->jum;
						} ?>

						<div class="col-6 mb-4 text-center">
							<div class="card h-100 p-4" style="min-height:150px;">
								<div class="my-auto">
									<h5 class="text-blue" style="font-weight: 600; font-size:32px;">Rp <?php echo $this->m_invest->penyebut2($kumpul); ?></h5>
									<p class="m-0 p-0 text-grey">Total Pendanaan</p>
								</div>
							</div>
						</div>

						<?php  
						$untung=0;
						foreach ($keuntunganDibagikan->result() as $dtk) {
							$untung=$untung+$dtk->jum;
						} ?>

						<div class="col-6 mb-4 text-center">
							<div class="card h-100 p-4" style="min-height:150px;">
								<div class="my-auto">
									<h5 class="text-blue" style="font-weight: 600; font-size:32px;">Rp <?php echo $this->m_invest->penyebut2($untung); ?></h5>
									<p class="m-0 p-0 text-grey">Deviden Dibagikan</p>
								</div>
							</div>
						</div>
					<?php }
					?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>


<section class="projects">
	<div class="container">
		<div class="row mb-5">
			<div class="col-12 col-md-8">
				<h2 class="text-left font-weight-bold font-red-hat-display">Daftar Project</h2>
				<p class="text-grey text-left font-red-hat-display">Lihat daftar investasi bisnis yang sedang berlangsung dan temukan peluang untuk berinvestasi hari ini.</p>
			</div>
			<div class="col-12 col-md-4 text-lg-right">
				<a href="#" class="custom_btn-blue">All Projects</a>
			</div>
		</div>
		<div class="row project-list mx-0">
			<?php
				$datany['data_produk'] = $data_produk;
            	$this->load->view("list-data", $datany);
            ?>
		</div>
	</div>
</section>

<section class="benefit">
	<div class="container">
		<h2 class="text-center font-red-hat-display">Keunggulan Investasi Dengan Kami</h2>
		<p class="text-center text-grey font-red-hat-display">Lorem ipsum dolor sit amet consectetur adipisicing
			elit. Ipsam, cum?
		</p>
		<div class="row benefit-list py-5">
			<div class="col-12 col-md-6 col-lg-3 benefit-item mb-5 mb-lg-0" onmouseover="changeImageOutline(this)"
				onmouseout="changeImageFilled(this)" data-benefit="1">
				<div class="p-4 bg-white h-100">
					<img src="<?= base_url(); ?>assets/img/new/salary-outline.png" alt="Vector" class="mb-4 filter-blue">
					<p class="font-weight-bold text-blue mb-2">Deviden Bulanan</p>
					<p class="text-grey">Deviden hingga 100%, balik modal kurang dari 6 bulan dan bergaransi.</p>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3 benefit-item mb-5 mb-lg-0" onmouseover="changeImageOutline(this)"
				onmouseout="changeImageFilled(this)" data-benefit="2">
				<div class="p-4 bg-white h-100">
					<img src="<?= base_url(); ?>assets/img/new/halal-outline.png" alt="Vector" class="mb-4 filter-blue">
					<p class="font-weight-bold text-blue mb-2">Halal</p>
					<p class="text-grey">Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde sunt in
						recusandae temporibus.</p>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3 benefit-item mb-5 mb-lg-0" onmouseover="changeImageOutline(this)"
				onmouseout="changeImageFilled(this)" data-benefit="3">
				<div class="p-4 bg-white h-100">
					<img src="<?= base_url(); ?>assets/img/new/thumbs-up-outline.png" alt="Vector" class="mb-4 filter-blue">
					<p class="font-weight-bold text-blue mb-2">Mulai Dari Rp 50.000</p>
					<p class="text-grey">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, maiores.
					</p>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3 benefit-item mb-5 mb-lg-0" onmouseover="changeImageOutline(this)"
				onmouseout="changeImageFilled(this)" data-benefit="4">
				<div class="p-4 bg-white h-100">
					<img src="<?= base_url(); ?>assets/img/new/badge-outline.png" alt="Vector" class="mb-4 filter-blue">
					<p class="font-weight-bold text-blue mb-2">Bisnis Unggulan</p>
					<p class="text-grey">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, inventore?
					</p>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="how-to">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<figure class="img-wrapper w-100">
					<img src="<?= base_url(); ?>assets/img/new/photo-1554672408-730436b60dde.jpg"
						alt="Beragma Fitur yang Memudahkanmu Berinvestasi" class="img-fluid">
				</figure>
			</div>
			<div class="col-md-7 my-auto">
				<h2 class="text-left mb-5 font-red-hat-display">Beragam Fitur yang <br class="d-none d-md-block">
					Memudahkanmu Berinvestasi</h2>
				<ul class="list-features">
					<li class="d-flex align-items-center mb-4">
						<div class="number-wrapper">
							<div class="number mr-3 d-flex justify-content-center align-content-center text-center">
								1
							</div>
						</div>
						<p class="text-capitalize mb-0">Verifikasi Akun Instant Kurang dari 20 Detik</p>
					</li>
					<li class="d-flex align-items-center mb-4">
						<div class="number-wrapper">
							<div class="number mr-3 d-flex justify-content-center align-content-center text-center">
								2
							</div>
						</div>
						<p class="text-capitalize mb-0">E-RUPS (Rapat Umum Pemegang Saham/Sukuk Elektronik)</p>
					</li>
					<li class="d-flex align-items-center mb-4">
						<div class="number-wrapper">
							<div class="number mr-3 d-flex justify-content-center align-content-center text-center">
								3
							</div>
						</div>
						<p class="text-capitalize mb-0">E-Votting (Pengambilan Keputusan Usaha Secara Elektronik)
						</p>
					</li>
					<li class="d-flex align-items-center mb-4">
						<div class="number-wrapper">
							<div class="number mr-3 d-flex justify-content-center align-content-center text-center">
								4
							</div>
						</div>
						<p class="text-capitalize mb-0">Laporan Bulanan Real Time
						</p>
					</li>
					<li class="d-flex align-items-center mb-4">
						<div class="number-wrapper">
							<div class="number mr-3 d-flex justify-content-center align-content-center text-center">
								5
							</div>
						</div>
						<p class="text-capitalize mb-0">Transparansi
						</p>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<section class="partners">
	<div class="container">
		<h2 class="text-center mb-4 font-red-hat-display">Didukung Oleh</h2>
		<div class="row">
			<div class="col-md-8 mx-auto">
				<div class="row partner-list justify-content-center">
					<div class="col-4 d-flex justify-content-center align-items-center">
						<img src="<?= base_url(); ?>assets/img/partner/logo_ksei.png" alt="PT Kustodian Sentral Efek Indonesia"
							class="img-fluid">
					</div>
					<div class="col-4 d-flex justify-content-center align-items-center">
						<img src="<?= base_url(); ?>assets/img/partner/logo_pse.png" alt="PSE Kominfo" class="img-fluid">
					</div>
					<div class="col-4 d-flex justify-content-center align-items-center">
						<img src="<?= base_url(); ?>assets/img/partner/logo_bsi.png" alt="Bank Syariah Indonesia"
							class="img-fluid">
					</div>
					<div class="col-4 d-flex justify-content-center align-items-center">
						<img src="<?= base_url(); ?>assets/img/partner/logo_mui.png" alt="Majelis Ulama Indonesia"
							class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="testimonial">
	<div class="container">
		<h2 class="text-left font-red-hat-display">Apa Kata Mereka?</h2>
		<p class="text-grey mb-5 font-red-hat-display">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
			Minima
			ratione,
			velit culpa obcaecati,
			consectetur ab ad assumenda libero quaerat ipsa placeat aperiam repellendus mollitia distinctio saepe
			dolor. Cum, nobis enim?</p>
		<div class="row">
			<div class="col-md-4 testimonial-item mb-5 mb-lg-0">
				<div class="card border">
					<figure class="img-wrapper m-0 text-center mb-2">
						<img src="<?= base_url(); ?>assets/img/new/avatar.jpg" alt="Avatar" class="avatar" width="70"
							height="70">
					</figure>
					<h5 class="text-center testimonial-name mb-2">Hugo Adams</h5>
					<span class="text-center d-block testimonial-job mb-3">Investor</span>
					<p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
						aliquid distinctio fuga
						amet eos sed.</p>
				</div>
			</div>
			<div class="col-md-4 testimonial-item mb-5 mb-lg-0">
				<div class="card border">
					<figure class="img-wrapper m-0 text-center mb-2">
						<img src="<?= base_url(); ?>assets/img/new/avatar.jpg" alt="Avatar" class="avatar" width="70"
							height="70">
					</figure>
					<h5 class="text-center testimonial-name mb-2">Hugo Adams</h5>
					<span class="text-center d-block testimonial-job mb-3">Investor</span>
					<p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
						aliquid distinctio fuga
						amet eos sed.</p>
				</div>
			</div>
			<div class="col-md-4 testimonial-item mb-5 mb-lg-0">
				<div class="card border">
					<figure class="img-wrapper m-0 text-center mb-2">
						<img src="<?= base_url(); ?>assets/img/new/avatar.jpg" alt="Avatar" class="avatar" width="70"
							height="70">
					</figure>
					<h5 class="text-center testimonial-name mb-2">Hugo Adams</h5>
					<span class="text-center d-block testimonial-job mb-3">Investor</span>
					<p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
						aliquid distinctio fuga
						amet eos sed.</p>
				</div>
			</div>
		</div>
	</div>
</section>
<?php

?>
<script type="text/javascript">
	function changeImageOutline(element) {
		if (element.getAttribute('data-benefit') == 1) {
			element
			.getElementsByTagName('img')[0]
			.setAttribute('src', '<?= base_url(); ?>assets/img/new/salary.png');
			element.getElementsByTagName('img')[0].classList.remove('filter-blue');
		}
		if (element.getAttribute('data-benefit') == 2) {
			element
			.getElementsByTagName('img')[0]
			.setAttribute('src', '<?= base_url(); ?>assets/img/new/halal.png');
			element.getElementsByTagName('img')[0].classList.remove('filter-blue');
		}
		if (element.getAttribute('data-benefit') == 3) {
			element
			.getElementsByTagName('img')[0]
			.setAttribute('src', '<?= base_url(); ?>assets/img/new/thumbs-up.png');
			element.getElementsByTagName('img')[0].classList.remove('filter-blue');
		}
		if (element.getAttribute('data-benefit') == 4) {
			element
			.getElementsByTagName('img')[0]
			.setAttribute('src', '<?= base_url(); ?>assets/img/new/badge.png');
			element.getElementsByTagName('img')[0].classList.remove('filter-blue');
		}
	}

	function changeImageFilled(element) {
		if (element.getAttribute('data-benefit') == 1) {
			element
			.getElementsByTagName('img')[0]
			.setAttribute('src', '<?= base_url(); ?>assets/img/new/salary-outline.png');
			element.getElementsByTagName('img')[0].classList.add('filter-blue');
		}
		if (element.getAttribute('data-benefit') == 2) {
			element
			.getElementsByTagName('img')[0]
			.setAttribute('src', '<?= base_url(); ?>assets/img/new/halal-outline.png');
			element.getElementsByTagName('img')[0].classList.add('filter-blue');
		}
		if (element.getAttribute('data-benefit') == 3) {
			element
			.getElementsByTagName('img')[0]
			.setAttribute('src', '<?= base_url(); ?>assets/img/new/thumbs-up-outline.png');
			element.getElementsByTagName('img')[0].classList.add('filter-blue');
		}
		if (element.getAttribute('data-benefit') == 4) {
			element
			.getElementsByTagName('img')[0]
			.setAttribute('src', '<?= base_url(); ?>assets/img/new/badge-outline.png');
			element.getElementsByTagName('img')[0].classList.add('filter-blue');
		}
		}
	
		if(sessionStorage.getItem("partner_tx_id")){
		if(sessionStorage.getItem("partner_tx_id") != ''){
        	var trx = sessionStorage.getItem("partner_tx_id");
        	var settings = {
			  "url": "https://api-stg.oyindonesia.com/api/payment-checkout/status?partner_tx_id="+trx+"&send_callback=false",
			  "method": "GET",
			  "timeout": 0,
			  "headers": {
			    "x-oy-username": "pendanaid",
			    "x-api-key": "d4223670-1abb-491c-be03-c32370774324",
			    "content-type": "application/json"
			  },
			};

			$.ajax(settings).done(function (response) {
			  console.log(response);
			  // sessionStorage.setItem("partner_tx_id", "");
			  data = {
		        amount:response.data.amount,
		        sender_name:response.data.sender_name,
		        status:response.data.status,
		        email:response.data.email,
		      }
		      console.log(data);
		      if(response.data.status=="complete"){
		      $.ajax({
			      method: "POST",
			      url: "<?php echo base_url('investor/saveOy'); ?>",
			      data: data 
			      
			    })
		      	sessionStorage.setItem("partner_tx_id", "");
		  		}else{
		  			console.log('not set yet');
		  		}
			});
    	}
    }

	$(document).ready(function(){
		$(".rf").change(function(){
			filternya();
		});
	});
	function filternya(){ 
		var n=0;
		var nilai = {};
		var fi=["kampanye","tenor","bunga","urutan"];
		$(".rf:checked").each(function(){
			var tv = $(this).val();
			nilai[fi[n]]=tv;
			//console.log("val"+n+"->"+tv);
			n++;
		});
		console.log(nilai);
		$.ajax({
			url: "<?php echo base_url(); ?>invest/indexfilter", 
			data : nilai,
			type:"post",
			dataType:"html",
			success: function(result){ 
				$("#list-data").html(result);
			}
		});
	}
</script>