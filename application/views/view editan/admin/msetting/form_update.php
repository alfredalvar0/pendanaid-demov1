<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Edit Data Bank</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Msetting/prosesUpdate">
      <input type="hidden" name="id_setting" value="<?php echo $dataMsetting->id_setting ?>">
      <div class="box-body">
        <!-- Username -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama Modul</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Nama Modul" name="modul" aria-describedby="sizing-addon2" value="<?php echo $dataMsetting->modul ?>" readonly="">
          </div>
        </div>

      </div>

      <div class="box-body">
		<?php
		$valwhatsapp = json_decode($dataMsetting->value);
		if($dataMsetting->modul=="whatsapp"){
			?>
			<!-- Phone -->
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
				<div class="col-sm-10">
				<input type="text" class="form-control" placeholder="Phone" name="phone" aria-describedby="sizing-addon2" value="<?php echo $valwhatsapp->phone; ?>">
				</div>
			</div>
			<!-- Text -->
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Text</label>
				<div class="col-sm-10">
				<input type="text" class="form-control" placeholder="Text" name="text" aria-describedby="sizing-addon2" value="<?php echo $valwhatsapp->text; ?>">
				</div>
			</div>
			<?php
		} else if($dataMsetting->modul=="midtrans") {
			?>
			<!-- Phone -->
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Server Key</label>
				<div class="col-sm-10">
				<input type="text" class="form-control" placeholder="Phone" name="server_key" aria-describedby="sizing-addon2" value="<?php echo $valwhatsapp->server_key; ?>">
				</div>
			</div>
			<!-- Text -->
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Production Status</label>
				<div class="col-sm-10">
					<input type="radio" name="production" value="true" <?php echo $valwhatsapp->production=="true"?"checked":""; ?> /> True
					<input type="radio" name="production" value="false" <?php echo $valwhatsapp->production=="false"?"checked":""; ?> /> False
				</div>
			</div>
			<?php
		} else {
		?>
        <!-- Value -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Value</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Value" name="value" aria-describedby="sizing-addon2" value="<?php echo $dataMsetting->value ?>">
          </div>
        </div>
		<?php
		}
		?>
      </div>

      <div class="form-group">
        <div class="col-md-3">
          
        </div>

        <div class="col-md-3">
            <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
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
