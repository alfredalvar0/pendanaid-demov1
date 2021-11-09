<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Detail Data Akun</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal">
      
      <div class="box-body">
        
        <!-- Nama -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>

          <div class="col-sm-10">
            <p><?php echo $dataAkun->nama_pengguna ?></p>
            
          </div>
        </div>

        <!-- Username -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Username</label>

          <div class="col-sm-10">
            <p><?php echo $dataAkun->username ?></p>
            
          </div>
        </div>

        <!-- Email -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

          <div class="col-sm-10">
            <p><?php echo $dataAkun->email ?></p>
          </div>
        </div>

        <!-- Jenis Kelamin -->
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Jenis Kelamin</label>

          <div class="col-sm-10">
            <?php if ($dataAkun->jenis_kelamin == "L"){ ?>
              <p>Laki-Laki</p>
            <?php }elseif($dataAkun->jenis_kelamin == "P"){ ?>
              <p>Perempuan</p>
            <?php } ?>
          </div>
        </div>

        <!-- Tempat Lahir -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Tempat Tanggal Lahir</label>

          <div class="col-sm-10">
            <p><?php echo $dataAkun->tempat_lahir.' '.$dataAkun->tgl_lahir ?></p>
          </div>
        </div>

        <!-- Status Kawin -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Status Kawin</label>

          <div class="col-sm-10">
            <?php if ($dataAkun->sts_kawin == "1"){ ?>
              <p>Belum Menikah</p>
            <?php }elseif($dataAkun->sts_kawin == "2"){ ?>
              <p>Menikah</p>
            <?php } ?>
          </div>
        </div>

        <!-- Status Agama -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Agama</label>
          <div class="col-sm-10">
            <?php if ($dataAkun->agama == "1"){ ?>
              <p>Islam</p>
            <?php }elseif($dataAkun->agama == "2"){ ?>
              <p>Kristen</p>
            <?php }elseif($dataAkun->agama == "3"){ ?>
              <p>Hindu</p>
            <?php }elseif($dataAkun->agama == "4"){ ?>
              <p>Budha</p>
            <?php } ?>
          </div>
        </div>

        <!-- Pendidikan Terakhir -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Pendidikan Terakhir</label>
          <div class="col-sm-10">
            <?php if ($dataAkun->pendidikan_terakhir == "1"){ ?>
              <p>SD</p>
            <?php }elseif($dataAkun->pendidikan_terakhir == "2"){ ?>
              <p>SMP</p>
            <?php }elseif($dataAkun->pendidikan_terakhir == "3"){ ?>
              <p>SMA/SMK</p>
            <?php }elseif($dataAkun->pendidikan_terakhir == "4"){ ?>
              <p>D3</p>
            <?php }elseif($dataAkun->pendidikan_terakhir == "5"){ ?>
              <p>S1</p>
            <?php }elseif($dataAkun->pendidikan_terakhir == "6"){ ?>
              <p>S2</p>
            <?php }elseif($dataAkun->pendidikan_terakhir == "7"){ ?>
              <p>S3</p>
            <?php } ?>
          </div>
        </div>

        <!-- Pekerjaan -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Pekerjaan</label>
          <div class="col-sm-10">
            <p><?php echo $dataAkun->pekerjaan ?></p>
          </div>
        </div>

        <!-- ALamat -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Alamat Ktp</label>
          <div class="col-sm-10">
            <p><?php echo $dataAkun->alamat_ktp.' '.$dataAkun->provinsi.' '.$dataAkun->kota.' '.$dataAkun->negara ?></p>
          </div>
        </div>

        <!-- Nomor Hp -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nomor Hp</label>
          <div class="col-sm-10">
            <p><?php echo $dataAkun->no_hp ?></p>
          </div>
        </div>

        <!-- Nomor Alternative Hp -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nomor Alternative Hp</label>
          <div class="col-sm-10">
            <p><?php echo $dataAkun->no_alt ?></p>
          </div>
        </div>
		
		<!-- ALamat Domisili -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Alamat Domisili</label>
          <div class="col-sm-10">
            <p><?php echo $dataAkun->alamat_domisili.' '.$dataAkun->prov_domisili.' '.$dataAkun->kabkota_domisili.' '.$dataAkun->negara_domisili ?></p>
          </div>
        </div>


        <!-- Tipe -->
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Tipe</label>

          <div class="col-sm-10">
            <?php if ($dataAkun->tipe == "investor"){ ?>
              <p>Investor</p>
            <?php }elseif($dataAkun->tipe == "admin"){ ?>
              <p>Admin</p>
            <?php }elseif($dataAkun->tipe == "borrower"){ ?>
              <p>Borrower</p>
            <?php } ?>
          </div>
        </div>

        <!-- Tipe User-->
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Tipe User</label>
          <div class="col-sm-10">
            <?php if ($dataAkun->tipeuser == "perusahaan"){ ?>
              <p>Perusahaan</p>
            <?php }elseif($dataAkun->tipeuser == "perorangan"){ ?>
              <p>Perorangan</p>
            <?php } ?>
            
          </div>
        </div>

        <!-- Status User-->
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Status User</label>
          <div class="col-sm-10">
            <?php if ($dataAkun->status == "aktif"){ ?>
              <p>Aktif</p>
            <?php }elseif($dataAkun->status == "tidak aktif"){ ?>
              <p>Tidak aktif</p>
            <?php } ?>
          </div>
        </div>
        
         <!-- Dokumen User-->
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Dokumen User</label>
          <div class="col-sm-10">
             <div class="row">
                    <div class="col-md-4 mt-4" style="margin-top:10px">
                    <?php if($data_foto->foto_ktp !=""){ echo '<img style="width:100%;border:2px solid grey" src="'.base_url().'assets/img/dokumen/'.$data_foto->foto_ktp.'">';}else{?>
                    <div style="width:100%;border:2px solid grey">Belum ada KTP</div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 mt-4" style="margin-top:10px">
                    <?php if($data_foto->foto_sim !=""){ echo '<img style="width:100%;border:2px solid grey" src="'.base_url().'assets/img/dokumen/'.$data_foto->foto_sim.'">';}else{?>
                    <div style="width:100%;border:2px solid grey">Belum ada SIM</div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 mt-4" style="margin-top:10px">
                    <?php if($data_foto->foto_npwp !=""){ echo '<img style="width:100%;border:2px solid grey" src="'.base_url().'assets/img/dokumen/'.$data_foto->foto_npwp.'">';}else{?>
                    <div style="width:100%;border:2px solid grey">Belum ada NPWP</div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 mt-4" style="margin-top:10px">
                    <?php if($data_foto->foto_bpjs !=""){ echo '<img style="width:100%;border:2px solid grey" src="'.base_url().'assets/img/dokumen/'.$data_foto->foto_bpjs.'">';}else{?>
                    <div style="width:100%;border:2px solid grey">Belum ada BPJS</div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 mt-4" style="margin-top:10px">
                    <?php if($data_foto->foto_slipgaji !=""){ echo '<img style="width:100%;border:2px solid grey" src="'.base_url().'assets/img/dokumen/'.$data_foto->foto_slipgaji.'">';}else{?>
                    <div style="width:100%;border:2px solid grey"> Belum ada Slip Gaji</div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 mt-4" style="margin-top:10px">
                    <?php if($dataAkun->ttd !=""){ echo '<img style="width:100%;border:2px solid grey" src="'.base_url().'assets/img/ttd/'.$dataAkun->ttd.'">';}else{?>
                    <div style="width:100%;border:2px solid grey"> Belum ada TTD</div>
                    <?php } ?>
                  </div>
          </div>
          </div>
          
        </div>
        
        

      </div>

      <div class="form-group">
        <div class="col-md-3">
          
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