<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Edit Data Erups</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Erups/prosesUpdate">
      <input type="hidden" name="id" value="<?php echo $dataErups->id ?>">
      <div class="box-body">
        <!-- Nama Erups -->
        
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Produk/Bisnis</label>

          <div class="col-sm-10">
            <select name="id_produk" class="form-control">
				<option>Pilih Bisnis/Produk</option>
				<?php $data = $this->db->query("select * from trx_produk where status_approve!='refuse' && status_approve!='complete' order by judul asc ");
				foreach($data->result() as $par){
				?>
				<option value="<?php echo $par->id_produk?>" <?php if($dataErups->id_produk==$par->id_produk) echo "selected"; ?>><?php echo $par->judul?></option>
				<?php } ?>
			</select>
			
          </div>
        </div>
		
		
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Judul" name="judul" aria-describedby="sizing-addon2" value="<?php echo $dataErups->judul; ?>" >
          </div>
        </div>
		
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Jam</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="00.00 wib" name="jam" aria-describedby="sizing-addon2" value="<?php echo $dataErups->jam; ?>" >
          </div>
        </div>
		
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">tanggal</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="2020-10-10" name="tanggal" aria-describedby="sizing-addon2" value="<?php echo $dataErups->tanggal; ?>">
          </div>
        </div>
		
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Link</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Link" name="link" aria-describedby="sizing-addon2" value="<?php echo $dataErups->link; ?>">
          </div>
        </div>
		
		
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Status</label>

          <div class="col-sm-10">
            <select name="status" class="form-control">
				<option value="0" <?php if($dataErups->status==0) echo "selected"; ?>>Aktif</option> 
				<option value="1" <?php if($dataErups->status==1) echo "selected"; ?>>Tidak Aktif</option> 
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
          <a href="<?php echo base_url() ?>Erups" class="form-control btn btn-danger">
            <i class="glyphicon glyphicon-remove"></i> Kembali
          </a>
        </div>
        
        <div class="col-md-3">
          
        </div>

      </div>
    </form>
    
  </div>
</div>
