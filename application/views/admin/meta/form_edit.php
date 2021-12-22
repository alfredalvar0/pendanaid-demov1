<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Edit Page</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Meta/update/<?= $data['id'] ?>">
      
      <div class="box-body">
        <!-- Username -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Edit Page URL</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Page URL" name="page_uri" value="<?= $data['page_uri'] ?>" aria-describedby="sizing-addon2" required>
          </div>
        </div>
		
	      <div class="form-group">
	        <div class="col-md-3">
	          
	        </div>

	        <div class="col-md-3">
	            <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
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