<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Ubah Komisi Referral</h3>
    <form method="POST" class="form-horizontal" action="<?php echo base_url(); ?>Komisireferral/prosesUpdate">
      <input type="hidden" name="id" value="<?php echo $dataReferral->id; ?>"> 
      <div class="box-body">				

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Produk</label>

          <div class="col-sm-6">
            <input type="text" class="form-control" value="<?= $dataReferral->judul ?>" name="produk" disabled="disabled">
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">% Komisi <i class="text-danger">*</i></label>

          <div class="col-sm-6">
            <input type="text" class="form-control" value="<?= $dataReferral->persen_komisi ?>" name="persen_komisi" aria-describedby="sizing-addon2" required>
          </div>
        </div>

      </div>


      <div class="col-md-3"></div>

      <div class="col-md-3">
        <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>

      <div class="col-md-3">
        <a href="<?php echo base_url() ?>Komisireferral" class="form-control btn btn-danger">
          <i class="glyphicon glyphicon-remove"></i> Kembali
        </a>
      </div>
      </div>
    </form>
  </div>
</div>