
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
   	<?php 
   	if(isset($_GET['msg'])){
   		if($_GET['msg']=="success"){?>
   			Swal.fire({
   				title: "<i>Anda Telah Melakukan Penjualan Saham</i>", 
   				html: "Berhasil",  
   				confirmButtonText: "OK", 
   			});
   		<?php }else if($_GET['msg']=="failed"){  ?>
   			Swal.fire({
   				title: "<i>Penjualan saham gagal</i>", 
   				html: "Gagal",  
   				confirmButtonText: "OK", 
   			});
   		<?php } }?>
   	</script>
   	<div id="app" class="dashboard">
   		<?= $sidebar; ?>
   		<div class="content-wrapper">
   			<nav class="top-toolbar navbar navbar-mobile navbar-tablet align-items-center bg-white">
   				<ul class="navbar-nav nav-left">
   					<li class="nav-item">
   						<a href="javascript:void(0)" data-toggle-state="aside-left-open">
   							<i class="icon dripicons-align-left"></i>
   						</a>
   					</li>
   				</ul>
   				<ul class="navbar-nav nav-center site-logo">
   					<li class="d-flex align-items-center">
   						<a href="<?= base_url(); ?>">
   							<div class="mobile_logo d-block">
   								<img src="<?= base_url(); ?>assets/img/new/logo_pendana.png" alt="Logo Pendana" width="50" height="50"
   								class="img-fluid">
   							</div>

   						</a>
   					</li>
   				</ul>
   			</nav>

   			<div class="content">
   				<!--START PAGE HEADER -->
   				<header class="page-header">
   					<h1>Penjualan Saham di Pasar Sekunder</h1>
   				</header>
   				<!--END PAGE HEADER -->
   				<!--START PAGE CONTENT -->
   				<section class="page-content container-fluid">
   					<div class="row">
   						<div class="col-12 col-lg-12 col-md-12">
   							<form method="POST" enctype="multipart/form-data" id="myForm" class="form-horizontal"  action="<?php echo base_url() ?>invest/doJual/<?php echo $dt->id_produk; ?><?php if(isset($_GET['type'])) echo "?type=sekunder";?>">
   								<div class="card">
   									<div class="card-header">
   										<b><?= $dt->judul; ?></b>
   									</div>
   									<div class="card-body">
   										<!-- <p class="mb-1" style="color:green;">Harga Beli <b>Rp. <?php echo number_format($dt->harga_perlembar,2); ?></b></p> -->
   										<!-- <p class="mb-1" >Lembar saham dimiliki : <span style="color:red"><?php echo ($data_produk_saham->lembar - $data_produk_saham_jual->lembar -$data_produk_saham_gadai->lembar) ?> Lembar <span></p> -->
   											<!-- <p class="mb-1" >Lembar saham dijual : <span style="color:red"><?php echo ($data_produk_saham_jual->lembar=="")? 0 : $data_produk_saham_jual->lembar;?> Lembar <span></p> -->
   												<!-- <p class="mb-1" >Lembar saham digadai : <span style="color:red"><?php echo ($data_produk_saham_gadai->lembar=="")? 0 : $data_produk_saham_gadai->lembar;?> Lembar <span></p> -->
   													<p class="mb-0">Jual saham ke investor lain yang membeli saham dengan jumlah lembar dan harga per lembar yang sama dengan yang anda inginkan.</p>
   													<hr>
   													<div class="form-group row">
   														<label for="inputEmail3" class="col-sm-12 control-label">Lembar saham yang dijual *</label>
   														<div class="col-sm-12">
   															<div class="input-group">
   																<span class="input-group-btn">
   																	<button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]" disabled="true">
   																		<span class="fa fa-minus"></span>
   																	</button>
   																</span>
   																<input type="text" name="quant[2]" id="pengali" class="form-control input-number" value="<?= $dt->minimal_beli ?>" min="<?= $dt->minimal_beli ?>" max="<?php echo ($data_produk_saham->lembar - $data_produk_saham_jual->lembar - $data_produk_saham_gadai->lembar)?>" readonly="readonly">
   																<span class="input-group-btn">
   																	<button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
   																		<span class="fa fa-plus"></span>
   																	</button>
   																</span>
   															</div>
   															<small>
   																<?php
   																	$lembar_saham_dimiliki = $data_produk_saham->lembar - $data_produk_saham_jual->lembar - $data_produk_saham_gadai->lembar;
   																	if ($lembar_saham_dimiliki >= $dt->minimal_beli) {
   																 		echo '* minimal '.$dt->minimal_beli.' lembar, maksimal ' . ($lembar_saham_dimiliki) . ' lembar';
   																	} else {
   																		echo '* minimal '.$dt->minimal_beli.' lembar, <span class="text-danger"> saham Anda tidak mencukupi ('.$lembar_saham_dimiliki.' lembar).</span>';
   																	}
   																?>
   															</small>
   														</div>
   													</div>
   													<div class="form-group row">
   														<label for="inputEmail3" class="col-sm-12 control-label">Harga per lembar **</label>
   														<div class="col-sm-12">
   															<div class="input-group">
   																<span class="input-group-btn">
   																	<button type="button" class="btn btn-danger btn-price"  data-type="minus" data-field="harga_perlembar" disabled="true">
   																		<span class="fa fa-minus"></span>
   																	</button>
   																</span>
   																<input type="number" value="<?php echo $dt->min_harga_perlembar?>" class="form-control input-price" min="<?= $dt->min_harga_perlembar ?>" max="<?= $dt->maks_harga_perlembar ?>" name="harga_perlembar" id="harga_perlembar" readonly="readonly">
   																<span class="input-group-btn">
   																	<button type="button" class="btn btn-success btn-price" data-type="plus" data-field="harga_perlembar">
   																		<span class="fa fa-plus"></span>
   																	</button>
   																</span>
   															</div>
   															<small><?= '** min. Rp ' . number_format($dt->min_harga_perlembar, 0, '', '.') . ' maks. Rp ' . number_format($dt->maks_harga_perlembar, 0, '', '.') . ' kelipatan ' . (($dt->jenis_kelipatan == 'nominal') ? 'Rp ' : '') . number_format($kelipatan, 0, '', '.') . (($dt->jenis_kelipatan == 'persen') ? ' %' : '') ?></small>
   														</div>
   													</div>
   													<div class="form-group row">
   														<label for="inputEmail3" class="col-sm-12 control-label">Total harga ***</label>
   														<div class="col-sm-12">
   															<input type="hidden" id="hargalot"  value="<?php echo $dt->harga_perlembar ?>">
   															<input type="hidden" name="nilai_biaya_admin" value="<?php echo $dt->nilai_biaya_admin?>">
   															<input type="hidden" name="jenis_biaya_admin" value="<?php echo $dt->jenis_biaya_admin?>">
   															<input type="hidden" name="nilai_biaya_kustodian" value="<?php echo $dt->nilai_biaya_kustodian?>">
   															<input type="hidden" name="jenis_biaya_kustodian" value="<?php echo $dt->jenis_biaya_kustodian?>">
   															<input type="number" id="totalharga" readonly value="<?php echo $dt->harga_perlembar * $dt->minimal_beli ?>" class="form-control" placeholder="" name="total" aria-describedby="sizing-addon2">
   															<small>*** belum dipotong biaya admin (<?= ($dt->jenis_biaya_admin == 'nominal') ? 'Rp ' : '' ?><?= number_format($dt->nilai_biaya_admin, 0, '', '.') ?><?= ($dt->jenis_biaya_admin == 'persen') ? ' %' : '' ?>) dan biaya kustodian (<?= ($dt->jenis_biaya_kustodian == 'nominal') ? 'Rp ' : '' ?><?= number_format($dt->nilai_biaya_kustodian, 0, '', '.') ?><?= ($dt->jenis_biaya_kustodian == 'persen') ? ' %' : '' ?>)</small>
   														</div>
   													</div>
   													<hr>
   													<div class="form-group row mb-0">
   														<?php if ($data_produk_saham->total === NULL || ($data_produk_saham->lembar - $data_produk_saham_jual->lembar - $data_produk_saham_gadai->lembar) == 0  || ($data_produk_saham->lembar - $data_produk_saham_jual->lembar - $data_produk_saham_gadai->lembar) < $dt->minimal_beli): ?>
   															<div class="col-md-6" >
   																<button type="button" class="btn btn-secondary btn-lg btn-block" disabled="disabled">
   																	<i class="fa fa-check"></i> Jual Saham 
   																</button>	
   															</div>
   															<div class="col-md-6">
   																<a href="<?php echo base_url('invest/detail/' . $dt->siteurl . '?type=sekunder') ?>"  class="btn btn-danger btn-lg btn-block">
   																	<i class="fa fa-remove"></i> Batalkan
   																</a>
   															</div>
   															<div class="col-md-12">
   																<small class="text-danger">Anda tidak memiliki saham <?= $dt->judul ?></small>
   															</div>
   														<?php else: ?>
   															<div class="col-md-6" >
   																<a href="javascript:;" onclick="cekJual()" class="btn btn-success btn-lg btn-block">
   																	<i class="fa fa-check"></i> Jual Saham 
   																</a>
   															</div>
   															<div class="col-md-6">
   																<a href="<?php echo base_url('invest/detail/' . $dt->siteurl . '?type=sekunder') ?>"  class="btn btn-danger btn-lg btn-block">
   																	<i class="fa fa-remove"></i> Batalkan
   																</a>
   															</div>
   														<?php endif ?>
   													</div>
   												</div>
   											</div>
   										</form>
   									</div>
   								</div>
   							</section>
   						</div>

   					</div>
   				</div>
<!-- 
<section id="team" >
    <div class="container"  >
        <div class="section">
            <div class="row my-5">
				 <div class="col-md-3 mb-5"> 
				 </div>
				<div class="col-md-6 mb-5"> 
					<h1><?php echo $dt->judul; ?></h1>
					<p style="color:green; font-size:18px">Harga Beli <b>Rp. <?php echo number_format($dt->harga_perlembar,2); ?></b></p>
					<br>
					<p>Lembar saham dimiliki : <span style="color:red"><?php echo ($data_produk_saham->lembar - $data_produk_saham_jual->lembar -$data_produk_saham_gadai->lembar) ?> Lembar <span></p>
					<p>Lembar saham dijual : <span style="color:red"><?php echo ($data_produk_saham_jual->lembar=="")? 0 : $data_produk_saham_jual->lembar;?> Lembar <span></p>
					<p>Lembar saham digadai : <span style="color:red"><?php echo ($data_produk_saham_gadai->lembar=="")? 0 : $data_produk_saham_gadai->lembar;?> Lembar <span></p>
					
				</div>
				<div class="col-md-3 mb-5"> 
					
				</div>
				
				 <div class="col-md-3 mb-5"> 
				 </div>
				<div class="col-md-6">
				
				
					<form method="POST" enctype="multipart/form-data" id="myForm" class="form-horizontal"  action="<?php echo base_url() ?>invest/doJual/<?php echo $dt->id_produk; ?>">
      
					  <div class="box-body">
						

						<div class="form-group">
						  <label for="inputEmail3" class="col-sm-12 control-label">Lembar saham yang dijual</label>
						  <div class="col-sm-12">
							 
							 <div class="input-group">
								  <span class="input-group-btn">
									  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
										<span class="fa fa-minus"></span>
									  </button>
								  </span>
								  <input type="text" name="quant[2]" id="pengali" class="form-control input-number" value="1" min="1" max="<?php echo $data_produk_saham->lembar?>">
								  <span class="input-group-btn">
									  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
										  <span class="fa fa-plus"></span>
									  </button>
								  </span>
							  </div>
							 
						 
						  </div>
						  
						
						</div>
						<div class="form-group">
						  <label for="inputEmail3" class="col-sm-12 control-label">Total Harga Beli </label>
						  <div class="col-sm-12">
							<input type="hidden" id="hargalot"  value="<?php echo $dt->harga_perlembar?>">
							<input type="number" id="totalharga" readonly value="<?php echo $dt->harga_perlembar?>" class="form-control" placeholder="" name="total" aria-describedby="sizing-addon2">
						  </div>
						</div>
						
						   
					  </div>
					  <br> 
					  <div class="row">
						 
						<div class="col-md-6" >
							<a href="javascript:;" onclick="cekJual()" class="form-control btn btn-success" style="font-size:20px;height:40px;">
								<i class="glyphicon glyphicon-ok"></i> Jual Saham 
							</a>
						</div>
						
						<div class="col-md-6">
						  <a href="<?php echo base_url() ?>investor/proyeksi"  class="form-control btn btn-danger" style="font-size:20px;height:40px;">
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
-->
<br><br><br><br>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>

	function cekJual(){
		Swal.fire({
			title: 'Peringatan',
			text: "Yakin akan jual saham ini?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes'
		}).then((result) => {
			if (result.value) {
				document.getElementById("myForm").submit();
			}
		}) 


	}

	function ceksaldo(saldo){
		var harga = document.getElementById('pengali').value * document.getElementById('hargalot').value;

		if(saldo >= harga){
			document.getElementById("myForm").submit();
		}else{
			Swal.fire({
				title: "<br><br>Maaf, saldo anda tidak cukup<br><br>", 
				html: "",  
				confirmButtonText: "OK", 
			});


		}
	}
//plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number').click(function(e){
	e.preventDefault();
	var hargalembar = document.getElementById('harga_perlembar').value;
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
	var hargalembar = document.getElementById('harga_perlembar').value;	
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

$('.btn-price').click(function(e)
{
	e.preventDefault();

	dataField = $(this).attr('data-field');
	dataType  = $(this).attr('data-type');

	// let hargalembar = document.getElementById('harga_perlembar').value;
	let kelipatan = <?= $kelipatan ?>;
	let lembarSaham = parseInt($("input[name='quant[2]']").val());
	let input = $("input[name='"+dataField+"']");
	let currentValue = parseInt(input.val());

	if (!isNaN(currentValue)) {
		if(dataType == 'minus') {

			if(currentValue > input.attr('min')) {
				input.val(currentValue - kelipatan).change();
			} 
			if(parseInt(input.val()) == input.attr('min')) {
				$(this).attr('disabled', true);
			}
			
			document.getElementById('totalharga').value = (currentValue - kelipatan) * lembarSaham;

		} else if(dataType == 'plus') {

			if(currentValue < input.attr('max')) {
				input.val(currentValue + kelipatan).change();
			}
			if(parseInt(input.val()) == input.attr('max')) {
				$(this).attr('disabled', true);
			}
			document.getElementById('totalharga').value = (currentValue + kelipatan) * lembarSaham;
		}
	} else {
		input.val(0);
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
		$(".btn-price[data-type='minus'][data-field='"+name+"']").removeAttr('disabled'); 
		document.getElementById('totalharga').value = hargalembar * document.getElementById('pengali').value;
	} else {
		// $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled'); 
		alert(`Maaf, pembelian saham minimal ${minValue}`);
		$(this).val($(this).data('oldValue'));
	}

	if(valueCurrent <= maxValue) {
		$(".btn-price[data-type='plus'][data-field='"+name+"']").removeAttr('disabled'); 
		document.getElementById('totalharga').value = hargalembar * document.getElementById('pengali').value;
	} else {
		alert(`Maaf, pembelian saham maksimal ${maxValue}`);
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

