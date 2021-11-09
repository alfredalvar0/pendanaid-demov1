<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Edit Data Bank</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Bank/prosesUpdate">
      <input type="hidden" name="id_bank" value="<?php echo $dataBank->id_bank ?>">
      <div class="box-body">
        <!-- Nama Bank -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama Bank</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Nama Bank" name="nama_bank" aria-describedby="sizing-addon2" value="<?php echo $dataBank->nama_bank ?>">
          </div>
        </div>
      </div>
	  
	  <div class="box-body">
        <!-- Username -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">No Rekening</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="No Rekening" name="no_rek" aria-describedby="sizing-addon2" value="<?php echo $dataBank->no_rek ?>">
          </div>
        </div>

      </div>
	  
	  <div class="box-body">
        <!-- Username -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Atas Nama</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Nama Pemilik" name="atas_nama" aria-describedby="sizing-addon2" value="<?php echo $dataBank->atas_nama ?>">
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
          <a href="<?php echo base_url() ?>Bank" class="form-control btn btn-danger">
            <i class="glyphicon glyphicon-remove"></i> Kembali
          </a>
        </div>
        
        <div class="col-md-3">
          
        </div>

      </div>
    </form>
    
  </div>
</div>
