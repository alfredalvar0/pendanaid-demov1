<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Tambah Data Produk</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Produk/prosesTambah/<?php echo $_GET['id']?>">
      
      <div class="box-body">
		
        <!-- Site Url -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Site Url</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="ex. judul-produk" name="siteurl" aria-describedby="sizing-addon2" required>
          </div>
        </div>

        <!-- Judul -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="" name="judul" aria-describedby="sizing-addon2" required>
          </div>
        </div>
 
         
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Target Investasi</label>

          <div class="col-sm-10">
            <input type="number" class="form-control"   name="nilai_bisnis" aria-describedby="sizing-addon2" required>
          </div>
        </div>

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Total Lembar Saham</label>

          <div class="col-sm-10">
            <input type="number" class="form-control"   name="lembar_saham" aria-describedby="sizing-addon2" required>
          </div>
        </div>
		
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Harga Perlembar</label> 
          <div class="col-sm-10">
            <input type="number" class="form-control"   name="harga_perlembar" aria-describedby="sizing-addon2" required>
          </div>
        </div>

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Saham yang dishare (%)</label> 
          <div class="col-sm-10">
            <input type="number" class="form-control"   name="saham_dibagi" aria-describedby="sizing-addon2" required>
          </div>
        </div>

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nilai Dividen (%)</label> 
          <div class="col-sm-10">
            <input type="number" class="form-control"   name="finansial_dividen" aria-describedby="sizing-addon2" required>
          </div>
        </div>

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Waktu Pembagian (bulan)</label> 
          <div class="col-sm-10">
            <input type="number" class="form-control"   name="finansial_dividen_waktu" aria-describedby="sizing-addon2" required>
          </div>
        </div>

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Keuntungan pertahun</label> 
          <div class="col-sm-10">
            <input type="text" class="form-control"   name="finansial_rata" aria-describedby="sizing-addon2" required>
          </div>
        </div>

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Waktu balik modal</label> 
          <div class="col-sm-10">
            <input type="text" class="form-control"   name="finansial_balik_modal" aria-describedby="sizing-addon2" required>
          </div>
        </div>
		
		 <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Tentang Bisnis</label>
            <div class="col-sm-10">
                  <textarea id="editor1" name="tentang_bisnis" rows="10" cols="80" placeholder="" required></textarea>
            </div>
        </div>
 
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Lokasi</label>
            <div class="col-sm-10">
                  <textarea id="editor2" name="lokasi" rows="10" cols="80"  required></textarea>
            </div>
        </div>
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Pemilik</label> 
          <div class="col-sm-10">
            <input type="text" class="form-control"   name="pemilik" aria-describedby="sizing-addon2" required>
          </div>
        </div>
		

 

        <!-- Tanggal Awal -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Mulai Kampanye</label>

          <div class="col-sm-10">
            <input type="date" class="form-control" placeholder="Tanggal Awal" name="tglawal" aria-describedby="sizing-addon2" required>
          </div>
        </div>

        <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Akhir Kampanye</label>          
			<div class="col-sm-10">            
				<input type="date" class="form-control" placeholder="Tanggal Akhir" name="tglakhir" aria-describedby="sizing-addon2" required>          
			</div>        
		</div>

 
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Foto</label>

          <div class="col-sm-10">
            <input type="file" class="form-control" placeholder="Foto" name="foto" aria-describedby="sizing-addon2" required>
          </div>
        </div>
		
		 <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Foto 2</label>

          <div class="col-sm-10">
            <input type="file" class="form-control" placeholder="Foto" name="foto2" aria-describedby="sizing-addon2" >
          </div>
        </div>
		
		 <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Foto 3</label>

          <div class="col-sm-10">
            <input type="file" class="form-control" placeholder="Foto" name="foto3" aria-describedby="sizing-addon2">
          </div>
        </div>
		
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Url Video (youtube)</label> 
          <div class="col-sm-10">
            <input type="text" class="form-control"   name="video" aria-describedby="sizing-addon2" >
          </div>
        </div>
		
		<div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Proposal</label>

          <div class="col-sm-10">
            <input type="file" class="form-control" placeholder="proposal" name="proposal" aria-describedby="sizing-addon2" required>
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
          <a href="<?php echo base_url() ?>Produk" class="form-control btn btn-danger">
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

      filebrowserImageUploadUrl : '<?php echo base_url(); ?>Produk/upload?type=image&path=page'
    })

    CKEDITOR.replace('editor2',{
      // filebrowserUploadUrl: '<?php echo base_url() ?>Quiz/upload?type=Files&CKEditorFuncNum=2',
      // extraPlugins: 'uploadwidget,uploadimage,filebrowser'

      filebrowserImageUploadUrl : '<?php echo base_url(); ?>Produk/upload?type=image&path=page'
    })
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>