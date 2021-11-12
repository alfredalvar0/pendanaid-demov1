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

<footer>
	<div class="container border-top py-5">
		<div class="row">
			<div class="col-lg-5 mb-3 mb-md-0">
				<a class="navbar-brand d-block" href="#">
					<img src="/pendana-landing/images/logo_pendana.png" alt="Logo Pendana">
				</a>
				<p class="text-blue mb-0 font-weight-bold">PT Pendana Usaha</p>
				<p class="mb-4">Bursa Efek UMKM dan UKM Solusi Investasi Bagi Masyarakat</p>
				<div class="company-details">
					<ul>
						<li class="d-flex">
							<div class="icon-wrapper mt-1 mr-3">
								<img src="/pendana-landing/images/pin.png" alt="Vector" class="icon-grey">
							</div>
							<p>Menara Standard Chartered Lt. 35
								Jl. Prof. Dr. Satrio No. 164, Jakarta 12930</p>
						</li>
						<li class="d-flex">
							<div class="icon-wrapper mr-3">
								<img src="/pendana-landing/images/telephone.png" alt="Vector" class="icon-grey">
							</div>
							<p>+6221 50864230</p>
						</li>
						<li class="d-flex">
							<div class="icon-wrapper mr-3">
								<img src="/pendana-landing/images/email.png" alt="Vector" class="icon-grey">
							</div>
							<p>support@pendanausaha.id</p>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-2 mb-3 mb-md-0">
				<h4 class="footer-group-title mb-3">Perusahaan</h4>
				<nav class="footer-group">
					<li class="footer-links">
						<a href="#" class="text-dark">Contact Us</a>
					</li>
					<li class="footer-links">
						<a href="#" class="text-dark">About Us</a>
					</li>
				</nav>
			</div>
			<div class="col-lg-2 mb-3 mb-md-0">
				<h4 class="footer-group-title mb-3">Lainnya</h4>
				<nav class="footer-group">
					<li class="footer-links">
						<a href="#" class="text-dark">Kode Referral</a>
					</li>
					<li class="footer-links">
						<a href="#" class="text-dark">Kalkulator Investasi</a>
					</li>
					<li class="footer-links">
						<a href="#" class="text-dark">Culture</a>
					</li>
					<li class="footer-links">
						<a href="#" class="text-dark">About Us</a>
					</li>
				</nav>
			</div>
			<div class="col-lg-3 mb-3 mb-md-0">
				<h4 class="footer-group-title">Berizin dan Diawasi oleh</h4>
				<div class="row mb-3 mb-md-5">
					<div class="col-6">
						<img src="/pendana-landing/images/logo_ojk.png" alt="Otoritas Jasa Keuangan"
							class="img-fluid" style="max-height:60px;">
					</div>
				</div>
				<h4 class="footer-group-title">Anggota Resmi</h4>
				<div class="row mb-3 mb-md-5">
					<div class="col-6">
						<img src="/pendana-landing/images/logo_aludi.png" alt="Asosiasi Layanan Urun Dana Indonesia"
							class="img-fluid" style="max-height:60px;">
					</div>
				</div>
				<h4 class="footer-group-title">Sertifikasi</h4>
				<div class="row mb-3 mb-md-5">
					<div class="col-6">
						<img src="/pendana-landing/images/logo_iso.png" alt="Asosiasi Layanan Urun Dana Indonesia"
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

<footer id="footer" class="shadow-lg mt-5" style="">
    <div class="footer-top">
        <div class="container">
            <div class="row" >
            
                <div class="col-lg-3 col-md-2 footer-info text-center">
                    <a href="<?php echo base_url() ?>"><img src="<?php echo base_url()?>assets/img/investpro.png" style="width:100%"></a><br><br>
					<p style="color:#000">PT. Pendana Usaha Indonesia</p>
                    
					<!-- <img src="<?php echo base_url(); ?>assets/img/playstore.png" width="150px" height="50px">&nbsp;<img src="<?php echo base_url(); ?>assets/img/appstore.png" width="150px" height="50px"> -->
                </div>
                <div class="col-lg-2 col-md-2 footer-links">
                    <div class="row">
                        <div class="col-12 footer-links">
                
                            <ul class="row">
                                <?php
                                
                                $num=1;
                                foreach($datafooter->result() as $dtf){
                                    if($dtf->judul =="") continue;
                                    echo '<li class="col-md-12"><a href="'.base_url().'invest/page/'.$dtf->link_page.'">'.$dtf->judul.'</a></li>';
                                     
                                    $num++;
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
				
				
				
				
				<div class="col-lg-2 col-md-2 footer-info text-left">
					<div class="row">
                        <div class="col-12 footer-links">
							<ul class="row" style="list-style: none">
								<?php
								foreach($datalink->result() as $dtl){
									?>
									<li class="col-md-12">
										<a class="mb-2" href="<?php echo $dtl->nama_link; ?>"> <i class="fa <?php echo $dtl->icon ?>"></i> &nbsp;&nbsp;&nbsp;<?php echo substr($dtl->icon,3) ?></a>
									</li>
									<?php
								}
								?>
								
							 </ul> 
						</div>
                    </div>
                </div>
				
				

				<div class="col-lg-3 col-md-2 footer-info text-left">
					<div class="row">

                        <div class="col-12 footer-links">
							 <p style="color:#000">
							 	Berizin dan diawasi oleh:
							 	<br/>
							 	<a href="<?php echo base_url() ?>"><img class="logolegal" src="<?php echo base_url()?>assets/img/partner/logo_ojk.png" style="width:50%"></a>
							 </p>
						</div>
						<div class="col-12 footer-links">
							 <p style="color:#000">
							 	Anggota Resmi:
							 	<br/>
							 	<a href="<?php echo base_url() ?>"><img class="logolegal" src="<?php echo base_url()?>assets/img/partner/logo_aludi.png" style="width:50%"></a>
							 </p>
						</div>
						
                    </div>
                </div>

                <div class="col-lg-2 col-md-2 footer-info text-left">
					<div class="row">
						
                        <div class="col-12 footer-links">
							 <p style="color:#000">
							 	Didukung oleh:
							 	<br/>
							 	<a href="<?php echo base_url() ?>"><img class="logosupport" src="<?php echo base_url()?>assets/img/partner/logo_kominfo.png" style="width:30%"></a>
							 </p>
						</div>

						<br/>
						<br/>
						
                    </div>
                </div>



				<!--
				<div class="col-lg-3 col-md-2 footer-info text-left">
					<div class="row">
                        <div class="col-12 footer-links">
							 <p style="color:#000">Info Mengenai Investasi Gratis</p>
						</div>
						<div class="col-12 ">
							<table style="width:100%">
								<tr>
									<td> <input type="text" style="font-size:10px;border:1px solid blue; width:100%"> </td>
									<td><button class="btn btn-primary">Kirim</button></td>
								</tr>
							</table>
							
						 
							 
						</div>
                    </div>
                </div>
            	-->
				
				
            </div>
            
        </div>
    </div>
     
</footer><!-- #footer -->
<?php
$valwhatsapp = json_decode($datawhatsapp->value);
?>
<a class="whatsapp text-center" href="https://web.whatsapp.com/send?phone=<?php echo $valwhatsapp->phone; ?>&amp;text=<?php echo $valwhatsapp->text; ?>" target="_blank"><i class="fa fa-whatsapp fa-2x mt-1"></i></a>
<a href="#top" class="back-to-top"><i class="fa fa-chevron-up"></i></a>