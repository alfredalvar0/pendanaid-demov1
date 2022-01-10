<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Tambah Article</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>article/store">
      
      <div class="box-body">
        <!-- Username -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Title</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" required name="title" aria-describedby="sizing-addon2">
          </div>
        </div>

      </div>

      <div class="box-body">
        <!-- Username -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Category</label>

          <div class="col-sm-10">
            <select class="form-control" name="id_category" id="id_category" required>
              <option value="">-- Select Category --</option>
              <?php foreach ($category as $cat): ?>
                <option value="<?php echo $cat->id ?>"><?php echo $cat->category ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>

      </div>
	  
	  <div class="box-body">
        <!-- Username -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Content</label>

          <div class="col-sm-10">
            <textarea class="form-control ckeditor" name="content" required></textarea>
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
          <a href="<?php echo base_url() ?>Bank" class="form-control btn btn-danger">
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
  $(document).ready(function () {
    CKEDITOR.config.height = 500;
  })
</script>