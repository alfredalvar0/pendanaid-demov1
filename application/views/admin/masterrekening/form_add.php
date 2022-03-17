<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Tambah Data Rekening</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>MasterRekening/store">
      
      <div class="box-body">
        <!-- Username -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Bank</label>

            <div class="col-sm-10">
                <select class="form-control" required name="bank_id">
                  <option value="" selected disabled>-- Pilih Bank --</option>
                  <?php foreach ($bank->result() as $k => $v): ?>
                    <option value="<?php echo $v->id_bank ?>"><?php echo $v->nama_bank ?></option>
                  <?php endforeach ?>
                </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">No. Rekening</label>

              <div class="col-sm-10">
                  <input type="text" name="account_no" class="form-control" placeholder="Nomor Rekening" required>
              </div>
            </div>

            <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Atas Nama</label>

              <div class="col-sm-10">
                  <input type="text" name="account_owner" class="form-control" placeholder="Atas Nama" required>
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
          <a href="<?php echo base_url() ?>MasterRekening" class="form-control btn btn-danger">
            <i class="glyphicon glyphicon-remove"></i> Kembali
          </a>
        </div>
        
        <div class="col-md-3">
          
        </div>

      </div>
    </form>
    
  </div>
</div>
