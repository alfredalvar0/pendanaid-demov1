<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Tambah Data Akun</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Akun/prosesTambah">
      
      <div class="box-body">
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
            <input type="text" class="form-control" placeholder="Password" name="password" aria-describedby="sizing-addon2" autocomplete="off">
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
              <option value="borrower">Borrower</option>
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