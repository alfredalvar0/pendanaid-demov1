<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Tambah Data Bisnis</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Bisnis/prosesUpdate">
      <input type="hidden" name="id_bisnis" value="<?php echo $dataBisnis->id_bisnis ?>">
      <input type="hidden" name="userid" value="<?php echo $dataBisnis->userid ?>">
      <div class="box-body">				
        
        

         <!-- Foto -->
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Logo</label>

          <div class="col-sm-10">
            <input type="file" class="form-control"   name="foto" aria-describedby="sizing-addon2">
          </div>
        </div>

 
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama bisnis</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="<?php echo $dataBisnis->nama_binsis ?>" name="nama_binsis" aria-describedby="sizing-addon2">
          </div>
        </div>

        
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Rata-rata nilai bisnis</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="" value="<?php echo $dataBisnis->finansial_rata ?>" name="finansial_rata" aria-describedby="sizing-addon2">
          </div>
        </div>


        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Rata-rata dividen yield (%)</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="" value="<?php echo $dataBisnis->finansial_dividen ?>" name="finansial_dividen" aria-describedby="sizing-addon2">
          </div>
        </div>
		
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Jangka waktu pembagian</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="" value="<?php echo $dataBisnis->finansial_dividen_waktu ?>" name="finansial_dividen_waktu" aria-describedby="sizing-addon2">
          </div>
        </div>
		
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Waktu balik modal</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="" value="<?php echo $dataBisnis->finansial_balik_modal ?>" name="finansial_balik_modal" aria-describedby="sizing-addon2">
          </div>
        </div>
		
		 <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Tentang bisnis</label>
            <div class="col-sm-10">
                  <textarea id="editor1" name="tentang_bisnis" rows="10" cols="80"  ><?php echo $dataBisnis->tentang_bisnis ?></textarea>
            </div>
        </div>
		
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Kategori bisnis</label>

          <div class="col-sm-10">
            <select name="id_kategori" class="form-control " aria-describedby="sizing-addon2">
              <option disabled selected="">Pilih Kategori Bisnis</option> 
			  <?php $data = $this->db->query("select * from tbl_kategori");
			  foreach($data->result() as $par){
			  ?>
			  <option  value="<?php echo $par->id_kategori?>" <?php if($dataBisnis->id_kategori ==$par->id_kategori) echo "selected";  ?>><?php echo $par->kategori?></option> 
			  <?php } ?>
            </select>
          </div>
        </div>
		
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama pemilik bisnis</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="" value="<?php echo $dataBisnis->pemilik ?>" name="pemilik" aria-describedby="sizing-addon2">
          </div>
        </div>
		
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Tahun berdiri</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" placeholder="" value="<?php echo $dataBisnis->tahun_berdiri ?>" name="tahun_berdiri" aria-describedby="sizing-addon2">
          </div>
        </div>
		
		
		<div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Lokasi</label>
            <div class="col-sm-10">
                  <textarea id="editor2" name="lokasi" rows="10" cols="80"  ><?php echo $dataBisnis->lokasi ?></textarea>
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
          <a href="<?php echo base_url() ?>Bisnis" class="form-control btn btn-danger">
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
    CKEDITOR.replace('editor1',{
      // filebrowserUploadUrl: '<?php echo base_url() ?>Quiz/upload?type=Files&CKEditorFuncNum=2',
      // extraPlugins: 'uploadwidget,uploadimage,filebrowser'

      filebrowserImageUploadUrl : '<?php echo base_url(); ?>Bisnis/upload?type=image&path=page'
    })

    CKEDITOR.replace('editor2',{
      // filebrowserUploadUrl: '<?php echo base_url() ?>Quiz/upload?type=Files&CKEditorFuncNum=2',
      // extraPlugins: 'uploadwidget,uploadimage,filebrowser'

      filebrowserImageUploadUrl : '<?php echo base_url(); ?>Bisnis/upload?type=image&path=page'
    })
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>