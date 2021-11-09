<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Edit Data Dana</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Dana/prosesUpdate">
      <input type="hidden" name="id_dana" value="<?php echo $dataDana->id_dana ?>">
      <input type="hidden" name="id_pengguna" value="<?php echo $dataDana->id_pengguna ?>">
	  <input type="hidden" name="nominal" value="<?php echo $dataDana->jumlah_dana ?>">
      <div class="box-body">
        <!-- Status Approve -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Status Approve</label>

          <div class="col-sm-10">
            <select name="status_approve" class="form-control " aria-describedby="sizing-addon2">
              <option disabled selected="">Tipe</option>
              <option value="refuse" <?php echo $dataDana->status_approve == "refuse"?'selected':'' ?> >Refuse</option>
              <option value="approve" <?php echo $dataDana->status_approve == "approve"?'selected':'' ?>>Approve</option>
              <option value="pending" <?php echo $dataDana->status_approve == "pending"?'selected':'' ?>>Pending</option>
            </select>
          </div>
        </div>

        <!-- Pesan-->
        <!-- <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Pesan</label>
          <div class="col-sm-10">
            <input type="text" name="pesan" class="form-control">
          </div>
        </div> -->

      </div>

      <div class="form-group">
        <div class="col-md-3">
          
        </div>

        <div class="col-md-3">
            <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
        </div>
        
        <div class="col-md-3">
          <a href="<?php echo base_url() ?>Dana" class="form-control btn btn-danger">
            <i class="glyphicon glyphicon-remove"></i> Kembali
          </a>
        </div>
        
        <div class="col-md-3">
          
        </div>

      </div>
    </form>
    
  </div>
</div>
