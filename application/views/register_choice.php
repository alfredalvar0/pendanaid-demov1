<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<section class="register-2">
    <div class="container py-5">
        <div class="section-header">
            <h1 class="font-weight-bold mb-5 text-md-center" style="font-size: 24px;">Daftar Sebagai: <?= ucfirst($role_reg); ?> - <?= ucfirst($choice_reg); ?></h1>
        </div>
        <form action="<?= base_url() ?>invest/register_proses" enctype="multipart/form-data" method="post">
            <div class="row wow fadeInUp">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h5 class="font-weight-bold mb-1">Identitas Anda</h5>
                    <span class="text-grey d-block mb-4">Mohon pastikan data di bawah ini sesuai dengan KTP anda</span>
                    <div class="card card-body shadow border-0">
                        <input type="hidden" name="user_reg" class="form-control" value="<?php echo $user_reg; ?>" />
                        <input type="hidden" name="pass_reg" value="<?php echo $pass_reg; ?>" />
                        <input type="hidden" name="role_reg" value="<?php echo $role_reg; ?>" />
                        <input type="hidden" name="choice_reg" value="<?php echo $choice_reg; ?>" />
                        <div class="form-group">
                            <label for="noktp" class="font-weight-bold">No. KTP</label>
                            <input type="text" class="form-control inp1" name="noktp" id="noktp" required>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="font-weight-bold">Nama</label>
                            <input type="text" class="form-control" name="name" id="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="jk" class="font-weight-bold">Jenis Kelamin</label>
                            <select name="seljk" class="form-control" id="jk" data-inp="jkinp" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <input type="hidden" id="jkinp" name="jk" />
                        </div>
                        <div class="form-group">
                            <label for="tempat" class="font-weight-bold">Tempat Lahir</label>
                            <input type="text" class="form-control" name="birthplace" id="tempat" required>
                        </div>
                        <div class="form-group">
                            <label for="tgl" class="font-weight-bold">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="birthdate" id="tgl" required>
                        </div>
                        <div class="form-group">
                            <label for="marriage" class="font-weight-bold">Status Perkawinan</label>
                            <select name="selmrg" class="form-control" data-inp="mrginp" id="marriage" required>
                                <option value="" >-- Pilih Status Perkawinan --</option>
                                <option value="1">Belum Menikah</option>
                                <option value="2">Sudah Menikah</option>
                            </select>
                            <input type="hidden" id="mrginp" name="marriage" />
                        </div>
                        <div class="form-group">
                            <label for="religion" class="font-weight-bold">Agama</label>
                            <select name="selrlg" class="form-control" data-inp="rlginp" id="religion" required>
                                <option value="" >-- Pilih Agama --</option>
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
                            <label for="lastedu" class="font-weight-bold">Pendidikan Terakhir</label>
                            <select name="seledu" class="form-control" data-inp="eduinp" id="lastedu" required>
                                <option value="" >-- Pilih Pendidikan --</option>
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
                            <label for="job" class="font-weight-bold">Pekerjaan</label>
                            <select name="pekerjaan" class="form-control" data-inp="jobinp" id="job" required>
                                <option value="" >-- Pilih Pekerjaan --</option>
                                <?php
                                foreach($dataPekerjaan->result() as $dtp){
                                    ?>
                                    <option value="<?php echo $dtp->id_profesi; ?>"><?php echo $dtp->profesi; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <input type="text" id="desc_pekerjaan" name="desc_pekerjaan" class="form-control"/>
                            <input type="hidden" id="jobinp" name="job" />
                        </div>
                        <div class="form-group">
                            <label for="aktp" class="font-weight-bold">Alamat KTP</label>
                            <input type="text" class="form-control" name="aktp" id="aktp" onkeyup="checkAlamat();" required>
                        </div>
                        <div class="form-group">
                            <label for="country" class="font-weight-bold">Negara</label>
                            <select name="selcnt" class="form-control" data-inp="cntinp" id="country" required>
                                <option value="" >-- Pilih Negara --</option>
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
                                    <label for="provinsi" class="font-weight-bold">Provinsi</label>
                                    <select name="selpro" class="form-control" data-inp="proinp" id="provinsi" onchange="pilihKabKota(this.value,'kabkota')" required >
                                        <option value="" >-- Pilih Provinsi --</option>
                                                                <?php
                                                                foreach($dataProvinsi->result() as $dtprov){
                                                                    ?>
                                                                    <option value="<?php echo $dtprov->id; ?>"><?php echo $dtprov->name; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                    </select>
                                    <input type="hidden" id="proinp" name="provinsi" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="kabkota" class="font-weight-bold">Kabupaten/Kota</label>
                                    <select name="selkk" class="form-control" data-inp="kkinp" id="kabkota" required>
                                        <option value="" >-- Pilih Kabupaten/Kota --</option>
                                        <?php
                                        foreach($dataKabKota->result() as $dtkk){
                                            ?>
                                            <option value="<?php echo $dtkk->id; ?>"><?php echo $dtkk->name; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" id="kkinp" name="kabkota" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hp" class="font-weight-bold">Nomor Handphone</label>
                            <input type="text" class="form-control" name="hp" id="hp" onkeypress="return hanyaAngka(event)" required>
                        </div>
                        <div class="form-group">
                            <label for="noa" class="font-weight-bold">Nomor Alternatif</label>
                            <input type="text" class="form-control" name="noa" id="noa" onkeypress="return hanyaAngka(event)" required>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="samektp" onclick="checkAlamat();" style="width:auto;" >
                            <label class="form-check-label" for="samektp">Alamat domisili saya sama dengan alamat KTP</label>
                        </div>
                        <div class="form-group">
                            <label for="dom" class="font-weight-bold">Alamat Domisili</label>
                            <input type="text" class="form-control" name="dom" id="dom" required>
                        </div>
                        <div class="form-group">
                            <label for="country2" class="font-weight-bold">Negara</label>
                            <select name="selcnt2" class="form-control" data-inp="cnt2inp" id="country2" required >
                                <option value="" >-- Pilih Negara --</option>
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
                                    <label for="provinsi2" class="font-weight-bold">Provinsi</label>
                                    <select name="selp2" class="form-control" data-inp="p2inp" id="provinsi2" onchange="pilihKabKota(this.value,'kabkota2')" required>
                                        <option value="" >-- Pilih Provinsi --</option>
                                        <?php
                                                                foreach($dataProvinsi->result() as $dtprov){
                                                                    ?>
                                                                    <option value="<?php echo $dtprov->id; ?>"><?php echo $dtprov->name; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                    </select>
                                    <input type="hidden" id="p2inp" name="provinsi2" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="kabkota2" class="font-weight-bold">Kabupaten/Kota</label>
                                    <select name="selkk2" class="form-control" data-inp="kk2inp" id="kabkota2" required >
                                        <option value="" >-- Pilih Kabupaten/Kota --</option>
                                        <?php
                                                                foreach($dataKabKota->result() as $dtkk){
                                                                    ?>
                                                                    <option value="<?php echo $dtkk->id; ?>" ><?php echo $dtkk->name; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                    </select>
                                    <input type="hidden" id="kk2inp" name="kabkota2" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="addr" class="font-weight-bold">Alamat Surat Menyurat</label>
                            <input type="text" class="form-control" name="addr" id="addr" required>
                        </div>
                        <div class="form-group">
                            <label>Penghasilan Pertahun</label>
                            <select name="selpeng" class="form-control" data-inp="penghasilan" id="peng" required >
                                <option value="" >-- Pilih Penghasilan --</option>
                                <?php
                                    foreach($dataPenghasilan->result() as $peng){
                                    ?>
                                    <option value="<?php echo $peng->id_penghasilan; ?>" ><?php echo $peng->penghasilan; ?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                            <input type="hidden" id="penghasilan" name="penghasilan" />
                        </div>
                        <span class="d-block text-grey my-3">Apakah anda sudah yakin dengan data diri anda ?</span>
                        <div class="row step step1">
                            <div class="col-6 pr-1">
                                <button type="button" class="btn custom_btn-outline-blue btn-block" onclick="javascript:history.back()">Batal</button>
                            </div>
                            <div class="col-6 pl-1">
                                <button type="button" class="btn custom_btn-blue btn-block" onclick="nextStep(2)" >Lanjut</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <h5 class="font-weight-bold">Akun Bank</h5>
                            <div class="card card-body border-0 shadow">
                                <div class="form-group">
                                    <label for="account" class="font-weight-bold">Nama Pemegang Akun</label>
                                    <input type="text" class="form-control inp2 w-100" name="account" id="account" required>
                                </div>
                                <div class="form-group">
                                    <label for="norek" class="font-weight-bold">Nomor Rekening</label>
                                    <input type="text" class="form-control" name="norek" id="norek" onkeypress="return hanyaAngka(event)" required>
                                </div>
                                <div class="form-group">
                                    <label for="bank" class="font-weight-bold">Bank</label>
                                    <select name="selbank" class="form-control" data-inp="bankinp" id="bank" required>
                                        <option value="" >-- Pilih Bank --</option>
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
                                        <button type="button" class="btn custom_btn-outline-blue btn-block" onclick="nextStep(1)">Batal</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn custom_btn-blue btn-block" onclick="nextStep(3)">Lanjut</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-4 mt-0 mt-lg-4">
                            <h5 class="font-weight-bold">Dokumen Utama</h5>
                            <div class="card card-body border-0 shadow">
                                <!-- <div class="row mb-6">
                                    <div class="col-md-12" style="text-align: center;">
                                        <label>
                                            Spesimen tanda tangan <br>
                                            Silahkan ambil foto tanda tangan anda dikertas dengan latar belakang putih
                                        </label>
                                        <input type="file" class="dropify" name="ttd" id="ttd" accept="application/pdf, image/*">
                                        <label></label>
                                    </div>
                                </div> -->
                                <div class="row mb-3">
                                    <div class="col-md-6" style="text-align: center">
                                        <input type="file" class="dropify" name="ktp" id="ktp" accept="application/pdf, image/*">
                                        <label>KTP/Passport</label>
                                    </div>
                                    <div class="col-md-6" style="text-align: center">
                                        <input type="file" class="dropify" name="buku_tabungan" id="buku_tabungan" accept="application/pdf, image/*">
                                        <label>Buku Tabungan</label>
                                    </div>
                                    <!-- <div class="col-md-6" style="text-align: center">
                                        <input type="file" class="dropify" name="npwp" id="npwp" accept="application/pdf, image/*">
                                        <label>NPWP</label>
                                    </div> -->
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6" style="text-align: center">
                                        <input type="file" class="dropify" name="selfie" id="selfie" accept="application/pdf, image/*">
                                        <label>Foto Selfie</label>
                                    </div>
                                </div>
                                <div class="row step step3">
                                    <div class="col-12">
                                        <div class="form-check" style="font-size: 8pt; margin-bottom: 20px">
                                            <input type="hidden" name="latitude" id="latitude">
                                            <input type="hidden" name="longitude" id="longitude">
                                            <input type="checkbox" name="toc_agreement" style="width:auto;" value="1" onclick="getlocation()" required>
                                            <label class="form-check-label" for="toc_agreement">Saya telah membaca <a href="#" data-toggle="modal" data-target="#tocModal">term & condition</a> dari web ini dan saya telah menyetujuinya.</label>
                                        </div>
                                    </div>
                                    <br>
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
                    <p class="text-center text-grey mt-3">Sudah Punya Akun? <a href="<?= base_url(); ?>invest/login" class="text-blue font-weight-bold">Masuk</a></p>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="tocModal" tabindex="-1" role="dialog" aria-labelledby="tocModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tocModalLabel">Term of Condition</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="font-size: 8pt;">
        <?= $toc ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

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
        $('#desc_pekerjaan').hide();
        $('#job').change(function() {
          if ($(this).val() == '9') {
            $('#desc_pekerjaan').show();
            $('#desc_pekerjaan').focus();
            $('#desc_pekerjaan').attr('required', 'required')
          } else {
            $('#desc_pekerjaan').hide();
            $('#desc_pekerjaan').val('');
            $('#desc_pekerjaan').removeAttr('required');
          }
        })
    });
    function nextStep(nextstep){
        console.log(nextstep-1);
        var check = checkInpVal(nextstep-1);
        if(check){

            if (nextStep == 1) {
              if ($("[name=penghasilan]:checked").length == 0) {
                alert("Pilih Penghasilan");
                return false;
              }
            }

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
                    if (name != account_origin_name || account_name != account_origin_name) {
                        var conf = confirm('Nama tidak sama dengan nama pemilik rekening. Ubah nama menjadi '+ account_origin_name +' ?');
                        if (conf) {
                            $('#nama').val(account_origin_name);
                            $('#account').val(account_origin_name);
                        } else {
                            return false;
                        }
                    }
                } else {
                    alert("Nomor rekening tidak ditemukan");
                    return false;
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
    function pilihKabKota(idprov,idkabkota, kabkotaval = ''){
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
				$("#"+idkabkota).val(kabkotaval);
			}
		});
	}
	function checkAlamat(){
		if($('#samektp').prop('checked')){
			console.log("checked");
			$("#dom").val($("#aktp").val());
      $("#country2 option[value='"+$("#country").val()+"']").attr("selected", true);
      $("[name=country2]").val($("#country").val());
      $("#provinsi2 option[value='"+$("#provinsi").val()+"']").attr("selected", true);
      $("[name=provinsi2]").val($("#provinsi").val());
      pilihKabKota($("#provinsi").val(), 'kabkota2', $("#kabkota").val());
      $("#kabkota2 option[value='"+$("#kabkota").val()+"']").attr("selected", true);
      $("[name=kabkota2]").val($("#kabkota").val());
			$("#dom").prop("readonly",true);
			$("#country2").attr("readonly", true);
			$("#provinsi2").attr("readonly", true);
			$("#kabkota2").attr("readonly", true);
			$("#cnt2inp").attr("readonly", true);
		} else {
			$("#dom").prop("readonly",false);
      $("#country2").attr("readonly",false);
			$("#provinsi2").attr("readonly",false);
			$("#kabkota2").attr("readonly",false);
			$("#cnt2inp").attr("readonly",false);
			console.log("unchecked");
		}
	}

  function getlocation() {
    navigator.geolocation.getCurrentPosition(function(position) {
      let lat = position.coords.latitude;
      let long = position.coords.longitude;

      $('[name=latitude]').val(lat);
      $('[name=longitude]').val(long);
    });
  }
</script>
