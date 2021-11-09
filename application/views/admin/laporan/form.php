<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Download Data Akun</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Akun/prosesLaporanAkun">
      
      <div class="box-body">
		
		<!-- Data Pengguna -->
		
		<div class="form-group">
			<label class="col-sm-4">&nbsp;</label>
			<h3 class="col-sm-11">Filter data</h3>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="nama">Username</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="name" id="nama" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="nama">Email</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="name" id="nama" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="nama">Nama</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="name" id="nama" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="nama">No. KTP</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="name" id="nama" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="nama">No. HP</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="name" id="nama" required>
			</div>
		</div>
		
	
		<!-- End Data Pengguna -->
		
		
		
      </div>


		
      <div class="form-group">
        <div class="col-md-3">
          
        </div>

        <div class="col-md-3">
            <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-floppy-disk"></i> Download data</button>
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
