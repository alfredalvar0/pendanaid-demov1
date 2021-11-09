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
<style>
    
</style>

<script>
jQuery(function ($) {
        var checkList = $('.dropdown-check-list');
        checkList.on('click', 'span.anchor', function(event){
            var element = $(this).parent();

            if ( element.hasClass('visible') )
            {
                element.removeClass('visible');
            }
            else
            {
                element.addClass('visible');
            }
        });
    });
</script>

<br><br><br><br>
<!--==========================
   Home Section style="background-color: rgb(214, 134, 44);"
============================-->
 
    		<!-- Slider -->
   <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	  	<?php
		$nums=0;
		foreach($dataSlider->result() as $sl){
			?>
			<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $nums; ?>" class="<?php if($nums==0) echo 'active'; ?>"></li>
		<?php $nums++; } ?> 
	  </ol>
	  <div class="carousel-inner">
		<?php
		$nums=0;
		foreach($dataSlider->result() as $sl){
			?>
		<div class="carousel-item <?php if($nums ==0) echo "active";?>">
		  <img class="d-block w-100" src="<?php echo base_url() ?>/assets/img/slider/<?php echo $sl->image_slider; ?>"   alt="First slide">
		</div>
		<?php $nums++; } ?>
		 
	  </div>
	  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" style="color: #C9FA98;">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	  </a>
	</div>
 
 
 <section id="team"  >
 
    <div class="container mt-5" >
 
		<div class="row mb-5">
			<?php
			if($dataSumAllProduk->num_rows()>0){
				$dts=$dataSumAllProduk->row();
				foreach($dataSumAllProduk->result() as $dts){
					$rp="";
					$jum=$dts->jum;
					if($dts->title=="Dana Terkumpul"){
						$rp="Rp ";
						$jum=$this->m_invest->terbilang($dts->jum);
					}
					$title= $dts->title;
					if($dts->title=="Proyek"){
						$title= "Total Usaha";
					}
					
					 
					?>
					<div class="col-md-3 text-center">
						<div class="row">
							<div class="col-md-12" >
								<h1><b class="<?php if($title=="Total Usaha") {echo "text-default";} else {echo "text-default";} ?>"><?php echo $rp.$jum; ?></b></h1>
								<p class="m-0 p-0"><?php echo strtoupper($title); ?></p>
							</div> 
						</div> 
					</div>
					<?php
				}
				$kumpul=0;
				foreach($danaTerkumpul->result() as $dtku){
					$kumpul=$kumpul+$dtku->jum;
				}
				$untung=0;
				foreach($keuntunganDibagikan->result() as $dtk){
					$untung=$untung+$dtk->jum;
				}
				?>
				<div class=" col-md-3 text-center">
					<div class="row">
						<div class="col-md-12" >
							<h1><b class="text-default">Rp <?php echo $this->m_invest->penyebut2($kumpul); ?></b></h1>
							<p class="m-0 p-0">TOTAL PENDANAAN</p>
						</div>
					</div>
				</div>
				<div class=" col-md-3 text-center ">
					<div class="row">
						<div class="col-md-12" >
							<h1><b class="text-default">Rp <?php echo $this->m_invest->penyebut2($untung); ?></b></h1>
							<p class="m-0 p-0">DEVIDEN DIBAGIKAN</p>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>

<section id="team" class=""  >
 
    <div class="container mt-5 bg-light border-0 shadow-lg" style="border-radius: 20px;" >
 
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <h3><b>INVESTASI BISNIS YANG SEDANG BERLANGSUNG</b></h3>
				<p>Lihat daftar investasi bisnis yang sedang berlangsung dan temukan peluang untuk berinvestasi hari ini.</p>
				<br/>
				<br/>
            </div>
        </div>
		<form action="<?php echo base_url(); ?>" method="post">
			<div class="row mb-5">
				<div class="col-md-3">
					<!--<h6>Tipe Kampanye <i class="fa fa-chevron-down"></i></h6>-->
					<div id="list3" class="dropdown-check-list">
						<span class="anchor">Tipe Bisnis </span>
						<ul class="items">
							<li><table width="100%"><tr>
								<td width="15%"><input class="rf" name="kampanye" type="radio" value="all" checked /></td>
								<td>Lihat Semua</td>
								</tr>
								</table>
							</li>
							
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<!--<h6>Lama Tenor <i class="fa fa-chevron-down"></i></h6>-->
					<div id="list3" class="dropdown-check-list">
						<span class="anchor">Waktu Pembagian</span>
						<ul class="items">
							<li><table width="100%"><tr>
								<td width="15%"><input class="rf" name="tenor" type="radio" value="all" checked /></td>
								<td>Lihat Semua</td>
								</tr>
								</table>
							</li>
							<li><table width="100%"><tr>
								<td width="15%"><input class="rf" name="tenor" type="radio" value="lt6"/></td>
								<td><= 1 Bulan</td>
								</tr>
								</table>
							</li>
							<li><table width="100%"><tr>
								<td width="15%"><input class="rf" name="tenor" type="radio" value="gt6"/></td>
								<td>> 1 Bulan</td>
								</tr>
								</table>
							</li>
						</ul>
					</div>
				</div>
				
				<div class="col-md-3">
					<!--<h6>Bunga Efektif <i class="fa fa-chevron-down"></i></h6>-->
					<div id="list3" class="dropdown-check-list">
						<span class="anchor">Pembagian Dividen</span>
						<ul class="items">
							<li><table width="100%"><tr>
								<td width="15%"><input class="rf" name="bunga" type="radio" value="all" checked /></td>
								<td>Lihat Semua</td>
								</tr>
								</table>
							</li>
							<li><table width="100%"><tr>
								<td width="15%"><input class="rf" name="bunga" type="radio" value="lt12"/></td>
								<td><= 50%</td>
								</tr>
								</table>
							</li>
							<li><table width="100%"><tr>
								<td width="15%"><input class="rf" name="bunga" type="radio" value="gt12"/></td>
								<td>> 50%</td>
								</tr>
								</table>
							</li>
							 
						</ul>
					</div>
				</div>
				  
				
				<div class="col-md-3">
					<!--<h6>Urutan <i class="fa fa-chevron-down"></i></h6>-->
					<div id="list3" class="dropdown-check-list">
						<span class="anchor">Urutan </span>
						<ul class="items">
							<li><table width="100%"><tr>
								<td width="15%"><input class="rf" name="urutan" type="radio" value="all" checked /></td>
								<td>Lihat Semua</td>
								</tr>
								</table>
							</li>
							<li><table width="100%"><tr>
								<td width="15%"><input class="rf" name="urutan" type="radio" value="Oldest"/></td>
								<td>Bisnis Terlama</td>
								</tr>
								</table>
							</li>
							<li><table width="100%"><tr>
								<td width="15%"><input class="rf" name="urutan" type="radio" value="Newest"/></td>
								<td>Bisnis Terbaru</td>
								</tr>
								</table>
							</li>
							<li><table width="100%"><tr>
								<td width="15%"><input class="rf" name="urutan" type="radio" value="Smallest"/></td>
								<td>Nilai Terkecil</td>
								</tr>
								</table>
							</li>
							<li><table width="100%"><tr>
								<td width="15%"><input class="rf" name="urutan" type="radio" value="Biggest"/></td>
								<td>Nilai Terbesar</td>
								</tr>
								</table>
							</li>
							<li><table width="100%"><tr>
								<td width="15%"><input class="rf" name="urutan" type="radio" value="smallrose"/></td>
								<td>Dividen Terkecil</td>
								</tr>
								</table>
							</li>
							<li><table width="100%"><tr>
								<td width="15%"><input class="rf" name="urutan" type="radio" value="bigrose"/></td>
								<td>Dividen Terbesar</td>
								</tr>
								</table>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</form>
		
		
        <div class="row mt-3" id="list-data">
            <?php
			$datany['data_produk']=$data_produk;
            $this->load->view("list-data",$datany);
            
            ?>
        </div>
		


		 
		<!--
		Sample <a href="https://web.whatsapp.com/send?phone=+6289699935552&amp;text=Salam Kenal Mas Nuris, Saya Ingin Diskusi" onclick="gtag('event', 'WhatsApp', {'event_action': 'whatsapp_chat', 'event_category': 'Chat', 'event_label': 'Chat_WhatsApp'});" target="_blank">Konsultasi Via Whatapps</a>
		-->
		<br><br>

	</div> <!-- div produk -->


	<div class="container mt-5" >
        <div class="row mt-5">
            <div class="col-md-6">
				<?php
				$ext = $this->m_invest->get_file_extension($dataBanner->image_banner);
				if($ext=="svg"){
				?>
                <embed name="E" id="E" src="<?php echo base_url() ?>assets/img/banner/<?php echo $dataBanner->image_banner; ?>" width="100%">
				<?php
				} else {
				?>
				<img src="<?php echo base_url() ?>assets/img/banner/<?php echo $dataBanner->image_banner; ?>" width="100%" />
				<?php
				}
				?>
            </div>
            <div class="col-md-6">
                <h3><?php echo $dataBanner->title_banner; ?></h3>
                <p><?php echo $dataBanner->desc_banner; ?></p>
            </div>
        </div>
    </div>
		<!-- <div class="row mt-5">
			<div class="col-md-12">
				<?php
				if($dataPerhatian->num_rows()>0){
					foreach($dataPerhatian->result() as $dt){
					?>
					<h3><?php echo $dt->judul; ?></h3>
					<?php echo $dt->content; ?>
					<?php
					}
				}
				?>
			</div>
		</div> -->
    
</section><!-- #team -->
<?php

?>
<script>
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