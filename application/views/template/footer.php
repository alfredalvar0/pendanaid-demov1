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
							 	<a href="<?php echo base_url() ?>"><img class="logosupport" src="<?php echo base_url()?>assets/img/partner/logo_pse.png" style="width:40%"></a>
							 	<a href="<?php echo base_url() ?>"><img class="logosupport" src="<?php echo base_url()?>assets/img/partner/logo_bsi.png" style="width:40%"></a>
							 	<a href="<?php echo base_url() ?>"><img class="logosupport" src="<?php echo base_url()?>assets/img/partner/logo_ksei.png" style="width:40%"></a>
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
