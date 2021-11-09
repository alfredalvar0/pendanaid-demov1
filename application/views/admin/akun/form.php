<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Tambah Data Akun</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Akun/prosesTambah">
      
      <div class="box-body">
		<div class="form-group">
			<label class="col-sm-1">&nbsp;</label>
			<h3 class="col-sm-11">Data Akun</h3>
		</div>
        <!-- Username -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Username</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Username" name="username" aria-describedby="sizing-addon2">
          </div>
        </div>

        <!-- Email -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

          <div class="col-sm-10">
            <input type="text" id="validasi" class="form-control" placeholder="Email" name="email" aria-describedby="sizing-addon2" autocomplete="off">
            <span id="pesan"></span>
          </div>
        </div>

        <!-- Password -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Password</label>

          <div class="col-sm-10">
            <input type="password" class="form-control" placeholder="Password" name="password" aria-describedby="sizing-addon2" autocomplete="off">
          </div>
        </div>

        <!-- Tipe -->
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Tipe</label>

          <div class="col-sm-10">
            <select name="tipe" class="form-control " aria-describedby="sizing-addon2">
              <option disabled selected="">Tipe</option>
              <option value="investor">Investor</option>
              <option value="admin">Admin</option> 
            </select>
          </div>
        </div>

        <!-- Tipe User-->
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Tipe User</label>
          <div class="col-sm-10">
            <select name="tipeuser" class="form-control " aria-describedby="sizing-addon2">
              <option disabled selected="">Tipe User</option>
              <option value="perusahaan">Perusahaan</option>
              <option value="perorangan">Perorangan</option>
            </select>
          </div>
        </div>
		
		<!-- Data Pengguna -->
		
		<div class="form-group">
			<label class="col-sm-1">&nbsp;</label>
			<h3 class="col-sm-11">Identitas Pengguna</h3>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="nama">Nama</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="name" id="nama" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="jk">Jenis Kelamin</label>
			<div class="col-sm-10">
				<select name="seljk" class="form-control" id="jk" data-inp="jkinp" required>
					<option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
					<option value="L">Laki-laki</option>
					<option value="P">Perempuan</option>
				</select>
				<input type="hidden" id="jkinp" name="jk" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="tempat">Tempat Lahir</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="birthplace" id="tempat" >
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="tgl">Tanggal Lahir</label>
			<div class="col-sm-10">
				<input type="date" class="form-control" name="birthdate" id="tgl" >
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="marriage">Status Perkawinan</label>
			<div class="col-sm-10">
				<select name="selmrg" class="form-control" data-inp="mrginp" id="marriage" >
					<option value="" selected disabled>-- Pilih Status Perkawinan --</option>
					<option value="1">Belum Menikah</option>
					<option value="2">Sudah Menikah</option>
				</select>
				<input type="hidden" id="mrginp" name="marriage" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="religion">Agama</label>
			<div class="col-sm-10">
				<select name="selrlg" class="form-control" data-inp="rlginp" id="religion" >
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
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="lastedu">Pendidikan Terakhir</label>
			<div class="col-sm-10">
				<select name="seledu" class="form-control" data-inp="eduinp" id="lastedu" >
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
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="job">Pekerjaan</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="job" id="job" >
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="aktp">Alamat KTP</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="aktp" id="aktp" onkeyup="checkAlamat();" >
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="country">Negara</label>
			<div class="col-sm-10">
				<select name="selcnt" class="form-control" data-inp="cntinp" id="country" >
					<option value="" selected disabled>-- Pilih Negara --</option>
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
		</div>
		
			
		<div class="form-group">
			<label for="provinsi" class="col-sm-2 control-label">Provinsi</label>
			<div class="col-sm-10">
				<select name="selpro" class="form-control" data-inp="proinp" id="provinsi" onchange="pilihKabKota(this.value,'kabkota')"  >
					<option value="" selected disabled>-- Pilih Provinsi --</option>
					<?php
					foreach($dataProvinsi->result() as $dtprov){
						?>
						<option value="<?php echo $dtprov->id; ?>" ><?php echo $dtprov->name; ?></option>
						<?php
					}
					?>
				</select>
				<input type="hidden" id="proinp" name="provinsi" />
			</div>
		</div>
			
			
		<div class="form-group">
			<label for="kabkota" class="col-sm-2 control-label">Kabupaten/Kota</label>
			<div class="col-sm-10">
				<select name="selkk" class="form-control" data-inp="kkinp" id="kabkota" >
					<option value="" selected disabled>-- Pilih Kabupaten/Kota --</option>
					<?php
					foreach($dataKabupaten->result() as $dtkk){
						?>
						<option value="<?php echo $dtkk->id; ?>" ><?php echo $dtkk->name; ?></option>
						<?php
					}
					?>
				</select>
				<input type="hidden" id="kkinp" name="kabkota" />
			</div>
		</div>
			
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="hp">Nomor Handphone</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="hp" id="hp" onkeypress="return hanyaAngka(event)" >
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="noa">Nomor Alternatif</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="noa" id="noa" onkeypress="return hanyaAngka(event)" >
			</div>
		</div>
		 
			
		<div class="form-group">
			<label class="col-sm-1">&nbsp;</label>
			<h3 class="col-sm-11">Akun Bank</h3>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="account">Nama Pemegang Akun</label>
			<div class="col-sm-10">
				<input type="text" class="form-control inp2" name="account" id="account" >
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="norek">Nomor Rekening</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="norek" id="norek" onkeypress="return hanyaAngka(event)" >
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="bank">Bank</label>
			<div class="col-sm-10">
				<select name="selbank" class="form-control" data-inp="bankinp" id="bank" >
					<option value="" selected disabled>-- Pilih Bank --</option>
					<?php
					foreach($dataBank->result() as $dtbank){
						?>
						<option value="<?php echo $dtbank->id_bank; ?>" ><?php echo $dtbank->nama_bank; ?></option>
						<?php
					}
					?>
				</select>
				<input type="hidden" id="bankinp" name="bank" />
			</div>
		</div>
		
	
		
		
		<!-- End Data Pengguna -->
		
		
		
      </div>


		
	  <hr>
	   <!-- Akses modul -->
	  <div class="form-group"> 
		  <h3 class="col-sm-12 text-center">Akses Modul</h3>
	  </div>
 
	  <div class="box-body table-responsive">
		  <table id="list-data" class="table table-hover  dataTable table-custom table-striped table-bordered nowrap dataTable dtr-inline">
			<thead>
			  <tr> 
				<th>No</th>
			    <th>Tipe</th>
				<th>Modul</th>
				<th>Akses</th> 
			  </tr>
			</thead>
			<tbody>
				<?php 
					//select * from tbl_modul modul
				    //left join tbl_user_akses akses on akses.id_modul=modul.id
				    //where modul.submodul=0 and akses.id_user=".$this->session->userdata('id_admins')."
				    //order by urutan asc
				 
					$idx=1;							 
					$result = $this->db->query("select * from tbl_modul modul 
												  where modul.submodul=0  
												  order by urutan asc
												 ");
					foreach($result->result() as $val){			

						 
						$noakses = "";
						$akses = "checked";
						 
					?>
					<tr>
						<td><?php echo $idx++;?></td>
						<td>Menu Utama</td>
						<td><?php echo $val->modul?></td>
						<td>
							<input type="radio" value="1" name="akses<?php echo $val->id?>" <?php echo $akses?>> Akses &nbsp;&nbsp;&nbsp;
							<input type="radio" value="0" name="akses<?php echo $val->id?>" <?php echo $noakses?>> Tanpa Akses
						</td>
					</tr>
					<?php $result_sub = $this->db->query("select * from tbl_modul modul 
												  where modul.submodul=".$val->id."  
												  order by urutan asc
												 ");
					foreach($result_sub->result() as $val_sub){		
						$noakses = "";
						$akses = "checked";
					?>
						<tr>
							<td><?php echo $idx++;?></td>
							<td>&nbsp;&rarr;&nbsp;Sub Menu</td>
							<td><?php echo $val_sub->modul?></td>
							<td>
								<input type="radio" value="1" name="akses<?php echo $val_sub->id?>" <?php echo $akses?>> Akses &nbsp;&nbsp;&nbsp;
								<input type="radio" value="0" name="akses<?php echo $val_sub->id?>" <?php echo $noakses?>> Tanpa Akses
							</td>
						</tr>
					<?php } ?>
					
					<?php } ?>
			</tbody>
		  </table>
		</div>
		
      <div class="form-group">
        <div class="col-md-3">
          
        </div>

        <div class="col-md-3">
            <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button>
        </div>
        
        <div class="col-md-3">
          <a href="<?php echo base_url() ?>Akun" class="form-control btn btn-danger">
            <i class="glyphicon glyphicon-remove"></i> Kembali
          </a>
        </div>
        
        <div class="col-md-3">
          
        </div>

      </div>
    </form>
    
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
  $('#validasi').keyup(function() {
      if (this.value.match(/[^0-9A-Za-z-\/.@:%_.\/+~#=]/g)) {
          this.value = this.value.replace(/[^0-9A-Za-z-\/.@:%_.\/+~#=]/g, '');
      }
        link(this.value);
        // console.log(this.value);
        
    });
  });
</script>

<script type="text/javascript">

  function link(email){
    
    $.ajax({
      method: "POST",
      url: "<?php echo base_url('Akun/prosesEmail'); ?>",
      data: {

        email: email
      } 
      
    })
    
    .done(function(data) {
      $('#pesan').html(data);
      
      if (data == "Email sudah ada yang menggunakan") {
        document.getElementById("pesan").value = "Email sudah ada yang menggunakan";
        document.getElementById("pesan").style.color = "red";
      }else{
        document.getElementById("pesan").value = "Email belum ada yang menggunakan";
        document.getElementById("pesan").style.color = "blue";
      }
    })
    
  }

</script>

<script type="text/javascript">
	function pilihKabKota(idprov,idkabkota){
		$.ajax({
			url: "<?php echo base_url(); ?>akun/pilihKabKota", 
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