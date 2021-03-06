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
    .dropdown-check-list{
    display: inline-block;
    width: 100%;
    }
    .dropdown-check-list:focus{
    outline:0;
    }
    .dropdown-check-list .anchor {
    width: 98%;
    position: relative;
    cursor: pointer;
    display: inline-block;
    padding-top:5px;
    padding-left:5px;
    padding-bottom:5px;
    border:1px #ccc solid;
    }
    .dropdown-check-list .anchor:after {
    position: absolute;
    content: "";
    border-left: 2px solid black;
    border-top: 2px solid black;
    padding: 5px;
    right: 10px;
    top: 20%;
    -moz-transform: rotate(-135deg);
    -ms-transform: rotate(-135deg);
    -o-transform: rotate(-135deg);
    -webkit-transform: rotate(-135deg);
    transform: rotate(-135deg);
    }
    .dropdown-check-list .anchor:active:after {
    right: 8px;
    top: 21%;
    }
    .dropdown-check-list ul.items {
    padding: 2px;
    display: none;
    margin: 0;
    border: 1px solid #ccc;
    border-top: none;
    }
    .dropdown-check-list ul.items li {
    list-style: none;
    }
    .dropdown-check-list.visible .anchor {
    color: #0094ff;
    }
    .dropdown-check-list.visible .items {
    display: block;
    }
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

<br><br><br> 

<section id="team"  >
 
    <div class="container mt-1" >
 
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <h3><b>INVESTASI BISNIS SEKUNDER</b></h3>
				<p>Lihat daftar investasi bisnis yang sedang berlangsung dan temukan peluang untuk berinvestasi hari ini.</p>
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
            $this->load->view("list-data-sekunder",$datany);
            
            ?>
        </div>
		
		 
		<!--
		Sample <a href="https://web.whatsapp.com/send?phone=+6289699935552&amp;text=Salam Kenal Mas Nuris, Saya Ingin Diskusi" onclick="gtag('event', 'WhatsApp', {'event_action': 'whatsapp_chat', 'event_category': 'Chat', 'event_label': 'Chat_WhatsApp'});" target="_blank">Konsultasi Via Whatapps</a>
		-->
		<br><br><br>
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
    </div>
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
			url: "<?php echo base_url(); ?>invest/indexfilterSekunder", 
			data : nilai,
			type:"post",
			dataType:"html",
			success: function(result){ 
				$("#list-data").html(result);
			}
		});
	}
</script>