<?php
$dtdana=$dana->num_rows()>0?$dana->row():0;
$wh=array("id_pengguna"=>$this->session->userdata("invest_pengguna"));
$dtbank = $this->m_invest->dataBank($wh);

$useragent = $_SERVER['HTTP_USER_AGENT'];
$ismobile = false;
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{
   $ismobile = true; 
}

if($ismobile == true){
            echo "<br><br>";
        }
?>
 
 
<!--==========================
   Home Section
============================-->
<section id="team" ><br>
    <!--<section style="background-color: rgb(214, 134, 44);">-->
	 <section style="background-color: #007bff;padding:30px">
        <div class="container" >
            <div class="section-header">
                <div class="row">
                    <div class="col-md-12">
                        <h3 style="color:white;text-align: justify;" class="mt-3 mb-0">Rp. <?php echo $dana->num_rows()>0?number_format($dtdana->saldo,0,".","."):0; ?></h3>
						 
						<h4 style="color:white;text-align: justify;" class="m-0">Saldo anda saat ini</h4>
						<!--<p style="color:white;text-align: justify;" class="m-0 pb-4">Termasuk dana promo dan referral sebesar Rp. <?php echo $dana->num_rows()>0?number_format($dtdana->jumpnr,0,".","."):0; ?></p>-->
						<div class="row pb-5 mt-5">
							<div class="col-md-6 mt-3"> 
								<table >
									<tr>
										<td ><span style="color:#fff;font-weight:bold">Deposit Limit</span><br>&nbsp;</td> 
									</tr>
									<tr style="padding:5px">
										<td >
											<input type="number" placeholder="Nominal Deposit" class="form-control input-number" name="deposit" id="deposit" class="col-12">
											<span style="color:#fff;">* tambahkan saldo unik .<?php echo rand ( 100 , 999 )?> pada dana<br>transfer anda untuk memudahkan pengecekan<br> mutasi otomatis</span>
										</td> 
									</tr> 
								</table>
								 
								<button type="button" class="activate btn col-md-3" id="counter2" onclick="refreshsaldo()" style="background-color:#fdda0a;;margin-top:10px; margin-right:10px;width:100%">Refresh Saldo</button>
								  
								<button type="button" class="activate btn col-md-3"   onclick="lihatrekening()" style="background-color:#fff;;margin-top:10px;width:100%">Daftar Rekening</button>
								 
							</div>
							<div class="col-md-6 mt-3">
								<?php
								if($dtbank->num_rows()>0 && ($dtbank->row()->nama_akun!="" && $dtbank->row()->no_rek!="" && $dtbank->row()->bank!="")){
									?>
									 
									<form method="POST" enctype="multipart/form-data" class="form-horizontal"  onsubmit="return validateForm()" action="<?php echo base_url() ?>invest/doTarik">
										<table >
											<tr>
												<td colspan="2"><span style="color:#fff;font-weight:bold">Tarik Limit</span><br>&nbsp;</td> 
											</tr>
											<tr style="padding:5px">
												<td colspan="2"><input type="number" placeholder="Nominal Penarikan" class="form-control input-number" name="nominal" id="nominal" class="col-6"></td> 
											</tr>
											
											<tr>
												<td><input type="number" placeholder="Kode" class="form-control  input-number" name="otp" id="otp" class="col-6"></td>
												<td><button type="button" class="tarik btn" onclick="kirimotp()" id="counter" style="background-color:#fff">Kirim OTP</button></td>
											</tr>
										</table>
										 
										<button type="button" class="btn col-md-3" onclick="tarikdana()" style="background-color:#fdda0a;margin-top:10px">Tarik Dana</button>
									</form>
										 
									 
									<?php
								} else {
									?>
									<a href="<?php echo base_url(); ?>investor/bank_account" class="btn btn-primary">Input User Bank</a>
									<?php
								}
								?>
							</div>
						</div>
						<div class="row pb-4">
							<div class="col-6">
								<p class="m-0 p-0" style="color:white;text-align: justify;">Total dana deposit</p>
								<p class="m-0 p-0" style="color:white;text-align: justify;">Rp. <?php echo $totalDanaDeposit->num_rows()>0?number_format($totalDanaDeposit->row()->total,0,".","."):0; ?></p>
							</div>
							<div class="col-6">
								<p class="m-0 p-0" style="color:white;text-align: justify;">Total tarik dana</p>
								<p class="m-0 p-0" style="color:white;text-align: justify;">Rp. <?php echo $totalDanaTarik->num_rows()>0?number_format($totalDanaTarik->row()->total,0,".","."):0; ?></p>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<div class="container mt-5">
		<div class="row">
			<div class="col-12">
				<h4 class="text-left mt-4"><b>History Transaksi</b></h4>
			</div>
			<?php 
			if($dana->num_rows()>0){
			?>
			<div class="col-12 table-responsive">
				<table id="example" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col" class="text-center">Type</th>
							<th scope="col" class="text-center">Jumlah</th>
							<!--<th scope="col" class="text-center">Status</th>-->
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
								<!--<td class="text-center"><?php echo $dt->status_approve; ?></td>-->
								<td class="text-center"><?php echo $dt->createddate; ?><?php //echo date('d F Y H:i:s', strtotime($dt->createddate)); ?></td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
			<?php
			} else {
			?>
			<div class="col-12 text-center">
				<embed name="E" id="E" src="<?php echo base_url() ?>assets/img/ico-wallet.svg" width="100px" height="100px">
				<p class="text-center">Anda belum melakukan transaksi</p>
			</div>
			<?php
			}
			?>
		</div>
	</div>
</section><!-- #team -->
<br><br><br>
<script>

function lihatrekening(){
	window.location.href = "<?php echo base_url()?>investor/daftar_rekening";
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
				
				//window.location.href = "<?php echo base_url()?>investor/dana_anda"; 
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