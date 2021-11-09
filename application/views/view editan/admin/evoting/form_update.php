<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Edit Data Evoting</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Evoting/prosesUpdate">
      <input type="hidden" name="id" value="<?php echo $dataEvoting->id ?>">
      <div class="box-body">
        <!-- Nama Evoting -->
        
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Produk/Bisnis</label>

          <div class="col-sm-10">
            <select name="id_produk" class="form-control">
				<option>Pilih Bisnis/Produk</option>
				<?php $data = $this->db->query("select * from trx_produk where status_approve!='refuse' && status_approve!='complete' order by judul asc ");
				foreach($data->result() as $par){
				?>
				<option value="<?php echo $par->id_produk?>" <?php if($dataEvoting->id_produk==$par->id_produk) echo "selected"; ?>><?php echo $par->judul?></option>
				<?php } ?>
			</select>
			
          </div>
        </div>
		
		
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Judul" name="judul" aria-describedby="sizing-addon2" value="<?php echo $dataEvoting->judul; ?>" >
          </div>
        </div>
		
		 
		 <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Opsi 1</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Optional 1" name="opsi1" aria-describedby="sizing-addon2"  value="<?php echo $dataEvoting->opsi1; ?>">
          </div>
        </div>
		
		 <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Opsi 2</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Optional 2" name="opsi2" aria-describedby="sizing-addon2" value="<?php echo $dataEvoting->opsi2; ?>" >
          </div>
        </div>
		
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Opsi 3</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Optional 3" name="opsi3" aria-describedby="sizing-addon2"  value="<?php echo $dataEvoting->opsi3; ?>">
          </div>
        </div>
		
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Opsi 4</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Optional 4" name="opsi4" aria-describedby="sizing-addon2" value="<?php echo $dataEvoting->opsi4; ?>">
          </div>
        </div>
		
		
		
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Status</label>

          <div class="col-sm-10">
            <select name="status" class="form-control">
				<option value="0" <?php if($dataEvoting->status==0) echo "selected"; ?>>Aktif</option> 
				<option value="1" <?php if($dataEvoting->status==1) echo "selected"; ?>>Tidak Aktif</option> 
			</select>
			
          </div>
        </div>
		
		
      </div>

      <div class="form-group">
        <div class="col-md-3">
          
        </div>

        <div class="col-md-3">
            <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
        </div>
        
        <div class="col-md-3">
          <a href="<?php echo base_url() ?>Evoting" class="form-control btn btn-danger">
            <i class="glyphicon glyphicon-remove"></i> Kembali
          </a>
        </div>
        
        <div class="col-md-3">
          
        </div>

      </div>
    </form>
    
  </div>
</div>
