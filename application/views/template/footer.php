<?php
$wh = array("kategori"=>"perhatian","status_delete"=>"0");
$dataPerhatian = $this->m_invest->getPage($wh);
$wh = array("modul"=>"whatsapp");
$datawhatsapp = $this->m_invest->refferal_setting($wh)->row();
$datalink = $this->m_invest->getLink();
$wh = array(
	"kategori"=>"footer",
	"status_delete"=>"0"
);
$datafooter = $this->m_invest->getPage($wh);
$wh2 = array(
	"kategori"=>"footer2",
	"status_delete"=>"0"
);
$datafooter2 = $this->m_invest->getPage($wh2);

$wh = array("kategori"=>"perhatian","status_delete"=>"0");
$dataPerhatian = $this->m_invest->getPage($wh);
?>
<!--==========================
Footer
============================-->
<style type="text/css">
#goog-gt-tt {
	display: none !important;
}
.goog-text-highlight {
	background: none !important;
	box-shadow: none !important;
}
.goog-te-combo {
    background: none !important;
}
</style>

<footer class="section-footer bg-white border-top">
	<div class="container py-5">
		<div class="row">
			<div class="col-lg-5 mb-3 mb-md-0">
				<a class="navbar-brand d-block" href="<?= base_url(); ?>">
					<img src="<?= base_url(); ?>assets/img/new/logo_pendana.png" alt="Logo Pendana">
				</a>
				<p class="text-blue mb-0 font-weight-bold">PT Pendana Usaha</p>
				<p class="mb-4">Bursa Efek UMKM dan UKM Solusi Investasi Bagi Masyarakat</p>
				<div class="company-details">
					<ul>
						<li class="d-flex">
							<div class="icon-wrapper mt-1 mr-3">
								<img src="<?= base_url(); ?>assets/img/new/pin.png" alt="Vector" class="icon-grey">
							</div>
							<p>Menara Standard Chartered Lt. 35
								Jl. Prof. Dr. Satrio No. 164, Jakarta 12930</p>
						</li>
						<li class="d-flex">
							<div class="icon-wrapper mr-3">
								<img src="<?= base_url(); ?>assets/img/new/telephone.png" alt="Vector" class="icon-grey">
							</div>
							<p>+6221 50864230</p>
						</li>
						<li class="d-flex">
							<div class="icon-wrapper mr-3">
								<img src="<?= base_url(); ?>assets/img/new/email.png" alt="Vector" class="icon-grey">
							</div>
							<p>support@pendanausaha.id</p>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-2 mb-3 mb-md-0">
				<h4 class="footer-group-title mb-3">Perusahaan</h4>
				<nav class="footer-group">
				<?php
                $num=1;
				foreach ($datafooter->result() as $dtf){
					if($dtf->judul =="") continue;
					echo '<li class="footer-links"><a class="text-dark" href="'.base_url().'invest/page/'.$dtf->link_page.'">'.$dtf->judul.'</a></li>';
					$num++;
				}?>
				</nav>
			</div>
			<div class="col-lg-2 mb-3 mb-md-0">
				<h4 class="footer-group-title mb-3">Socials</h4>
				<nav class="footer-group">
				<?php
				foreach ($datalink->result() as $dtl) { ?>
					<li class="footer-links">
						<a href="<?= $dtl->nama_link; ?>" class="text-capitalize text-dark d-flex align-items-center">
							<div class="icon-wrapper d-flex align-items-center mr-2">
								<i class="fa fa-fw <?php echo $dtl->icon ?>"></i>
							</div>
							<?php echo substr($dtl->icon,3) ?>
						</a>
					</li>
				<?php } ?>
				</nav>
			</div>
			<div class="col-lg-3 mb-3 mb-md-0">
				<h4 class="footer-group-title">Berizin dan Diawasi oleh</h4>
				<div class="row mb-3 mb-md-5">
					<div class="col-6">
						<img src="<?= base_url(); ?>assets/img/new/logo_ojk.png" alt="Otoritas Jasa Keuangan"
							class="img-fluid" style="max-height:60px;">
					</div>
				</div>
				<h4 class="footer-group-title">Anggota Resmi</h4>
				<div class="row mb-3 mb-md-5">
					<div class="col-6">
						<img src="<?= base_url(); ?>assets/img/new/logo_aludi.png" alt="Asosiasi Layanan Urun Dana Indonesia"
							class="img-fluid" style="max-height:60px;">
					</div>
				</div>
				<h4 class="footer-group-title">Sertifikasi</h4>
				<div class="row mb-3 mb-md-5">
					<div class="col-6">
						<img src="<?= base_url(); ?>assets/img/new/logo_iso.png" alt="Asosiasi Layanan Urun Dana Indonesia"
							class="img-fluid" style="max-height:60px;">
					</div>
				</div>
			</div>
		</div>

		<div class="disclaimer">
			<div class="container">
				<h5 class="text-center font-weight-bold mb-4">Disclaimer</h5>
				<blockquote>
					<p>"OTORITAS JASA KEUANGAN TIDAK MEMBERIKAN PERSETUJUAN TERHADAP PENERBIT DAN TIDAK MEMBERIKAN
						PERNYATAAN MENYETUJUI ATAU TIDAK MENYETUJUI EFEK INI, TIDAK JUGAMENYATAKAN KEBENARAN ATAU
						KECUKUPAN INFORMASI DALAM LAYANAN URUN DANA INI. SETIAP PERNYATAAN YANG BERTENTANGAN DENGAN
						HAL TERSEBUT ADALAH PERBUATAN MELANGGAR HUKUM."
					</p>

					<p>
						“INFORMASI DALAM LAYANAN URUN DANA INI PENTING DAN PERLU MENDAPAT PERHATIAN SEGERA. APABILA
						TERDAPAT KERAGUAN PADA TINDAKAN YANG AKAN DIAMBIL, SEBAIKNYA BERKONSULTASI DENGAN
						PENYELENGGARA.”
					</p>

					<p>
						“PENERBIT DAN PENYELENGGARA, BAIK SENDIRISENDIRI MAUPUN BERSAMA-SAMA, BERTANGGUNG JAWAB
						SEPENUHNYA ATAS KEBENARAN SEMUA INFORMASI YANG TERCANTUM DALAM LAYANAN URUN DANA INI.”
					</p>
				</blockquote>
			</div>
		</div>


		<div class="copyright border-top pt-4">
			<div class="text-center">
				<p class="mb-0">Copyright © 2021 <span class="text-blue font-weight-bold d-inline">Pendana
						Usaha</span>. All
					Rights
					Reserved.</p>
			</div>
		</div>
	</div>
</footer>
<!-- <?php
$valwhatsapp = json_decode($datawhatsapp->value);
?>
<div class="chat-me position-fixed d-block m-2" style="bottom:0; left:0;">
	<a href="https://web.whatsapp.com/send?phone=<?php echo $valwhatsapp->phone; ?>&amp;text=<?php echo $valwhatsapp->text; ?>" target="_blank">
		<img src="<?= base_url(); ?>assets/img/new/whatsapp.png" alt="Chat Me" width="64" height="64"
			style="border-radius: 12px;">
	</a>
</div> -->

<a href="#top" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
