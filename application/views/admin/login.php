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
    <p class="login-box-msg">Sign in to start your session</p>
    <?php
        if ($this->session->flashdata('notif') != "") {
            echo $this->session->flashdata('notif');
        }
    ?>
    <form action="<?php echo base_url() ?>Loginadmin/do_login" method="post">
      <input type="hidden" name="id_role" value="1">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">

        <!-- /.col -->
        <div class="col-xs-5 ">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <div class="col-xs-7 " style="text-align: right; font-size: 8pt;">
          Lupa Password ? <a href="<?= base_url('admin/reset_pass') ?>">Reset Password</a>
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
