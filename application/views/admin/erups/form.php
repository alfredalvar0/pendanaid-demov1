<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Buat E-Rups</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Erups/prosesTambah">
      
      <div class="box-body">
        
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Produk/Bisnis</label>

          <div class="col-sm-10">
            <select name="id_produk" class="form-control">
				<option>Pilih Bisnis/Produk</option>
				<?php $data = $this->db->query("select * from trx_produk where status_approve!='refuse' && status_approve!='complete' order by judul asc ");
				foreach($data->result() as $par){
				?>
				<option value="<?php echo $par->id_produk?>"><?php echo $par->judul?></option>
				<?php } ?>
			</select>
			
          </div>
        </div>
		
		
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Judul" name="judul" aria-describedby="sizing-addon2"  >
          </div>
        </div>
		
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Jam</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="00.00 wib" name="jam" aria-describedby="sizing-addon2"  >
          </div>
        </div>
		
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">tanggal</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="2020-10-10" name="tanggal" aria-describedby="sizing-addon2">
          </div>
        </div>
		
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Link</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Link" name="link" aria-describedby="sizing-addon2">
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
