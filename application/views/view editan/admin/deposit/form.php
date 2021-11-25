<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Tambah Data Deposit</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Deposit/prosesTambah">
      
      <div class="box-body">
	  
	  <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">User</label>

          <div class="col-sm-10">
            <select name="id_pengguna" class="form-control">
				<option>Pilih Member</option>
				<?php $data = $this->db->query("select * from tbl_pengguna left join tbl_admin on tbl_admin.id_admin=tbl_pengguna.id_admin order by nama_pengguna asc ");
				foreach($data->result() as $par){
				?>
				<option value="<?php echo $par->id_pengguna?>"><?php echo $par->username; ?> (<?php echo $par->nama_pengguna?>)</option>
				<?php } ?>
			</select>
			
          </div>
        </div>
		
        <!-- Username -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Dana</label>

          <div class="col-sm-10">
            <input type="number" class="form-control" placeholder="0" name="jumlah_dana" aria-describedby="sizing-addon2">
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
          <a href="<?php echo base_url() ?>Deposit" class="form-control btn btn-danger">
            <i class="glyphicon glyphicon-remove"></i> Kembali
          </a>
        </div>
        
        <div class="col-md-3">
          
        </div>

      </div>
    </form>
    
  </div>
</div>
