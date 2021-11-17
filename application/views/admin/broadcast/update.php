<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Update Term of Condition</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>toc/proses_update/<?= $toc->id ?>">
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">Judul ToC</label>
          <div class="col-sm-10">
            <input type="text" name="title" class="form-control" required value="<?= $toc->title ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Tanggal Mulai Berlaku</label>
          <div class="col-sm-10">
            <input type="date" name="mulai_berlaku" class="form-control" required value="<?= date('Y-m-d', strtotime($toc->mulai_berlaku)) ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Term of Condition</label>
          <div class="col-sm-10">
            <textarea name="toc" class="form-control" required><?= $toc->toc ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Status</label>
          <div class="col-sm-10">
            <select name="is_aktif" class="form-control" required>
              <option value="1" <?php $toc->is_aktif == 1 ? "selected" : "" ?>>Active</option>
              <option value="0" <?php $toc->is_aktif == 0 ? "selected" : "" ?>>Inactive</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-10"></div>
          <div class="col-sm-2" style="text-align: right">
            <button class="btn btn-primary" type="submit">Update</button>
            <button class="btn btn-danger" type="submit">Cancel</button>
          </div>
        </div>
      </div>
    </form>

  </div>
</div>
<script>
  $(document).ready(function () {
    var ckeditor = CKEDITOR.replace('toc', {
      height: '500px'
    });
  })
</script>
