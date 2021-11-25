<?php $this->load->view('admin/head') ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php 
    $data=array();
    $idadmin=array('id_admin'=>$this->session->userdata('id_admins'));
    $data['data_adminNumRows'] =$this->M_admin->data_adminNumRows($idadmin);
    $this->load->view('admin/header',$data) ?>

  <!-- Left side column. contains the logo and sidebar -->
  <?php 
  $data=array();
  $idadmin=array('id_admin'=>$this->session->userdata('id_admins'));
  $data['data_adminNumRows'] =$this->M_admin->data_adminNumRows($idadmin);
  $this->load->view('admin/menu',$data) ?>

  <!-- Content Wrapper. Contains page content -->
  <?php $this->load->view('admin/footer'); ?>
  <?php $data = array('content' => $content); ?>
  <?php $this->load->view($content,$data) ?>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <!-- <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div> -->
    <strong>Copyright &copy; 2019 <a href="<?php echo base_url() ?>Home/home">Invest.com</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  
</div>
<!-- ./wrapper -->






</body>
</html>
