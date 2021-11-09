<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Edit Data Kategori</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Kategori/prosesUpdate">
      <input type="hidden" name="id_kategori" value="<?php echo $dataKategori->id_kategori ?>">
      <div class="box-body">
        <!-- Nama Kategori -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama Kategori</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Nama Kategori" name="kategori" aria-describedby="sizing-addon2" value="<?php echo $dataKategori->kategori ?>">
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
          <a href="<?php echo base_url() ?>Kategori" class="form-control btn btn-danger">
            <i class="glyphicon glyphicon-remove"></i> Kembali
          </a>
        </div>
        
        <div class="col-md-3">
          
        </div>

      </div>
    </form>
    
  </div>
</div>
