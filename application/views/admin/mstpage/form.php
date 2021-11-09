<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Tambah Data Master Page</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>MasterPage/prosesTambah">
      
      <div class="box-body">
		
		<!-- Kategori -->
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Kategori Page</label>

          <div class="col-sm-10">
            <select name="kategori" class="form-control " aria-describedby="sizing-addon2">
              <option disabled selected="">Nama Kategori</option>
              <option value="header">Header</option>
              <option value="sidebar">Sidebar</option>
              <option value="footer">Footer</option>
              <option value="footer2">Footer 2</option>
			  <option value="perhatian">Perhatian</option>
            </select>
          </div>
        </div>
		
		<!-- Sort Number -->
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Urutan</label>
			<div class="col-sm-10">
				<input type="number" class="form-control" placeholder="Urutan" name="sort_number" aria-describedby="sizing-addon2" >
			</div>
		</div>
		
        <!-- Nama Ecommerce -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama Page</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Nama Page" name="nama_page" aria-describedby="sizing-addon2">
          </div>
        </div>
        
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Content</label>
            <div class="col-sm-10">
                  <textarea id="editor1" name="content" rows="10" cols="80" placeholder="Content"></textarea>
            </div>
        </div>

        <!-- Link Page -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Link Page</label>

          <div class="col-sm-10">
            <input type="text" id="validasi" class="form-control" placeholder="Link Page" name="link_page" aria-describedby="sizing-addon2" autocomplete="off">
             <span id="pesan"></span> 
             
          </div>
        </div>
        
        <!-- Meta Word -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Meta Keyword</label>

          <div class="col-sm-10">
            <input type="text" id="validasi" class="form-control" placeholder="Meta Word" name="meta_keyword" aria-describedby="sizing-addon2" autocomplete="off">
            <!-- <span id="pesan"></span> -->
          </div>
        </div>
        
        <!-- Meta Tags -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Meta Tags</label>

          <div class="col-sm-10">
            <input type="text" id="validasi" class="form-control" placeholder="Meta Tags" name="meta_tags" aria-describedby="sizing-addon2" autocomplete="off">
            <!-- <span id="pesan"></span> -->
          </div>
        </div>
        
        <!-- Meta Description -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Meta Description</label>

          <div class="col-sm-10">
            <input type="text" id="validasi" class="form-control" placeholder="Meta Description" name="meta_description" aria-describedby="sizing-addon2" autocomplete="off">
            <!-- <span id="pesan"></span> -->
          </div>
        </div>

        
        <!-- Meta Description -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Icon Page</label>

          <div class="col-sm-10">
            <input type="text" id="validasi" class="form-control" placeholder="Icon Page" name="icon" aria-describedby="sizing-addon2" autocomplete="off">
            <!-- <span id="pesan"></span> -->
          </div>
        </div>
		
		<!-- Status -->
        <div class="form-group">
          <label for="sts" class="col-sm-2 control-label">Status Page</label>

          <div class="col-sm-10">
            <select name="sts" class="form-control">
				<option value="0">Aktif</option>
				<option value="1">Tidak Aktif</option>
			</select>
            <!-- <span id="pesan"></span> -->
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
          <a href="<?php echo base_url() ?>MasterPage" class="form-control btn btn-danger">
            <i class="glyphicon glyphicon-remove"></i> Kembali
          </a>
        </div>
        
        <div class="col-md-3">
          
        </div>

      </div>
    </form>
    
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
  $('#validasi').keyup(function() {
      if (this.value.match(/[^0-9A-Za-z-\/.@:%_.\/+~#=]/g)) {
          this.value = this.value.replace(/[^0-9A-Za-z-\/.@:%_.\/+~#=]/g, '');
      }
      link(this.value);
        // console.log(this.value);
    });
  });
</script>


<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1',{
      // filebrowserUploadUrl: '<?php echo base_url() ?>Quiz/upload?type=Files&CKEditorFuncNum=2',
      // extraPlugins: 'uploadwidget,uploadimage,filebrowser'

      filebrowserImageUploadUrl : '<?php echo base_url(); ?>MasterPage/upload?type=image&path=page'
    })
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>

<script type="text/javascript">

  function link(linkprogram){
    
    $.ajax({
      method: "POST",
      url: "<?php echo base_url('MasterPage/prosesCek'); ?>",
      data: {

        link_page: linkprogram
      } 
      
    })
    
    .done(function(data) {
      $('#pesan').html(data);
      
      if (data == "Link sudah ada yang menggunakan") {
        document.getElementById("pesan").value = "Link sudah ada yang menggunakan";
        document.getElementById("pesan").style.color = "red";
      }else{
        document.getElementById("pesan").value = "Link belum ada yang menggunakan";
        document.getElementById("pesan").style.color = "blue";
      }
    })
    
  }

</script>