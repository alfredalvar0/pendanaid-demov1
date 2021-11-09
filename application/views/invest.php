<br><br><br>
<!--==========================
   Invest Section
============================-->
<?php
$dt = $data_produk->row();
$target = ($dt->minimal_pendanaan*$dt->bagi_hasil)/100;
?>
<section id="team">
    <div class="container wow fadeInUp mt-5">
    
        <div class="row">
            <div class="col-12">
                <h3><?php echo $dt->judul; ?></h3>
            </div>
            <div class="col-6 mb-3">
                Pengembalian Pokok Investasi
                <h4><?php echo $dt->pengembalian_pokok; ?></h4>
            </div>
            <div class="col-6">
                Frekuensi pembayaran bagi hasil
                <h4><?php echo $dt->frekuensi_angsuran; ?></h4>
            </div>
            <div class="col-12 mb-3">
                Jumlah pemberian pinjaman
                <h4>Rp. <?php echo number_format($dt->minimal_pendanaan,0,".","."); ?></h4>
            </div>
            <div class="col-12">
                Target pengembalian
                <h4>Rp. <?php echo number_format($dt->minimal_pendanaan+$target,0,".","."); ?></h4>
            </div>
            <div class="col-12 mb-3">
                Anda akan mendapatkan pengembalian Rp. <?php echo number_format($target,0,".","."); ?> lebih besar dibandingkan produk finansial lain dengan imbal hasil <?php echo $dt->bagi_hasil; ?> % pa.
            </div>
        </div>
    </div>
</section>  
    <div class="container wow fadeInUp mb-5">
        <div class="row">
            <div class="col-6 mt-3">
                Dana Anda saat ini
                <h4>Rp. <?php echo number_format($this->session->userdata("invest_dana"),0,".","."); ?></h4>
            </div>
            <div class="col-6 text-right mt-3">
                <!-- <i class="fa fa-refresh" style="font-size: 20px;color: orange;"></i> -->
            </div>
            <?php
            if($this->session->userdata("invest_dana")<$dt->minimal_pendanaan){
            ?>
            <div class="col-12 mb-3">
                Dana Anda tidak cukup untuk melakukan pemberian pinjaman.<br/> Silahkan klik tombol Tambah Dana untuk melihat mode pembayaran
            </div>
            <?php
            }
            ?>
            <div class="col-12">
                Jumlah pemberian pinjaman yang harus dibayar
                <h4>Rp. <?php echo number_format($dt->minimal_pendanaan,0,".","."); ?></h4>
            </div>
            <div class="col-12 text-center text">
                <button class="btn activate" style="border:2px solid #fdda0a;background-color:#fdda0a;">Tambah Dana</button>
            </div>
            
            <div class="col-12 text-center">&nbsp;
            <!--
                Klik tombol refresh di pojok kanan setelah tambah dana untuk perbaharui dana anda
                -->
            </div>
            
            <div class="col-12 text-center investconfirm">
                <a class="btn" href="javascript:;" onclick="history.back();" style="border:2px solid #fdda0a;">Batal</a>
                <?php
            if($this->session->userdata("invest_dana")>=$dt->minimal_pendanaan){
            ?>
                <button class="btn" id="btninvest" style="border:2px solid #fdda0a;background-color:#fdda0a;">Lanjut</button>
                <?php
            }
                ?>
            </div>
            
        </div>
    </div>
    
  <script type="text/javascript">
    $(document).ready(function(){
        $('.activate').click(function () {
			//$('.close-btn').click(function(){
				$('.tooltip').animate({ opacity: 0 }, 330, function(){
					$(this).remove();
				});
			//});
            $('.text').showToolTip({
                title: 'Tambah Dana',
                content: '<p> Lakukan penambahan nilai investasi ketika saldo untuk investasi anda belum mencukupi </p>'+
				'<p>Apakah Anda akan menambahkan saldo investasi Anda untuk berinvestasi di proyek property yang sedang berjalan ?</p>'+
				'<div class="row"><input class="col-12 form-control" type="number" id="jumlah_dana" min="1000000" max="999999999" /></div>'+
				'<p class="row"><a href="javascript:;" class="btn tooltip-btn col-6" style="border:2px solid #fdda0a;">Tidak</a>'+
				'<a href="javascript:;" id="pay" class="btn col-6" style="margin:10px 0;border:2px solid #fdda0a;background-color:#fdda0a;">Tambah Dana</a></p>',
                onApprove: function(){
					console.log('OK is clicked!');
					$('.tooltip').animate({ opacity: 0 }, 330, function(){
						$(this).remove();
					});
                }
            });
            $(".tooltip-action").hide();
			$('#jumlah_dana').focus();
			$('#jumlah_dana').keyup(function () {
				var thisvalue=$(this).val();
				if(parseInt(thisvalue)>=999999999){
					$(this).val(999999999);
				}
			});
            $('#pay').click(function (event) {
                event.preventDefault();
				var jumdana = $("#jumlah_dana").val() || 0;
				if(parseInt(jumdana)>=<?php echo intval($dt->minimal_pendanaan); ?> && parseInt(jumdana)<=999999999){
					payment("tambahdana","Tambah Dana"); 
				} else {
					if(parseInt(jumdana)<<?php echo intval($dt->minimal_pendanaan); ?>){
						alert("Inputkan minimal <?php echo number_format(intval($dt->minimal_pendanaan),0,".","."); ?>");
					} else if(parseInt(jumdana)>999999999){
						alert("Inputkan maksimal 999999999");
					} else {
						alert("Inputkan Jumlah Dana");
					}
					
				}
            });
        });
        $('#btninvest').click(function (event) {
            $('.investconfirm').showToolTip({
                title: 'Investasi',
                content: '<p> Inputkan investasi minimal sebesar Rp. <?php echo number_format($dt->minimal_pendanaan,0,".","."); ?> </p>'+
				'<div class="row mb-3"><input class="col-12 form-control" type="number" id="jumlah_dana" min="1000000" max="999999999" /></div>'+
				'<p>Apakah Anda yakin akan berinvestasi di proyek property yang sedang berjalan ?</p>'+
				'<p class="row"><a href="javascript:;" class="btn tooltip-btn col-6" style="border:2px solid #fdda0a;">Tidak</a>'+
				'<a href="javascript:;" id="invest" class="btn col-6" style="margin:10px 0;border:2px solid #fdda0a;background-color:#fdda0a;">Investasi</a></p>',
                onApprove: function(){
                console.log('OK is clicked!');
                }
            });
            $(".tooltip-action").hide();
			$('#jumlah_dana').focus();
			$('#jumlah_dana').keyup(function () {
				var thisvalue=$(this).val();
				if(parseInt(thisvalue)>=<?php echo intval($this->session->userdata("invest_dana")); ?>){
					$(this).val(<?php echo intval($this->session->userdata("invest_dana")); ?>);
				} else if(parseInt(thisvalue)>=999999999){
					$(this).val(999999999);
				}
			});
            $('#invest').click(function (event) {
                event.preventDefault();
				var jumdana = $("#jumlah_dana").val() || 0;
				if(parseInt(jumdana)>=<?php echo intval($dt->minimal_pendanaan); ?> && parseInt(jumdana)<=999999999){
					invest("<?php echo $dt->id_produk; ?>",jumdana,"<?php echo $dt->siteurl; ?>");
				} else {
					if(parseInt(jumdana)<<?php echo intval($dt->minimal_pendanaan); ?>){
						alert("Inputkan minimal <?php echo number_format(intval($dt->minimal_pendanaan),0,".","."); ?>");
					} else if(parseInt(jumdana)>999999999){
						alert("Inputkan maksimal 999999999");
					} else {
						alert("Inputkan Jumlah Dana");
					}
					
				}
                
            });
        });
    });
  function invest(id,amount,url){
    $.ajax({
        url: '<?=site_url()?>invest/proses_invest', //calling this function
        data:{id:id,jumlah_donasi:amount,url:url},
        type:'POST',
        cache: false,
        success: function(data) {
            window.location.href = data;
        }
    });
  }
  function payment(act,title){
      //$(this).attr("disabled", "disabled");
                  var action = act;
				  var jumdana = $("#jumlah_dana").val() || 0;
                  var id_user = "<?php echo $this->session->userdata("invest_pengguna"); ?>";//$("#id_user").val();
                  var phone = "<?php echo $this->session->userdata("invest_hp"); ?>";
                  var jum = jumdana;
                  var val=jum.replace(/\./g, '');
                  var id = "<?php echo $dt->id_produk; ?>";//$("#id").val();
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
                   
                   // alert(data);
                    //alert(data);
                   // location.reload(data);
                    window.location.href = data;
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
  }
   function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
      }

    
</script>