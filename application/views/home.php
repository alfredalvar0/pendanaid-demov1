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
				<h1 class="headline mb-4 font-red-hat-display">Situs Layanan Urun Dana Berbasis
					<span class="text-blue">Bisnis Riil</span>
				</h1>
				<p class="sub-headline font-red-hat-display">Modal kecil, risiko minim, menghasilkan rutin <br> Yuk capai kebebasan keuangan sekarang bersama PendanaID!</p>

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
									<h5 class="text-blue" style="font-weight: 600; font-size:32px;">Rp <?= explode(".", $this->m_invest->penyebut2($kumpul))[0] . " " . explode(" ", $this->m_invest->penyebut2($kumpul))[1] . "+"; ?></h5>
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
									<h5 class="text-blue" style="font-weight: 600; font-size:32px;">Rp <?= explode(".", $this->m_invest->penyebut2($untung))[0] . " " . explode(" ", $this->m_invest->penyebut2($untung))[1] . "+" ; ?></h5>
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
				<h2 class="text-left font-weight-bold font-red-hat-display">Daftar Bisnis</h2>
				<p class="text-grey text-left font-red-hat-display">Lihat daftar investasi bisnis yang sedang berlangsung dan temukan peluang untuk berinvestasi hari ini.</p>
			</div>
			<div class="col-12 col-md-4 text-lg-right">
				<a href="<?= base_url(); ?>investor/pasar_sekunder" class="custom_btn-blue">Lihat Semua</a>
			</div>
		</div>
		<div class="row project-list mx-0">
			<?php $datany['data_produk'] = $data_produk;
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
					<p class="text-grey">Dividen untuk bisnis2 tertentu bisa per 6 bulan, 3 bulan bahkan per-bulan loh</p>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3 benefit-item mb-5 mb-lg-0" onmouseover="changeImageOutline(this)"
				onmouseout="changeImageFilled(this)" data-benefit="2">
				<div class="p-4 bg-white h-100">
					<img src="<?= base_url(); ?>assets/img/new/halal-outline.png" alt="Vector" class="mb-4 filter-blue">
					<p class="font-weight-bold text-blue mb-2">Halal</p>
					<p class="text-grey">Menjaga semua bisnis yang di tawarkan sesuai dengan ketentuan islam.</p>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3 benefit-item mb-5 mb-lg-0" onmouseover="changeImageOutline(this)"
				onmouseout="changeImageFilled(this)" data-benefit="3">
				<div class="p-4 bg-white h-100">
					<img src="<?= base_url(); ?>assets/img/new/thumbs-up-outline.png" alt="Vector" class="mb-4 filter-blue">
					<p class="font-weight-bold text-blue mb-2">Modal Minim</p>
					<p class="text-grey">Penerapan sistem patungan paling minimal agar risiko lebih terukur
					</p>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3 benefit-item mb-5 mb-lg-0" onmouseover="changeImageOutline(this)"
				onmouseout="changeImageFilled(this)" data-benefit="4">
				<div class="p-4 bg-white h-100">
					<img src="<?= base_url(); ?>assets/img/new/badge-outline.png" alt="Vector" class="mb-4 filter-blue">
					<p class="font-weight-bold text-blue mb-2">Bisnis Unggulan</p>
					<p class="text-grey">Menawarkan bisnis yang unggulan agar tetap bisa cuan secara rutin tanpa harus ninggalin aktifitas rutin dan waktu buat keluarga
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
		<p class="text-grey mb-5 font-red-hat-display">Kamu harus tau PendanaID hadir untuk menemani kamu untuk mencapai kebebasan keuangan yang sesungguhnya. <br> Banyak di antara mereka yang sudah kami bantu untuk mencapai tujuan-tujuannya tersebut loh! </p>
		<div class="row">
			<div class="col-md-4 testimonial-item mb-5 mb-lg-0">
				<div class="card border h-100">
					<figure class="img-wrapper m-0 text-center mb-2">
						<img src="<?= base_url(); ?>assets/img/testimonials/reni.png" alt="Avatar" class="avatar" width="70"
							height="70">
					</figure>
					<h5 class="text-center testimonial-name mb-2">Reni</h5>
					<span class="text-center d-block testimonial-job mb-3">Investor</span>
					<p class="text-center" style="font-size: 14px;">Karena aku mahasiswa yang sambil kerja jadi cuma punya modal kecil dan ga punya keahlian usaha, jadi cocok banget beli bisnis di PendanaID ga perlu mikirin banyak hal mengenai usaha tapi kita tetep bisa berkarya di pekerjaan kita.</p>
				</div>
			</div>
			<div class="col-md-4 testimonial-item mb-5 mb-lg-0">
				<div class="card border h-100">
					<figure class="img-wrapper m-0 text-center mb-2">
						<img src="<?= base_url(); ?>assets/img/testimonials/oki.png" alt="Avatar" class="avatar" width="70"
							height="70">
					</figure>
					<h5 class="text-center testimonial-name mb-2">Oki</h5>
					<span class="text-center d-block testimonial-job mb-3">Investor</span>
					<p class="text-center" style="font-size: 14px;">Sebelum ada PendanaID jalanin bisnis sambil kerja repotnya minta ampun, ujung-ujungnya gagal dan rugi. Bersyukur ada PendanaID bisa bantu siapin bisnis yang bagus, jadi ga repot buat urus masalah teknis usaha tapi pendapatan terus nambah.</p>
				</div>
			</div>
			<div class="col-md-4 testimonial-item mb-5 mb-lg-0">
				<div class="card border h-100">
					<figure class="img-wrapper m-0 text-center mb-2">
						<img src="<?= base_url(); ?>assets/img/testimonials/peri.png" alt="Avatar" class="avatar" width="70"
							height="70">
					</figure>
					<h5 class="text-center testimonial-name mb-2">Peri</h5>
					<span class="text-center d-block testimonial-job mb-3">Investor</span>
					<p class="text-center" style="font-size: 14px;">Saya punya impian dulu suatu saat pengen punya bisnis kaya orang-orang gitu, tapi disitu saya berfikir kembali modalnya ga sedikit di tambah saya ga punya banyak waktu karena harus kerja. Tapi sekarang ada PendanaID, mereka bisa membantu impian saya dan yang paling penting saya tetep ada waktu buat keluarga.</p>
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
</script>
