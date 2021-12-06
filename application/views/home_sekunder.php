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

<script>
	
	$(window).scroll(function() {	
	var result1 = $("#textScroll").offset().top;
	var result3 = $("#imgScroll").offset().top;
	var text1 = result1 - 500;
	var text3 = result3 - 500;
	    var scroll = $(window).scrollTop();
	    if (scroll >= text1) {
	        $("#textScroll").addClass("scrolled");
	    }else{
	    	$("#textScroll").removeClass("scrolled");
	    }
	    if (scroll >= text3) {
	        $("#imgScroll").addClass("scrolled");
	    }else{
	    	$("#imgScroll").removeClass("scrolled");
	    }
	});
	$(document).ready(function(){
		var result1 = $("#textScroll").offset().top;
		var text1 = result1 - 500;
		var scroll = $(window).scrollTop();
	    if (scroll >= text1) {
	        $("#textScroll").addClass("scrolled");
	    }else{
	    	$("#textScroll").removeClass("scrolled");
	    }
	});
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



<section class="pasar-sekunder">
	<div class="container">
		<h1 class="text-white font-red-hat-display text-center">Investasi Bisnis Sekunder</h1>
		<p class="text-white font-red-hat-display text-center mb-0">Lihat daftar investasi bisnis yang sedang berlangsung dan temukan peluang untuk berinvestasi hari ini.</p>
	</div>
</section>

<section class="pasar-sekunder-filters">
	<div class="container">
		<span class="text-left font-weight-bold mb-4 d-block">Filter By</span>
		<form action="<?php echo base_url(); ?>" method="POST">
			<div class="row">
				<div class="col-md-6 col-lg-3">
					<div class="form-group">
						<select name="kampanye" id="kampanye" class="form-control rf">
							<option value="all" selected>Tipe Bisnis</option>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="form-group">
						<select name="tenor" id="tenor" class="form-control rf">
							<option value="all" selected>Waktu Pembagian</option>
							<option value="lt6"><= 1 Bulan</option>
							<option value="gt6">> 1 Bulan</option>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="form-group">
						<select name="bunga" id="bunga" class="form-control rf">
							<option value="all" selected>Pembagian Dividen</option>
							<option value="lt12"><= 50%</option>
							<option value="gt12">> 50%</option>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="form-group">
						<select name="urutan" id="urutan" class="form-control rf">
							<option value="all" selected>Lihat Semua</option>
							<option value="Oldest">Bisnis Terlama</option>
							<option value="Newest">Bisnis Terbaru</option>
							<option value="Smallest">Nilai Terkecil</option>
							<option value="Biggest">Nilai Terbesar</option>
							<option value="smallrose">Dividen Terkecil</option>
							<option value="bigrose">Dividen Terbesar</option>
						</select>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>

<section class="projects mt-0 pt-0">
	<div class="container">
		<div class="row project-list">
		<?php
			$datany['data_produk'] = $data_produk;
            $this->load->view("list-data-sekunder", $datany);
        ?>
		</div>
	</div>
</section>

<script>
	var params = {};

	$(document).ready(function() {
		$(".rf").each(function() {
			params[$(this).attr('name')] = $(this).find('option:selected').val();
		});

		$('.rf').change(function() {
			params[$(this).attr('name')] = $(this).find('option:selected').val();
			$.ajax({
				url: "<?= base_url(); ?>invest/indexfilterSekunder", 
				data : params,
				type:"post",
				dataType:"html",
				success: function(result){ 
					$("#list-data").html(result);
				}
			});
		});
	});
</script>