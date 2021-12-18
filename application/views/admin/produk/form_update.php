<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Tambah Data Produk</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Produk/prosesUpdate/<?php echo $dataProduk->id_bisnis ?>">
      <input type="hidden" name="id_produk" value="<?php echo $dataProduk->id_produk ?>"> 
      <div class="box-body">				
        
		 <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Status Produk/Bisnis</label>

          <div class="col-sm-10">
            <select name="status_approve" class="form-control " aria-describedby="sizing-addon2" required>
              <option disabled selected="">Tipe</option>
              <option value="refuse" <?php echo $dataProduk->status_approve == "refuse"?'selected':'' ?> >Refuse</option>
              <option value="approve" <?php echo $dataProduk->status_approve == "approve"?'selected':'' ?>>Approve</option>
			  <option value="invest" <?php echo $dataProduk->status_approve == "invest"?'selected':'' ?>>Invest</option>
			  <option value="running" <?php echo $dataProduk->status_approve == "running"?'selected':'' ?>>Running</option>
              <option value="pending" <?php echo $dataProduk->status_approve == "pending"?'selected':'' ?>>Pending</option>
            </select>
          </div>
        </div>

        <!-- Site Url -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Site Url</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="ex. judul-produk" value="<?php echo $dataProduk->siteurl ?>" name="siteurl" aria-describedby="sizing-addon2" required>
          </div>
        </div>

        <!-- Judul -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="" value="<?php echo $dataProduk->judul ?>" name="judul" aria-describedby="sizing-addon2" required>
          </div>
        </div>
 
         
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Target Investasi</label>

          <div class="col-sm-10">
            <input type="number" class="form-control" value="<?php echo $dataProduk->nilai_bisnis ?>"  name="nilai_bisnis" aria-describedby="sizing-addon2" required>
          </div>
        </div>

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Total Lembar Saham</label>

          <div class="col-sm-10">
            <input type="number" class="form-control"  value="<?php echo $dataProduk->lembar_saham ?>" name="lembar_saham" aria-describedby="sizing-addon2" required>
          </div>
        </div>
		
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Harga Perlembar</label> 
          <div class="col-sm-10">
            <input type="number" class="form-control" value="<?php echo $dataProduk->harga_perlembar ?>"  name="harga_perlembar" aria-describedby="sizing-addon2" required>
          </div>
        </div>

    <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Minimal Pembelian</label> 
          <div class="col-sm-10">
            <input type="number" class="form-control" value="<?php echo $dataProduk->minimal_beli ?>"  name="minimal_beli" aria-describedby="sizing-addon2" required>
          </div>
        </div>

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Saham yang dishare (%)</label> 
          <div class="col-sm-10">
            <input type="number" class="form-control"  value="<?php echo $dataProduk->saham_dibagi ?>" name="saham_dibagi" aria-describedby="sizing-addon2" required>
          </div>
        </div>

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nilai Dividen (%)</label> 
          <div class="col-sm-10">
            <input type="number" class="form-control" value="<?php echo $dataProduk->finansial_dividen ?>"  name="finansial_dividen" aria-describedby="sizing-addon2" required>
          </div>
        </div>

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Waktu Pembagian (bulan)</label> 
          <div class="col-sm-10">
            <input type="number" class="form-control" value="<?php echo $dataProduk->finansial_dividen_waktu ?>"  name="finansial_dividen_waktu" aria-describedby="sizing-addon2" required>
          </div>
        </div>

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Keuntungan pertahun</label> 
          <div class="col-sm-10">
            <input type="text" class="form-control" value="<?php echo $dataProduk->finansial_rata ?>"  name="finansial_rata" aria-describedby="sizing-addon2" required>
          </div>
        </div>

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Waktu balik modal</label> 
          <div class="col-sm-10">
            <input type="text" class="form-control" value="<?php echo $dataProduk->finansial_balik_modal ?>"  name="finansial_balik_modal" aria-describedby="sizing-addon2" required>
          </div>
        </div>
		
		 <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Tentang Bisnis</label>
            <div class="col-sm-10">
                  <textarea id="editor1" name="tentang_bisnis" rows="10" cols="80" placeholder="" required><?php echo $dataProduk->tentang_bisnis ?></textarea>
            </div>
        </div>
 
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Lokasi</label>
            <div class="col-sm-10">
                  <textarea id="editor2" name="lokasi" rows="10" cols="80" required ><?php echo $dataProduk->lokasi ?></textarea>
            </div>
        </div>
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Pemilik</label> 
          <div class="col-sm-10">
            <input type="text" class="form-control" value="<?php echo $dataProduk->pemilik ?>"  name="pemilik" aria-describedby="sizing-addon2" required>
          </div>
        </div>
		

 

        <!-- Tanggal Awal -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Mulai Kampanye</label>

          <div class="col-sm-10">
            <input type="date" class="form-control" value="<?php echo $dataProduk->tglawal ?>" placeholder="Tanggal Awal" name="tglawal" aria-describedby="sizing-addon2" required>
          </div>
        </div>

        <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Akhir Kampanye</label>          
			<div class="col-sm-10">            
				<input type="date" class="form-control" value="<?php echo $dataProduk->tglakhir ?>" placeholder="Tanggal Akhir" name="tglakhir" aria-describedby="sizing-addon2" required>          
			</div>        
		</div>

 
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Foto</label>

          <div class="col-sm-6">
	 
            <input type="file" class="form-control" placeholder="Foto" name="foto" aria-describedby="sizing-addon2">
          </div>
		   <div class="col-sm-4">
			<?php if($dataProduk->foto!=""){?>
				<a target="_blank" href="<?php echo base_url() ?>assets/img/produk/<?php echo $dataProduk->foto; ?>">
				<img src="<?php echo base_url()."assets/img/produk/".$dataProduk->foto; ?>" style="width:100px; height:70px">
				</a>
		  <?php } ?>
            
          </div>
        </div>
		
		 <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Foto 2</label>

          <div class="col-sm-6">
		 
            <input type="file" class="form-control" placeholder="Foto" name="foto2" aria-describedby="sizing-addon2">
          </div>
		  <div class="col-sm-4">
			<?php if($dataProduk->foto2!=""){?>
				<a target="_blank" href="<?php echo base_url() ?>assets/img/produk/<?php echo $dataProduk->foto2; ?>">
				<img src="<?php echo base_url()."assets/img/produk/".$dataProduk->foto2; ?>" style="width:100px; height:70px">
				</a>
		  <?php } ?>
             
          </div>
        </div>
		
		 <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Foto 3</label>

          <div class="col-sm-6">
 
            <input type="file" class="form-control" placeholder="Foto" name="foto3" aria-describedby="sizing-addon2">
          </div>
		  <div class="col-sm-4">
		  <?php if($dataProduk->foto3!=""){?>
				<a target="_blank" href="<?php echo base_url() ?>assets/img/produk/<?php echo $dataProduk->foto3; ?>">
				<img src="<?php echo base_url()."assets/img/produk/".$dataProduk->foto3; ?>" style="width:100px; height:70px">
				</a>
		  <?php } ?>
           
          </div>
        </div>
		
		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Url Video (youtube)</label> 
          <div class="col-sm-6">
            <input type="text" class="form-control" value="<?php echo $dataProduk->video ?>"  name="video" aria-describedby="sizing-addon2" required>
          </div>
        </div>
		
		<div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Proposal</label>

          <div class="col-sm-6">
            <input type="file" class="form-control" placeholder="proposal" name="proposal" aria-describedby="sizing-addon2">
          </div>
		  <div class="col-sm-4">
		  <?php if($dataProduk->proposal!=""){?><a href="<?php echo base_url() ?>assets/img/produk/proposal/<?php echo $dataProduk->proposal; ?>">Download</a><?php }else{echo "tidak ada";}?>
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