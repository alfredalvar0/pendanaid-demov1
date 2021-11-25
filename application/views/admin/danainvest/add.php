<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Add Data Dana di dalam <?php echo $user[0]['email']; ?> dompet</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>DanaInvest/prosesAdd">
      <input type="hidden" name="email" value="<?php echo $user[0]['email'] ?>">
      <input type="hidden" name="username" value="<?php echo $user[0]['username'] ?>">
      <input type="hidden" name="id" value="<?php echo $id ?>">
      <div class="box-body">
        <!-- Status Approve -->
        <!-- Pesan-->
        <div class="form-group">
          <label for="amount" class="col-sm-2 control-label">Dana</label>
          <div class="col-sm-10">
            <input type="number" name="amount" class="form-control" required>
          </div>
        </div>
        <div class="form-group">
          <label for="amount" class="col-sm-2 control-label">Add Note</label>
          <div class="col-sm-10">
            <textarea class="form-control" required name="note"></textarea>
          </div>
        </div>

      </div>

      <div class="form-group">
        <div class="col-md-3">
          
        </div>

        <div class="col-md-3">
            <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Add</button>
        </div>
        
        <div class="col-md-3">
          <a href="<?php echo base_url() ?>Dana/menambahkan" class="form-control btn btn-danger">
            <i class="glyphicon glyphicon-remove"></i> Kembali
          </a>
        </div>
        
        <div class="col-md-3">
          
        </div>

      </div>
    </form>
    
  </div>
</div>
