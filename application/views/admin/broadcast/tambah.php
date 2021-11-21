<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Create Broadcast Message</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>broadcast/send_broadcast">
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">Type Broadcast</label>
          <div class="col-sm-10">
            <select type="text" name="broadcast_type" id="broadcast_type" class="form-control" required>
              <option value="">-- Select Broadcast Type --</option>
              <option value="All User">All User</option>
              <option value="All Investor">All Investor</option>
              <option value="Investor Bisnis">Investor Bisnis</option>
              <option value="Investor Produk Bisnis">Investor Produk Bisnis</option>
            </select>
          </div>
        </div>
        <div class="form-group" id="form_bisnis">
          <label class="col-sm-2 control-label">Nama Bisnis</label>
          <div class="col-sm-10">
            <select type="text" name="id_bisnis" id="id_bisnis" class="form-control" onchange="getdataprodukbisnis()">
              <option value="">-- Select Bisnis --</option>
              <?php foreach ($dataBisnis->result() as $bisnis): ?>
                <option value="<?php echo $bisnis->id_bisnis ?>"><?php echo $bisnis->nama_binsis ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="form-group" id="form_produk_bisnis">
          <label class="col-sm-2 control-label">Nama Produk Bisnis</label>
          <div class="col-sm-10">
            <select type="text" name="id_produk" id="id_produk" class="form-control">
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Subject</label>
          <div class="col-sm-10">
            <input type="text" name="subject" id="subject" class="form-control" required="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Content</label>
          <div class="col-sm-10">
            <textarea name="content" id="content" class="form-control" required></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-9"></div>
          <div class="col-sm-3" style="text-align: right">
            <button class="btn btn-primary" type="submit">Send Broadcast</button>
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

    $('#form_produk_bisnis').hide();
    $('#form_bisnis').hide();

    $('#broadcast_type').change(function () {
      if ($(this).val() == 'Investor Bisnis') {
        $('#form_bisnis').show();
        $('#form_produk_bisnis').hide();
        $('#id_bisnis').attr('required', 'required');
        $('#id_produk').removeAttr('required');
        $('#id_produk').val('');
      } else if ($(this).val() == 'Investor Produk Bisnis') {
        $('#form_bisnis').show();
        $('#form_produk_bisnis').show();
        $('#id_bisnis').attr('required', 'required');
        $('#id_produk').attr('required', 'required');
      } else {
        $('#form_bisnis').hide();
        $('#form_produk_bisnis').hide();
        $('#id_bisnis').removeAttr('required');
        $('#id_bisnis').val('');
        $('#id_produk').removeAttr('required');
        $('#id_produk').val('');
      }
    })
  })

  function getdataprodukbisnis() {
    var broadcast_type = $('#broadcast_type').val();
    var id_bisnis = $('#id_bisnis').val();

    if (broadcast_type == 'Investor Produk Bisnis') {
      $.ajax({
        url: '<?= base_url() ?>broadcast/getprodukbisnis/'+id_bisnis,
        success: function (response) {
          $('#id_produk').html(response);
        }
      })
    }
  }
</script>
