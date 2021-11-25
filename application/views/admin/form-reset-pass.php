<?php $this->load->view('admin/head') ?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url(); ?>" >
		<img width="100px" src="<?php echo base_url() ?>assets/img/investpro.png" />
	</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Enter your email to reset password</p>
    <?php
        if ($this->session->flashdata('notif') != "") {
            echo $this->session->flashdata('notif');
        }
    ?>
    <form action="<?php echo base_url() ?>Loginadmin/prosesResetPass" method="post">
      <input type="hidden" name="id_role" value="1">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" value="<?= $datatoken->mailto ?>" readonly>
        <input type="hidden" name="key" value="<?= $key ?>">
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="New Password" name="npass">
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Confirm New Password" name="cpass">
      </div>
      <div class="row">

        <!-- /.col -->
        <div class="col-xs-6 ">
        </div>
        <div class="col-xs-6 ">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Proses</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->

    <!-- <a href="#">I forgot my password</a><br> -->


  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php $this->load->view('admin/footer') ?>

<!-- iCheck -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });

  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
    });
  }, 3000);
</script>

</body>
</html>
