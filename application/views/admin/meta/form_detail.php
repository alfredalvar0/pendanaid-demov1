<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Tambah Tag</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Meta/insert_detail/<?= $id_header ?>">
      
      <div class="box-body">
        <!-- Username -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Meta Name</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Meta Name" name="name" aria-describedby="sizing-addon2" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Content</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Content" name="content" aria-describedby="sizing-addon2" required>
          </div>
        </div>
		
	      <div class="form-group">
	        <div class="col-md-3">
	          
	        </div>

	        <div class="col-md-3">
	            <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button>
	        </div>
	        
	        <div class="col-md-3">
	          <a href="<?php echo base_url() ?>Meta" class="form-control btn btn-danger">
	            <i class="glyphicon glyphicon-remove"></i> Kembali
	          </a>
	        </div>
	        
	        <div class="col-md-3">
	          
	        </div>

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