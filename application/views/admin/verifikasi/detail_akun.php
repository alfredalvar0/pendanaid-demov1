<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Detail Data Verifikasi</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal">

      <div class="box-body">

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

        <!-- Tipe -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Tipe</label>

          <div class="col-sm-10">
            <p><?php echo ucwords(strtolower($dataAkun->tipe)) ?></p>

          </div>
        </div>

        <!-- Tipe User -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Tipe User</label>

          <div class="col-sm-10">
            <p><?php echo ucwords(strtolower($dataAkun->tipeuser)) ?></p>

          </div>
        </div>

        <!-- Status User -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Status User</label>

          <div class="col-sm-10">
            <p><?php echo ucwords(strtolower($dataAkun->status)) ?></p>

          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-1">&nbsp;</label>
          <h3 class="col-sm-11">Identitas Pengguna</h3>
        </div>

        <!-- No. KTP -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">No. KTP</label>

          <div class="col-sm-10">
            <p><?php echo $dataAkun->no_ktp ?></p>

          </div>
        </div>

        <!-- Nama -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>

          <div class="col-sm-10">
            <p><?php echo $dataAkun->nama_pengguna ?></p>

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
              <p>Katholik</p>
            <?php }elseif($dataAkun->agama == "4"){ ?>
              <p>Hindu</p>
						<?php }elseif($dataAkun->agama == "5"){ ?>
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
            <?php foreach ($dataPekerjaan->result() as $dtp): ?>
              <?php if ($dtp->id_profesi == $dataAkun->pekerjaan): ?>
                <p>
                  <?php echo $dtp->profesi ?> 
                  <?php if ($dataAkun->desc_pekerjaan != ""): ?>
                    (<?= $dataAkun->desc_pekerjaan ?>)
                  <?php endif; ?>
                </p>
              <?php endif; ?>
            <?php endforeach; ?>
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
            <p><?php echo $dataAkun->alamat_domisili.' '.$dataAkun->provinsi_domisili.' '.$dataAkun->kabkota_dom.' '.$dataAkun->negara_dom ?></p>
          </div>
        </div>

        <!-- ALamat Surat Menyurat -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Alamat Surat Menyurat</label>
          <div class="col-sm-10">
            <p><?php echo $dataAkun->alamat_surat ?></p>
          </div>
        </div>

        <!-- Penghasilan -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Penghasilan</label>
          <div class="col-sm-10">
            <?php foreach ($dataPenghasilan->result() as $dtp): ?>
              <?php if ($dtp->id_penghasilan == $dataAkun->penghasilan): ?>
                <p><?php echo $dtp->penghasilan ?></p>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-1">&nbsp;</label>
          <h3 class="col-sm-11">Akun Bank</h3>
        </div>

        <!-- Nama Pemegang Akun -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemegang Akun</label>
          <div class="col-sm-10">
            <p><?php echo $dataAkun->nama_akun ?></p>
          </div>
        </div>

        <!-- Nomor Rekening -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nomor Rekening</label>
          <div class="col-sm-10">
            <p><?php echo $dataAkun->no_rek ?></p>
          </div>
        </div>

        <!-- Bank -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Bank</label>
          <div class="col-sm-10">
            <p><?php echo $dataAkun->nama_bank ?></p>
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
                  <div class="col-md-4 mt-4" style="margin-top:10px; text-align: center;">
                    <?php if($data_foto->foto_ktp !=""){ echo '<img style="width:100%;border:2px solid grey" src="'.base_url().'assets/img/dokumen/ktp/'.$data_foto->foto_ktp.'"><label>KTP/Passport</label>';}else{?>
                    <div style="width:100%;border:2px solid grey">Belum ada KTP</div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 mt-4" style="margin-top:10px; text-align: center;">
                    <?php if($data_foto->foto_npwp !=""){ echo '<img style="width:100%;border:2px solid grey" src="'.base_url().'assets/img/dokumen/npwp/'.$data_foto->foto_npwp.'"><label>NPWP</label>';}else{?>
                    <div style="width:100%;border:2px solid grey">Belum ada NPWP</div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 mt-4" style="margin-top:10px; text-align: center;">
                    <?php if($data_foto->buku_tabungan !=""){ echo '<img style="width:100%;border:2px solid grey" src="'.base_url().'assets/img/dokumen/buku_tabungan/'.$data_foto->buku_tabungan.'"><label>Buku Tabungan</label>';}else{?>
                    <div style="width:100%;border:2px solid grey">Belum ada Buku Tabungan</div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 mt-4" style="margin-top:10px; text-align: center;">
                    <?php if($data_foto->selfie !=""){ echo '<img style="width:100%;border:2px solid grey" src="'.base_url().'assets/img/dokumen/selfie/'.$data_foto->selfie.'"><label>Foto Selfie</label>';}else{?>
                    <div style="width:100%;border:2px solid grey">Belum ada Foto Selfie</div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 mt-4" style="margin-top:10px; text-align: center;">
                    <?php if($dataAkun->ttd !=""){ echo '<img style="width:100%;border:2px solid grey" src="'.base_url().'assets/img/ttd/'.$dataAkun->ttd.'"><label>Tanda Tangan</label>';}else{?>
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
          <a href="<?php echo base_url() ?>Akun/verifikasi" class="form-control btn btn-danger">
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
