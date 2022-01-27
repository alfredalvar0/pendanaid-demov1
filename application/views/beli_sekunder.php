 
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

   switch ($dt->jenis_kelipatan) {
   	case 'nominal':
   		$kelipatan = $dt->nilai_kelipatan;
   		break;

   	case 'persen':
   		$kelipatan = $dt->min_harga_perlembar * $dt->nilai_kelipatan / 100;
   		break;
   	
   	default:
   		$kelipatan = 5000;
   		break;
   }
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
   <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
   <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
   <section id="team" >
   	<div class="container"  >
   		<div class="section">
   			<div class="row my-5">
   				<div class="col-md-3 mb-5"> 
   				</div>
   				<div class="col-md-6 mb-5"> 
   					<h1><?php echo $dt->judul; ?></h1>
   					<!-- <p>Sisa lembar saham tersedia : <span style="color:red"><?php echo ($dt->lembar_saham-$total_invest->lembar); ?> Lembar Saham Tersedia<span></p> -->
   						<p>Beli saham dari investor lain yang menjual saham dengan jumlah lembar dan harga per lembar yang sama dengan yang anda inginkan.</p>
   						<!-- <p style="color:green; font-size:18px">Rp. <?php echo number_format($dt->harga_perlembar,2); ?></p> -->
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
   												<button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]" disabled="true">
   													<span class="glyphicon glyphicon-minus"></span>
   												</button>
   											</span>
   											<input type="text" name="quant[2]" id="pengali" class="form-control input-number" value="<?= $dt->minimal_beli ?>" min="<?= $dt->minimal_beli ?>" max="<?php echo ($dt->lembar_saham-$total_invest->lembar); ?>" readonly="readonly">
   											<span class="input-group-btn">
   												<button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
   													<span class="glyphicon glyphicon-plus"></span>
   												</button>
   											</span>
   										</div>
   										<label for="inputEmail3" class="col-sm-12 control-label">
   											<small><?= '* minimal '.$dt->minimal_beli.' lembar' ?></small>
   										</label>
   									</div>


   								</div>
   								<div class="form-group">
   									<label for="inputEmail3" class="col-sm-12 control-label">Harga per lembar *</label>
   									<div class="col-sm-12">
   										<input type="hidden" id="hargalot"  value="<?php echo $dt->min_harga_perlembar?>">

   										<div class="input-group">
   											<span class="input-group-btn">
   												<button type="button" class="btn btn-danger btn-price"  data-type="minus" data-field="price" disabled="true">
   													<span class="glyphicon glyphicon-minus"></span>
   												</button>
   											</span>
   											<input type="number" value="<?php echo $dt->min_harga_perlembar?>" min="<?= $dt->min_harga_perlembar ?>" max="<?= $dt->maks_harga_perlembar ?>" class="form-control input-price" placeholder="" name="harga_perlembar" id="harga_perlembar" aria-describedby="sizing-addon2" readonly="readonly">

   											<!-- <input type="text" name="price[2]" id="pengali" class="form-control input-number" value="<?= $dt->minimal_beli ?>" min="<?= $dt->minimal_beli ?>" max="<?php echo ($dt->lembar_saham-$total_invest->lembar); ?>"> -->
   											<span class="input-group-btn">
   												<button type="button" class="btn btn-success btn-price" data-type="plus" data-field="price">
   													<span class="glyphicon glyphicon-plus"></span>
   												</button>
   											</span>
   										</div>
   										
   									</div>
   									<label for="inputEmail3" class="col-sm-12 control-label">
   										<small>
   											<?= '* min. Rp ' . number_format($dt->min_harga_perlembar, 0, '', '.') . ' maks. Rp ' . number_format($dt->maks_harga_perlembar, 0, '', '.') . ' kelipatan '. (($dt->jenis_kelipatan == 'nominal') ? 'Rp ' : '') . number_format($dt->nilai_kelipatan, 0, '', '.') . (($dt->jenis_kelipatan == 'persen') ? ' %' : '') ?>
   										</small>
   									</label>
   								</div>

   								<div class="form-group">
   									<label for="inputEmail3" class="col-sm-12 control-label">Total harga ** </label>
   									<div class="col-sm-12">
   										<input type="hidden" id="hargalot"  value="<?php echo $dt->harga_perlembar?>">
   										<input type="hidden" name="nilai_biaya_admin" value="<?php echo $dt->nilai_biaya_admin?>">
   										<input type="hidden" name="jenis_biaya_admin" value="<?php echo $dt->jenis_biaya_admin?>">
   										<input type="number" id="totalharga" value="<?php echo $dt->harga_perlembar * $dt->minimal_beli ?>" class="form-control" placeholder="" name="total" aria-describedby="sizing-addon2" readonly>
   									</div>
   									<label for="inputEmail3" class="col-sm-12 control-label"><small>** belum ditambah biaya admin (<?= ($dt->jenis_biaya_admin == 'nominal') ? 'Rp ' : '' ?><?= number_format($dt->nilai_biaya_admin, 0, '', '.') ?><?= ($dt->jenis_biaya_admin == 'persen') ? ' %' : '' ?>) dan biaya kustodian (<?= ($dt->jenis_biaya_kustodian == 'nominal') ? 'Rp ' : '' ?><?= number_format($dt->nilai_biaya_kustodian, 0, '', '.') ?><?= ($dt->jenis_biaya_kustodian == 'persen') ? ' %' : '' ?>)</small>
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
   										<a href="<?php echo base_url() ?>invest/detail/<?php echo $url?>?type=sekunder"  class="form-control btn btn-danger" style="font-size:20px;height:40px;">
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
   				let harga = document.getElementById('pengali').value * document.getElementById('hargalot').value;

   				if(saldo >= harga){
   					document.getElementById("myForm").submit();
   				}else{
   					Swal.fire( 'Gagal', 'Saldo anda tidak cukup!',  'error' );

   				}
   			}

   			$('.btn-number').click(function(e) {
   				e.preventDefault();
   				let hargalembar = document.getElementById('harga_perlembar').value;
   				fieldName = $(this).attr('data-field');
   				type      = $(this).attr('data-type');
   				let input = $("input[name='"+fieldName+"']");
   				let currentVal = parseInt(input.val());
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

   			$('.btn-price').click(function(e)
   			{
   				e.preventDefault();
   				let hargalembar = document.getElementById('harga_perlembar').value;
   				let kelipatan = <?= $kelipatan ?>;
   				// fieldName = $(this).attr('data-field');
   				type = $(this).attr('data-type');
   				// let input = $("input[name='"+fieldName+"']");
   				let input = $("input[name='harga_perlembar']");
   				let lembarSaham = parseInt($("input[name='quant[2]']").val());
   				let currentValue = parseInt(input.val());

   				if (!isNaN(currentValue))
   				{
   					if(type == 'minus')
   					{
   						if(currentValue > input.attr('min'))
   						{
   							input.val(currentValue - kelipatan).change();
   						} 

   						if(parseInt(input.val()) == input.attr('min'))
   						{
   							$(this).attr('disabled', true);
   						}

   						document.getElementById('totalharga').value = (currentValue - kelipatan) * lembarSaham;
   					}
   					else if(type == 'plus')
   					{
   						if(currentValue < input.attr('max'))
   						{
   							input.val(currentValue + kelipatan).change();
   						}

   						if(parseInt(input.val()) == input.attr('max'))
   						{
   							$(this).attr('disabled', true);
   						}
   						
   						document.getElementById('totalharga').value = (currentValue + kelipatan) * lembarSaham;
   					}
   				}
   				else
   				{
   					input.val(input.attr('max'));
   				}
   			});

   			$('.input-number').focusin(function(){
   				$(this).data('oldValue', $(this).val());
   			});

   			$('.input-number').change(function() {
   				let hargalembar = document.getElementById('harga_perlembar').value;

   				minValue =  parseInt($(this).attr('min'));
   				maxValue =  parseInt($(this).attr('max'));
   				valueCurrent = parseInt($(this).val());

   				name = $(this).attr('name');
   				if(valueCurrent >= minValue) {
   					$(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled'); 
   					document.getElementById('totalharga').value = hargalembar * document.getElementById('pengali').value;
   				} else {
   					alert('Maaf, pembelian saham minimal 1 lembar');
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

   			$('.input-price').change(function()
   			{
   				let hargalembar = document.getElementById('harga_perlembar').value;

   				minValue = parseInt($(this).attr('min'));
   				maxValue = parseInt($(this).attr('max'));
   				currentValue = parseInt($(this).val());
   				// name = $(this).attr('name');
   				name = 'price';

   				if(currentValue >= minValue) {
   					$(".btn-price[data-type='minus'][data-field='"+name+"']").removeAttr('disabled'); 
   					document.getElementById('totalharga').value = hargalembar * document.getElementById('pengali').value;
   				} else {
   					alert('Maaf, pembelian saham minimal 1 lembar');
   					$(this).val($(this).data('oldValue'));
   				}
   				if(currentValue <= maxValue) {
   					$(".btn-price[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
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

   			$('.input-price').focusin(function(){
   				$(this).data('oldValue', $(this).val());
   			});

   			$('.input-price').change(function() {
   				let hargalembar = document.getElementById('harga_perlembar').value;

   				minValue =  parseInt($(this).attr('min'));
   				maxValue =  parseInt($(this).attr('max'));
   				valueCurrent = parseInt($(this).val());

   				name = $(this).attr('name');
   				if(valueCurrent >= minValue) {
   					// document.getElementById('totalharga').value = hargalembar * document.getElementById('pengali').value;
   				} else {
   					alert(`Minimal ${minValue}`);
   					$(this).val($(this).data('oldValue'));
   				}

   				if(valueCurrent <= maxValue) {
   					// document.getElementById('totalharga').value = hargalembar * document.getElementById('pengali').value;
   				} else {
   					alert(`Maksimal ${maxValue}`);
   					$(this).val($(this).data('oldValue'));
   				}
   			});

   			$(".input-price").keydown(function (e) {
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

