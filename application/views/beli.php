 
<!--==========================
   Detail Section
============================-->
<?php

$dt=$data_produk->row(); 
$foto=$dt->foto==""?"default.jpg":"produk/".$dt->foto;
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
//$total_invest_sekunder= $this->m_invest->dataTotalinvestSekunder($wh2)->row();

//tes perbaikan beli saham
$total_invest= $this->m_invest->dataTotalinvest($wh2)->row();


?>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 <script>
 <?php if($msg=="success"){?>
 Swal.fire({
  title: "<i>Anda Telah Melakukan Pembelian Saham</i>", 
  html: "Berhasil",  
  confirmButtonText: "OK", 
});
 <?php } ?>
 </script>
<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<section id="content">
    <div class="container py-5">
        <div class="section">
            <div class="row my-5">
				 <div class="col-md-3 mb-5"> 
				 </div>
				<div class="col-md-6 mb-5"> 
					<h1><?php echo $dt->judul; ?></h1>
					<p>Sisa lembar saham tersedia : <span style="color:red"><?php echo ($dt->lembar_saham-$total_invest->lembar); ?> Lembar Saham Tersedia<span></p>
					<p>Minimal pembelian <?php echo ($dt->minimal_beli); ?> lembar saham</p>
					<p style="color:green; font-size:18px">Rp. <?php echo number_format($dt->harga_perlembar,2); ?></p>
					<input type="hidden" name="minimal_beli" id="minimal_beli" value="<?= $dt->minimal_beli ?>">
				</div>
				<div class="col-md-3 mb-5"> 
					
				</div>
				
				 <div class="col-md-3 mb-5"> 
				 </div>
				<div class="col-md-6">
				
				
					<form method="POST" enctype="multipart/form-data" id="myForm"    class="form-horizontal"  action="<?php echo base_url() ?>invest/doBeli/<?php echo $dt->id_produk; ?><?php if(isset($_GET['type'])) echo "?type=sekunder";?>">
      
					  <div class="box-body">
						

						<div class="form-group">
						  <label for="inputEmail3" class="col-sm-12 control-label">Lembar saham yang dibeli</label>
						  <div class="col-sm-12">
							 
							 <div class="input-group">
								  <span class="input-group-btn">
									  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
										<span class="glyphicon glyphicon-minus"></span>
									  </button>
								  </span>
								  <input type="text" name="quant[2]" id="pengali" class="form-control input-number" value="1" min="1" max="<?php echo ($dt->lembar_saham-$total_invest->lembar); ?>">
								  <span class="input-group-btn">
									  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
										  <span class="glyphicon glyphicon-plus"></span>
									  </button>
								  </span>
							  </div>
							 
						 
						  </div>
						  
						
						</div>
						<div class="form-group">
						  <label for="inputEmail3" class="col-sm-12 control-label">Total Harga</label>
						  <div class="col-sm-12">
							<input type="hidden" id="hargalot"  value="<?php echo $dt->harga_perlembar?>">
							<input type="number" id="totalharga" readonly value="<?php echo $dt->harga_perlembar?>" class="form-control" placeholder="" name="total" aria-describedby="sizing-addon2">
						  </div>
						</div>
						
						   
					  </div>
					  <br> 
					  <div class="row">
						 
						<div class="col-md-6" >
							<a href="javascript:;" onclick="ceksaldo(<?php echo $saldo->saldo?>)" class="form-control btn btn-success" style="font-size:20px;height:40px;">
								<i class="glyphicon glyphicon-ok"></i> Beli Saham 
							</a>
						</div>
						
						<div class="col-md-6">
						  <a href="<?php echo base_url() ?>invest/detail/<?php echo $url?>"  class="form-control btn btn-danger" style="font-size:20px;height:40px;">
							<i class="glyphicon glyphicon-remove"></i> Batalkan
						  </a>
						</div>
						
						 

					  </div>
					</form>
					
				</div>
				  <div class="col-md-3 mb-5"> 
				 </div>
				 
			</div>
			   
        </div>
    </div>
</section>
<br><br><br><br>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
function ceksaldo(saldo){
	var harga = document.getElementById('pengali').value * document.getElementById('hargalot').value;
	 
	var jumlah_beli = document.getElementById('pengali').value;
	var min_beli    = document.getElementById('minimal_beli').value;
	if (parseInt(jumlah_beli) < parseInt(min_beli)) {
		Swal.fire( 'Gagal', 'Minimal pembelian '+min_beli+' saham !',  'error' );
		return false;
	}

	if(saldo >= harga){
		 document.getElementById("myForm").submit();
	}else{
		Swal.fire( 'Gagal', 'Saldo anda tidak cukup!',  'error' );
		 
	}
}
//plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number').click(function(e){
    e.preventDefault();
    var hargalembar = <?php echo $dt->harga_perlembar?>;
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }
			
			document.getElementById('totalharga').value = hargalembar * (currentVal - 1);

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }
			document.getElementById('totalharga').value = hargalembar * (currentVal + 1);
        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    var hargalembar = <?php echo $dt->harga_perlembar?>;
	
	 
	
    minValue =  parseInt($('#minimal_beli').val()); // parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled'); 
		document.getElementById('totalharga').value = hargalembar * document.getElementById('pengali').value;
    } else {
        alert('Maaf, pembelian saham minimal '+minValue+' lembar');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
		document.getElementById('totalharga').value = hargalembar * document.getElementById('pengali').value;
    } else {
        alert('Maaf, anda melebihi kuota maksimal');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	
	function isValidForm() {
		 document.getElementById('myForm').onsubmit = function() {
			return isValidForm();
		  };
	}
</script>

  