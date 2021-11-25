<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Tambah Data Master Setting</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Msetting/prosesTambah">
      
      <div class="box-body">
        <!-- Username -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama Modul</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Nama Modul" name="modul" aria-describedby="sizing-addon2">
          </div>
        </div>

      </div>

      <div class="box-body">
        <!-- Value -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Value</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Value" name="value" aria-describedby="sizing-addon2">
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
          <a href="<?php echo base_url() ?>Msetting" class="form-control btn btn-danger">
            <i class="glyphicon glyphicon-remove"></i> Kembali
          </a>
        </div>
        
        <div class="col-md-3">
          
        </div>

      </div>
    </form>
    
  </div>
</div>
