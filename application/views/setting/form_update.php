<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Setting Data</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Setting/prosesUpdate">
      <input type="hidden" name="id_admin" value="<?php echo $dataSetting->id_admin ?>">
      <div class="box-body">
        <!-- Username -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Username</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Username" name="username" aria-describedby="sizing-addon2" value="<?php echo $dataSetting->username ?>">
          </div>
        </div>

        <!-- Password -->
        <!-- <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Password</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Password" name="password" aria-describedby="sizing-addon2" value="<?php echo $dataSetting->password ?>">
          </div>
        </div> -->

        <!-- Nama -->
        <!-- <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Nama" name="nama" aria-describedby="sizing-addon2" value="<?php echo $dataSetting->nama ?>">
          </div>
        </div> -->

        <!-- Email -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Email" name="email" aria-describedby="sizing-addon2" value="<?php echo $dataSetting->email ?>">
          </div>
        </div>
        

        <!-- Foto -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Foto</label>

          <div class="col-sm-10">
            <input type="file" class="form-control" placeholder="Foto" name="foto" aria-describedby="sizing-addon2" value="<?php echo $dataSetting->foto ?>">
          </div>
        </div>

        <!-- Alamat -->
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
          <div class="col-sm-10">
              <textarea name="alamat" class="form-control" rows="10" cols="180" placeholder="Pesan"><?php echo $dataSetting->alamat ?></textarea>
          </div>
        </div>

        <!-- Domisili -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Domisili</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Domisili" name="domisili" aria-describedby="sizing-addon2" value="<?php echo $dataSetting->domisili ?>">
          </div>
        </div>

        <!-- Kota -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Kota</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Kota" name="kota" aria-describedby="sizing-addon2" value="<?php echo $dataSetting->kota ?>">
          </div>
        </div>

        <!-- Kodepos -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Kodepos</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Kodepos" name="kodepos" aria-describedby="sizing-addon2" value="<?php echo $dataSetting->kodepos ?>">
          </div>
        </div>

        <!-- Telephone -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Telephone</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Telephone" name="telephone" aria-describedby="sizing-addon2" value="<?php echo $dataSetting->telephone ?>">
          </div>
        </div>

        <!-- Handphone -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Handphone</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Handphone" name="handphone" aria-describedby="sizing-addon2" value="<?php echo $dataSetting->handphone ?>">
          </div>
        </div>

        <!-- Pekerjaan -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Pekerjaan</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Pekerjaan" name="pekerjaan" aria-describedby="sizing-addon2" value="<?php echo $dataSetting->pekerjaan ?>">
          </div>
        </div>

        <!-- Status -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Status</label>

          <div class="col-sm-10">
            <select name="status" class="form-control select2"  aria-describedby="sizing-addon2">
            <?php
              $status = array('lajang','menikah');
              foreach ($status as $user) {
                $s = $user == $dataSetting->status?'selected':'';
                ?>
                <option <?php echo $s; ?> value="<?php echo $user; ?>"><?php echo $user; ?></option>
                <?php
              }
            ?>
          </select>
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
          <a href="<?php echo base_url() ?>Home/home" class="form-control btn btn-danger">
            <i class="glyphicon glyphicon-remove"></i> Kembali
          </a>
        </div>

        <div class="col-md-3">
          
        </div>
    
      </div>
    </form>
    
  </div>
</div>

<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>