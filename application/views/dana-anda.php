<?php
$dtdana=$dana->num_rows()>0?$dana->row():0;
$wh=array("id_pengguna"=>$this->session->userdata("invest_pengguna"));
$dtbank = $this->m_invest->dataBank($wh); ?>

<section id="content" style="background-color: #007bff;">
	<div class="container mt-0 py-5">
		<p class="mb-2 text-white">Saldo Anda Saat Ini:</p>
		<h3 class="text-white" style="font-size: 36px; font-weight: 700;">Rp. <?php echo $dana->num_rows()>0?number_format($dtdana->saldo,0,".","."):0; ?></h3>

		<div class="row mt-5">
			<div class="col-lg-6">
				<p class="text-white" style="font-weight: 600;">Deposit Limit</p>
				<div class="deposit-limit">
					<input type="number" placeholder="Nominal Deposit" class="form-control input-number mb-2" name="deposit" id="deposit">
					<span style="font-size: 14px;" class="text-white">* tambahkan saldo unik .<?php echo rand ( 100 , 999 )?> pada dana transfer anda untuk memudahkan pengecekan mutasi otomatis</span>
					<div class="btn-wrapper mt-4">
						<button type="button" class="activate btn mr-2 mt-2 mt-md-0" id="counter2" onclick="refreshsaldo()" style="background-color:#fdda0a;">Refresh Saldo</button>
						<button type="button" class="activate btn mt-2 mt-md-0" onclick="lihatrekening()" style="background-color:#fff;">Daftar Rekening</button>
					</div>
				</div>

				<p class="text-white mb-0 mt-4">Total Dana Deposit:</p>
				<p class="text-white">Rp. <?= $totalDanaDeposit->num_rows()>0?number_format($totalDanaDeposit->row()->total,0,".","."):0; ?></p>
			</div>

			<div class="col-lg-6">
				<p class="text-white" style="font-weight: 600;">Tarik Limit</p>
				<div class="tarik-limit">
				<?php
					if($dtbank->num_rows()>0 && ($dtbank->row()->nama_akun!="" && $dtbank->row()->no_rek!="" && $dtbank->row()->bank!="")){
						?>

						<form method="POST" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validateForm()" action="<?php echo base_url() ?>invest/doTarik">
							<div class="form-group">
								<input type="number" placeholder="Nominal Penarikan" class="form-control input-number" name="nominal" id="nominal">
							</div>
							<div class="form-row">
								<div class="col-6 col-md-8">
									<input type="number" placeholder="Kode" class="form-control  input-number" name="otp" id="otp">
								</div>
								<div class="col-6 col-md-4">
									<button type="button" class="tarik btn btn-block" onclick="kirimotp()" id="counter" style="background-color:#fff">Kirim OTP</button>
								</div>
							</div>
							<button type="button" class="btn mt-3" onclick="tarikdana()" style="background-color: #fdda0a;">Tarik Dana</button>
						</form>


						<?php
					} else {
						?>
						<a href="<?php echo base_url(); ?>investor/bank_account" class="btn btn-primary">Input User Bank</a>
						<?php
					}
					?>
				</div>
				<p class="text-white mb-0 mt-4">Total Tarik Dana:</p>
				<p class="text-white">Rp. <?= $totalDanaTarik->num_rows()>0?number_format($totalDanaTarik->row()->total,0,".","."):0; ?></p>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="container py-5">
		<h4 class="text-left mt-4 font-weight-bold">History Transaksi</h4>
		<?php if($dana->num_rows()>0) { ?>
			<div class="table-responsive">
				<table id="example" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col" class="text-center">Type</th>
							<th scope="col" class="text-center">Jumlah</th>
							<th scope="col" class="text-center">Status</th>
							<th scope="col" class="text-center">Tanggal</th>

						</tr>
					</thead>
					<tbody>
						<?php
						$num=0;
						foreach($danadtl->result() as $dt){
							$num++;
							?>
							<tr>
								<td><?php echo $dt->id_dana; ?></td>
								<td class="text-center"><?php echo $dt->type_dana; ?></td>
								<td class="text-right"><?php if($dt->status_approve=="refuse"){echo "Ditolak";}else{ ?>Rp. <?php echo number_format($dt->jumlah_dana,0,".",".");  } ?></td>
								<td class="text-center"><?php echo ucwords(strtolower($dt->status_approve)); ?></td>
								<td class="text-center"><?php echo $dt->createddate; ?><?php //echo date('d F Y H:i:s', strtotime($dt->createddate)); ?></td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
		<?php } else { ?>
			<div class="text-center">
				<embed name="E" id="E" src="<?php echo base_url() ?>assets/img/ico-wallet.svg" width="100px" height="100px">
				<p class="text-center">Anda belum melakukan transaksi</p>
			</div>
		<?php } ?>
	</div>
</section>
<script>

function lihatrekening(){
	window.location.href = "<?php echo base_url()?>investor/oy";
}
function tarikdana(){
	var nominal = document.getElementById("nominal").value ;
	var otp = document.getElementById("otp").value ;

	if(nominal !=="" && otp !==""){
		$.ajax({
		url: '<?=site_url()?>investor/tarikDana', //calling this function
		data:{nominal:nominal,otp:otp},
		type:'POST',
		cache: false,
		success: function(data) {
		console.log(data);
			if(data == "success"){

				Swal.fire( 'Sukses', 'Dana berhasil ditarik, silahkan menunggu pencairan!',  'success' );
				// start the countdown
				countdown();

				window.location.href = "<?php echo base_url()?>investor/dana_anda";
			}else{
				alert("Gagal kirim request penarikan");
			}

		}
	});


	}else{
		alert('Nominal penarikan dan kode OTP kosong!');
	}
}
function refreshsaldo(){

	 var nominal = document.getElementById("deposit").value ;

	if(nominal !==""){
		$.ajax({
		url: '<?=site_url()?>investor/cekMutasi', //calling this function
		data:{nominal:nominal},
		type:'POST',
		cache: false,
		success: function(data) {
		console.log(data);
			if(data == "success"){
				alert("Proses cek mutasi sedang berlangsung, silahkan tunggu");
				// start the countdown
				countdown2();
			}else{
				alert("Data mutasi tidak ditemukan");
			}

		}
	});


	}else{
		alert('Nominal deposit tidak boleh kosong!');
	}

}
function countdown2() {
    var seconds = 60;
    function tick() {
        var counter = document.getElementById("counter2");
        seconds--;
        counter.innerHTML = "Please Wait 0:" + (seconds < 10 ? "0" : "") + String(seconds);
        if( seconds > 0 ) {
            setTimeout(tick, 1000);
        } else {
            counter.innerHTML="Refresh Saldo";
			location.reload();
        }
    }
    tick();
}

function countdown() {
    var seconds = 60;
    function tick() {
        var counter = document.getElementById("counter");
        seconds--;
        counter.innerHTML = "0:" + (seconds < 10 ? "0" : "") + String(seconds);
        if( seconds > 0 ) {
            setTimeout(tick, 1000);
        } else {
            counter.innerHTML="Kirim OTP";
        }
    }
    tick();
}

function kirimotp(){
	var current_amount = '<?= $dtdana->saldo ?>';
	var withdraw_amount = $('#nominal').val();
	if (parseInt(withdraw_amount) > parseInt(current_amount)) {
		alert('Nominal penarikan melebihi jumlah saldo anda.');
		return false;
	}

	$.ajax({
		url: '<?=site_url()?>investor/kirimotp', //calling this function
		data:{notelp:""},
		type:'POST',
		cache: false,
		success: function(data) {
		console.log(data);
			if(data == "success"){
				alert("OTP Sudah terkirim");
				// start the countdown
				countdown();
			}else{
				alert("Gagal Kirim OTP");
			}

		}
	});


}

$(document).ready(function(){
	$('#example').DataTable( {
        "order": [[ 3, "desc" ]]
    } );

});

function tarikdana2(){
	var jum = $("#jumlah_tarik").val();
	if(parseInt(jum)>=100000 && parseInt(jum)<=<?php echo intval($this->session->userdata("invest_dana")); ?>){
		// tarik
		var passw=$("#passuser").val();
		$.ajax({
			url: '<?=site_url()?>invest/tarikDana', //calling this function
			data:{pass:passw,jumlah_tarik:jum},
			type:'POST',
			cache: false,
			dataType:"json",
			success: function(data) {
				if(data.result){
					//alert("sukses");
					location.reload();
				} else {
					alert("Password Salah");
					$("#passuser").val("");
					$("#passuser").focus();
				}
			}
		});
	} else {
		if(parseInt(jum)<100000 || parseInt(jum)><?php echo intval($this->session->userdata("invest_dana")); ?>){
			if(parseInt(jum)><?php echo intval($this->session->userdata("invest_dana")); ?>){
				alert("Penarikan Tidak bisa lebih dari <?php echo $this->session->userdata("invest_dana"); ?>");
			} else {
				alert("Minimal penarikan dana 100ribu");
			}
		}else{
			alert("Masukkan Jumlah Penarikan");
		}
		$('#jumlah_tarik').focus();
	}
}
function payment(act,title){

  //$(this).attr("disabled", "disabled");
	var jum = $("#jumlah_donasi").val();
	//if(parseInt(jum)>=1000000 && parseInt(jum)<=999999999){
		var action = act;
		var id_user = "<?php echo $this->session->userdata("invest_pengguna"); ?>";//$("#id_user").val();
		var phone = "<?php echo $this->session->userdata("invest_hp"); ?>";

		var val=jum.replace(/\./g, '');
		var id = "<?php echo rand(0,1000); ?>";//$("#id").val();
		var nama_program = title;//$("#nama_program").val();
		var email = "<?php echo $this->session->userdata("invest_email"); ?>";//$("#email").val();
		var firstname = "<?php echo $this->session->userdata("invest_username"); ?>";//$("#firstname").val();
		var ucapan_dukungan = "-";//$("#ucapan_dukungan").val();
		/* if($('#ckb').is(':checked')){
		firstname='Anonim';
		} */
		if(email!="" && jum!="" && val.length >= 5 && isEmail(email)==true){
			$.ajax({
				url: '<?=site_url()?>invest/proses_payment', //calling this function
				data:{id_user:id_user,jumlah_donasi:jum,id:id,nama_program:nama_program,email:email,firstname:firstname,ucapan_dukungan:ucapan_dukungan,phone:phone,action:action},
				type:'POST',
				cache: false,
				success: function(data) {
				    //alert(data);
				    console.log(data);
					//alert(data);
					// location.reload(data);
				//	window.location.href = data;
				}
			});
		}else{
			if(val.length < 5){
				alert("nominal tidak boleh kurang dari 10.000");
			}else if(email==""){
				alert("email harus di isi");
			}else if(isEmail(email)==false){
				alert("alamat email tidak sesuai");
			}
		}
	/* } else {
		if(parseInt(jum)<1000000 || parseInt(jum)>999999999){
			if(parseInt(jum)>999999999){
				alert("Input Tidak boleh lebih dari 999999999");
			} else {
				alert("Minimal pengisian Dana 1jt");
			}
		}else{
			alert("Masukkan Jumlah Dana");
		}
	} */
}
function isEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
