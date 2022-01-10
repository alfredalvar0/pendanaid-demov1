<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Edit Article</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>article/update/<?= $article->id ?>">
      
      <div class="box-body">
        <!-- Username -->
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Title</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" required name="title" aria-describedby="sizing-addon2" value="<?= $article->title ?>">
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
                <?php if ($cat->id == $article->id_category): ?>
                  <option value="<?php echo $cat->id ?>" selected><?php echo $cat->category ?></option>
                <?php else: ?>
                  <option value="<?php echo $cat->id ?>"><?php echo $cat->category ?></option>
                <?php endif ?>                
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
            <textarea class="form-control ckeditor" name="content" required><?= $article->title ?></textarea>
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