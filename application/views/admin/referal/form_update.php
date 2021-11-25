<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Edit Data Referral</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Referal/prosesUpdate">
      <input type="hidden" name="id_referral" value="<?php echo $dataReferal->id_referral ?>">
      <div class="box-body">
        <!-- Username -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama Pengguna</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Nama Pengguna" aria-describedby="sizing-addon2" value="<?php echo $dataReferal->nama_pengguna ?>" readonly="">
          </div>
        </div>

      </div>

      <div class="box-body">
        <!-- Value -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Kode Referral</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Kode Referraleferral" name="kode_referral" aria-describedby="sizing-addon2" value="<?php echo $dataReferal->kode_referral ?>">
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
          <a href="<?php echo base_url() ?>Referal" class="form-control btn btn-danger">
            <i class="glyphicon glyphicon-remove"></i> Kembali
          </a>
        </div>
        
        <div class="col-md-3">
          
        </div>

      </div>
    </form>
    
  </div>
</div>
