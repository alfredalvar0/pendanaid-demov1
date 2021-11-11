 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<br><br><br><br><br><br>

    <!--==========================
       Register Section
    ============================-->
    <section id="team">
        <div class="container">
            <div class="section-header">
                <h3><?php echo ucfirst($role_reg); ?></h3>
                <h3><?php echo ucfirst($choice_reg); ?></h3>
            </div>
        </div>
        <div class="row wow fadeInUp">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <form action="<?php echo base_url() ?>invest/register_proses" id="formreg" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <h5>Identitas Anda</h5>
                            <label>Mohon pastikan data di bawah ini sesuai dengan KTP anda</label>
                            <input type="hidden" name="user_reg" class="form-control" value="<?php echo $user_reg; ?>" />
                            <input type="hidden" name="pass_reg" value="<?php echo $pass_reg; ?>" />
                            <input type="hidden" name="role_reg" value="<?php echo $role_reg; ?>" />
                            <input type="hidden" name="choice_reg" value="<?php echo $choice_reg; ?>" />
                            <div class="form1 frm" style="padding: 25px;border: 1px solid black;">
								<div class="form-group">
                                    <label for="noktp">No. KTP</label>
                                    <input type="text" class="form-control inp1" name="noktp" id="noktp" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="name" id="nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="jk">Jenis Kelamin</label>
                                    <select name="seljk" class="form-control" id="jk" data-inp="jkinp" required>
                                        <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                    <input type="hidden" id="jkinp" name="jk" />
                                </div>
                                <div class="form-group">
                                    <label for="tempat">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="birthplace" id="tempat" required>
                                </div>
                                <div class="form-group">
                                    <label for="tgl">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="birthdate" id="tgl" required>
                                </div>
                                <div class="form-group">
                                    <label for="marriage">Status Perkawinan</label>
                                    <select name="selmrg" class="form-control" data-inp="mrginp" id="marriage" required>
                                        <option value="" selected disabled>-- Pilih Status Perkawinan --</option>
                                        <option value="1">Belum Menikah</option>
                                        <option value="2">Sudah Menikah</option>
                                    </select>
                                    <input type="hidden" id="mrginp" name="marriage" />
                                </div>
                                <div class="form-group">
                                    <label for="religion">Agama</label>
                                    <select name="selrlg" class="form-control" data-inp="rlginp" id="religion" required>
                                        <option value="" selected disabled>-- Pilih Agama --</option>
										<?php
										foreach($dataAgama->result() as $dta){
											?>
											<option value="<?php echo $dta->id_agama; ?>"><?php echo $dta->nama_agama; ?></option>
											<?php
										}
										?>
                                    </select>
                                    <input type="hidden" id="rlginp" name="religion" />
                                </div>
                                <div class="form-group">
                                    <label for="lastedu">Pendidikan Terakhir</label>
                                    <select name="seledu" class="form-control" data-inp="eduinp" id="lastedu" required>
                                        <option value="" selected disabled>-- Pilih Pendidikan --</option>
										<?php
										foreach($dataPendidikan->result() as $dtp){
											?>
											<option value="<?php echo $dtp->id_pendidikan; ?>"><?php echo $dtp->nama_pendidikan; ?></option>
											<?php
										}
										?>
                                    </select>
                                    <input type="hidden" id="eduinp" name="lastedu" />
                                </div>
                                <div class="form-group">
                                    <label for="job">Pekerjaan</label>
                                    <input type="text" class="form-control" name="job" id="job" required>
                                </div>
                                <div class="form-group">
                                    <label for="aktp">Alamat KTP</label>
                                    <input type="text" class="form-control" name="aktp" id="aktp" onkeyup="checkAlamat();" required>
                                </div>
                                <div class="form-group">
                                    <label for="country">Negara</label>
                                    <select name="selcnt" class="form-control" data-inp="cntinp" id="country" required>
                                        <!-- <option value="" selected disabled>-- Pilih Negara --</option> -->
										<?php
										foreach($dataNegara->result() as $dtn){
											?>
											<option value="<?php echo $dtn->id; ?>"><?php echo $dtn->country_name; ?></option>
											<?php
										}
										?>
                                    </select>
                                    <input type="hidden" id="cntinp" name="country" />
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="provinsi">Provinsi</label>
                                            <select name="selpro" class="form-control" data-inp="proinp" id="provinsi" onchange="pilihKabKota(this.value,'kabkota')" required >
                                                <option value="" selected disabled>-- Pilih Provinsi --</option>
												<?php
												foreach($dataProvinsi->result() as $dtprov){
													?>
													<option value="<?php echo $dtprov->id; ?>" <?php echo $dtprov->name==$prov?"selected":""; ?>><?php echo $dtprov->name; ?></option>
													<?php
												}
												?>
                                            </select>
                                            <input type="hidden" id="proinp" name="provinsi" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="kabkota">Kabupaten/Kota</label>
                                            <select name="selkk" class="form-control" data-inp="kkinp" id="kabkota" required>
                                                <option value="" selected disabled>-- Pilih Kabupaten/Kota --</option>
												<?php
												foreach($dataKabKota->result() as $dtkk){
													?>
													<option value="<?php echo $dtkk->id; ?>" <?php echo $dtkk->name==$kabkota?"selected":""; ?>><?php echo $dtkk->name; ?></option>
													<?php
												}
												?>
                                            </select>
                                            <input type="hidden" id="kkinp" name="kabkota" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="hp">Nomor Handphone</label>
                                    <input type="text" class="form-control" name="hp" id="hp" onkeypress="return hanyaAngka(event)" required>
                                </div>
                                <div class="form-group">
                                    <label for="noa">Nomor Alternatif</label>
                                    <input type="text" class="form-control" name="noa" id="noa" onkeypress="return hanyaAngka(event)" required>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="samektp" onclick="checkAlamat();" style="width:auto;" >
                                    <label class="form-check-label" for="samektp">Alamat domisili saya sama dengan alamat KTP</label>
                                </div>
                                <div class="form-group">
                                    <label for="dom">Alamat Domisili</label>
                                    <input type="text" class="form-control" name="dom" id="dom" required>
                                </div>
                                <div class="form-group">
                                    <label for="country2">Negara</label>
                                    <select name="selcnt2" class="form-control" data-inp="cnt2inp" id="country2" required >
                                        <!-- <option value="" selected disabled>-- Pilih Negara --</option> -->
										<?php
										foreach($dataNegara->result() as $dtn){
											?>
											<option value="<?php echo $dtn->id; ?>"><?php echo $dtn->country_name; ?></option>
											<?php
										}
										?>
                                    </select>
                                    <input type="hidden" id="cnt2inp" name="country2" />
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="provinsi2">Provinsi</label>
                                            <select name="selp2" class="form-control" data-inp="p2inp" readonly="" id="provinsi2" onchange="pilihKabKota(this.value,'kabkota2')" required>
                                                <option value="" selected disabled>-- Pilih Provinsi --</option>
                                                <?php
												foreach($dataProvinsi->result() as $dtprov){
													?>
													<option value="<?php echo $dtprov->id; ?>" <?php echo $dtprov->name==$prov?"selected":""; ?>><?php echo $dtprov->name; ?></option>
													<?php
												}
												?>
                                            </select>
                                            <input type="hidden" id="p2inp" name="provinsi2" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="kabkota2">Kabupaten/Kota</label>
                                            <select name="selkk2" class="form-control" data-inp="kk2inp" id="kabkota2" required >
                                                <option value="" selected disabled>-- Pilih Kabupaten/Kota --</option>
                                                <?php
												foreach($dataKabKota->result() as $dtkk){
													?>
													<option value="<?php echo $dtkk->id; ?>" <?php echo $dtkk->name==$kabkota?"selected":""; ?>><?php echo $dtkk->name; ?></option>
													<?php
												}
												?>
                                            </select>
                                            <input type="hidden" id="kk2inp" name="kabkota2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="addr">Alamat Surat Menyurat</label>
                                    <input type="text" class="form-control" name="addr" id="addr" required>
                                </div>
                                <label>Apakah anda sudah yakin dengan data diri anda ?</label>
                                <div class="row step step1">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-lg  btn-block" style="border:2px solid #999;margin-right:5px" onclick="javascript:history.back()">Batal</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-lg  btn-block" style="border:2px solid #fdda0a;margin-left:5px;background-color:#fdda0a;" onclick="nextStep(2)" >Lanjut</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h5>Akun Bank</h5>
                            <label>&nbsp;</label>
                            <div class="form2 frm" style="padding: 25px;border: 1px solid black;">
                                <div class="form-group">
                                    <label for="account">Nama Pemegang Akun</label>
                                    <input type="text" class="form-control inp2" name="account" id="account" required>
                                </div>
                                <div class="form-group">
                                    <label for="norek">Nomor Rekening</label>
                                    <input type="text" class="form-control" name="norek" id="norek" onkeypress="return hanyaAngka(event)" required>
                                </div>
                                <div class="form-group">
                                    <label for="bank">Bank</label>
                                    <select name="selbank" class="form-control" data-inp="bankinp" id="bank" required>
                                        <option value="" selected disabled>-- Pilih Bank --</option>
										<?php
										foreach($dataBank->result() as $dtbank){
											?>
											<option value="<?php echo $dtbank->id_bank; ?>"  data-bankcode="<?php echo $dtbank->bank_code; ?>"><?php echo $dtbank->nama_bank; ?></option>
											<?php
										}
										?>
                                    </select>
                                    <input type="hidden" id="bankinp" name="bank" />
                                </div>
                                <div class="row step step2">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-lg  btn-block" style="border:2px solid #999;margin-right:5px" onclick="nextStep(1)">Batal</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-lg  btn-block" style="border:2px solid #fdda0a;margin-left:5px;background-color:#fdda0a;" onclick="nextStep(3)">Lanjut</button>
                                    </div>
                                </div>
                            </div>
							<!-- <h5>&nbsp;</h5>
                            <h5>Kode Referral</h5>
							<div class="frmx" style="padding: 25px;border: 1px solid black;">
                                <div class="form-group">
                                    <label for="referral">Input Kode Referral</label>
                                    <input type="text" class="form-control" name="referral" id="referral" >
                                </div>
							</div> -->
                            <!-- <h5>&nbsp;</h5>
                            <h5>Tanda Tangan</h5>
                            <div class="form3 frm" style="padding: 25px;border: 1px solid black;">
                                <label>Spesimen tanda tangan</label>
                                <label>Foto tanda tangan anda</label>
                                <div class="row mb-3">

									<input type="file" class="dropify" name="ttd" id="ttd" accept="application/pdf, image/*">
                                    <!-- <div class="custom-file">
                                        <input type="file" class="custom-file-input inp3" name="ttd" accept="application/pdf, image/*" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Ambil foto tanda tangan</label>
                                    </div> -->
                                <!-- </div>
                                <label>Silahkan ambil foto tanda tangan anda dikertas dengan latar belakang putih</label>
                                <div class="row step step3">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-lg  btn-block" style="border:2px solid #999;margin-right:5px" onclick="nextStep(2)">Batal</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-lg  btn-block" style="border:2px solid #fdda0a;margin-left:5px;background-color:#fdda0a;" onclick="nextStep(4)" />Lanjut</button>
                                    </div>
                                </div>
                            </div>  -->

                            <h5>&nbsp;</h5>
                            <h5>Dokumen Utama</h5>
                            <div class="form3 frm" style="padding: 25px;border: 1px solid black;">
                                <div class="row mb-6">
                                    <div class="col-md-12" style="text-align: center;">
                                        <label>
                                            Spesimen tanda tangan <br>
                                            Silahkan ambil foto tanda tangan anda dikertas dengan latar belakang putih
                                        </label>
                                        <input type="file" class="dropify" name="ttd" id="ttd" accept="application/pdf, image/*">
                                        <label></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6" style="text-align: center">
                                        <input type="file" class="dropify" name="ktp" id="ktp" accept="application/pdf, image/*">
                                        <label>KTP/Passport</label>
                                    </div>
                                    <div class="col-md-6" style="text-align: center">
                                        <input type="file" class="dropify" name="npwp" id="npwp" accept="application/pdf, image/*">
                                        <label>NPWP</label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6" style="text-align: center">
                                        <input type="file" class="dropify" name="buku_tabungan" id="buku_tabungan" accept="application/pdf, image/*">
                                        <label>Buku Tabungan</label>
                                    </div>
                                    <div class="col-md-6" style="text-align: center">
                                        <input type="file" class="dropify" name="selfie" id="selfie" accept="application/pdf, image/*">
                                        <label>Foto Selfie</label>
                                    </div>
                                </div>
                                <div class="row step step3">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-lg  btn-block" style="border:2px solid #999;margin-right:5px" onclick="nextStep(2)">Batal</button>
                                    </div>
                                    <div class="col-6">
                                        <input type="submit" class="btn btn-lg  btn-block" style="border:2px solid #fdda0a;margin-left:5px;background-color:#fdda0a;" value="Lanjut" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-1"></div>
        </div>
    </section>
	<br><br><br>
<script type="text/javascript">
    var step=0;
    $(document).ready(function(){
		$('.dropify').dropify();
        nextStep(1);
        step=1;
        $('select').change(function(){
            var value=$(this).data("inp");
            $("#"+value).val($(this).val());
        });
        setTimeout(function() { $('#noktp').focus() }, 1000);
    });
    function nextStep(nextstep){
        console.log(nextstep-1);
        var check = checkInpVal(nextstep-1);
        if(check){

            if (nextstep == 2) {

                /* check nomor ktp */

                $.ajax({
                    url: '<?= base_url() ?>invest/ceknomorktp',
                    type: 'POST',
                    data: {
                        'no_ktp': $('#noktp').val()
                    },
                    success: function (response) {
                        if (response == "false") {
                            Swal.fire(
                                'Gagal',
                                '<i>Nomor KTP sudah terdaftar.</i>',
                                'error'
                            ).then(function () {
                                nextStep(nextstep-1)
                            });
                            return false;
                        }
                    }    
                })

            }

            if (nextstep == 3) {

                /* check bank account name vs name */

                var bank_code = $('#bank').find(':selected').data('bankcode');
                var account_number = $('#norek').val();
                var name = $('#nama').val();
                var account_name = $('#account').val();
                var cekBank = JSON.parse(checkBankAccount(bank_code, account_number));
                if (cekBank.status.code == "000") {
                    var account_origin_name = cekBank.account_name;
                    if (name != account_origin_name) {
                        var conf = confirm('Nama tidak sama dengan nama pemilik rekening. Ubah nama menjadi '+ account_origin_name +' ?');
                        if (conf) {
                            $('#nama').val(account_origin_name);
                        } else {
                            return false;
                        }
                    }
                }
            }

            step=nextStep;
            $(".step").hide();
            $(".step"+nextstep).show();
            $('.frm.form'+nextstep+' input').prop("readonly",false);
            $('.frm.form'+nextstep+' input[type="file"], .frm.form'+nextstep+' select').prop("disabled",false);

            $('.frm:not(.form'+nextstep+') input').prop("readonly",true);
            $('.frm:not(.form'+nextstep+') input[type="file"],.frm:not(.form'+nextstep+') select').prop("disabled",true);

            setTimeout(function() { $('.inp'+nextstep).focus() }, 1000);
        }
    }
    function checkBankAccount(bank_code, account_number) {
      return $.ajax({
        url: '<?= base_url() ?>invest/checkBankAccount',
        type: 'POST',
        async: false,
        data: {
          'bank_code': bank_code,
          'account_number': account_number
        }
      }).responseText
    }
    function checkInpVal(st){
        var inpval=true;
        var inpfocus="";
        $('.frm.form'+st+' input:not([type=hidden]),.frm.form'+st+' select').each(function(){
            console.log($(this).attr("name")+" "+$(this).val());
            var value= $(this).val();
            if($(this).children("option:selected").length > 0 ){
                value=$(this).children("option:selected").val();
            }
            if (value.length == 0) {
                inpval=false;
                inpfocus=$(this).attr("id");
                return false;
            }
        });
        if(inpfocus!=""){
            setTimeout(function() { $("#"+inpfocus).focus().select() }, 1000);
        }
        return inpval;
    }
    function pilihKabKota(idprov,idkabkota){
		$.ajax({
			url: "<?php echo base_url(); ?>invest/pilihKabKota",
			type:"POST",
			data:{id_prov:idprov},
			beforeSend: function(e) {
				if(e && e.overrideMimeType) {
					e.overrideMimeType("application/json;charset=UTF-8");
				}
			},
			dataType:"json",
			success: function(response){
				$("#"+idkabkota).html(response.data_kabkota).show();
				$("#"+idkabkota).focus();
			}
		});
	}
	function checkAlamat(){
		if($('#samektp').prop('checked')){
			console.log("checked");
			$("#dom").val($("#aktp").val());
			$("#dom").prop("readonly",true);
			$("#cnt2inp").prop("readonly",true);
		} else {
			$("#dom").prop("readonly",false);
			$("#cnt2inp").prop("readonly",false);
			console.log("unchecked");
		}
	}
</script>
