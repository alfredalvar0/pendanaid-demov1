<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Detail Broadcast Message</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>broadcast/send_broadcast">
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">Type Broadcast</label>
          <div class="col-sm-10">
            <input type="text" name="broadcast_type" disabled="" class="form-control" value="<?= ucwords(strtolower($dataBroadcast->broadcast_type)) ?>">
          </div>
        </div>
        <div class="form-group" id="form_bisnis">
          <label class="col-sm-2 control-label">Nama Bisnis</label>
          <div class="col-sm-10">
            <?php foreach ($dataBisnis->result() as $bisnis): ?>
              <?php if ($bisnis->id_bisnis == $dataBroadcast->id_bisnis): ?>
                <input type="text" name="id_bisnis" disabled="" class="form-control" value="<?= $dataBroadcast->nama_bisnis ?>">
              <?php endif ?>
            <?php endforeach ?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Subject</label>
          <div class="col-sm-10">
            <input type="text" name="subject" id="subject" class="form-control" disabled="" value="<?php echo $dataBroadcast->subject ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Content</label>
          <div class="col-sm-10">
            <textarea name="content" id="content" class="form-control" disabled="" value="<?php echo $dataBroadcast->content ?>"></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Sent Time</label>
          <div class="col-sm-10">
            <input type="text" name="sent_time" id="sent_time" class="form-control" disabled="" value="<?php echo date('d-m-Y H:i:s', strtotime($dataBroadcast->sent_time)) ?>">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-9"></div>
          <div class="col-sm-3" style="text-align: right">
            <a href="<?= base_url() ?>broadcast" class="btn btn-danger">Back</a>
          </div>
        </div>
      </div>
    </form>

  </div>
</div>
<script>
  $(document).ready(function () {
    var ckeditor = CKEDITOR.replace('content', {
      height: '600px'
    });

    $('#form_bisnis').hide();

    if ('<?= $dataBroadcast->broadcast_type ?>' == 'Investor Bisnis') {
      $('#form_bisnis').show();
    } else {
      $('#form_bisnis').hide();
    }
  })
</script>
