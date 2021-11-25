<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <?php //$tamp = $data_adminNumRows->foto; ?>
      
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $this->config->item('base_url'); ?>assets/admin/img/user.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $data_adminNumRows->username ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      
        <?php 

      $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
      $uri_segments = explode('/', $uri_path);
      $tmp = '';
      if (isset($uri_segments[1])) {
        $tmp = $uri_segments[1];
      }
    ?>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <!-- <li class="active"> -->
        <?php if ($this->session->userdata('tipe') == 'admin') {
        ?> 

        <li class="<?php echo $tmp == 'Admin'?'active':'' ?>">
          <a href="<?php echo base_url() ?>Admin/Home">
            <i class="fa fa-dashboard"></i> <span>Dashboard </span>
          </a>
        </li>
        <?php } ?>
        
        <?php if ($this->session->userdata('tipe') == 'admin') {
        ?>

        <li class="<?php echo $tmp == 'Akun'?'active':'' ?>">
          <a href="<?php echo base_url() ?>Akun"> 
            <i class="fa fa-user"></i><span>User</span>        
          </a>
        </li>

        <li class="<?php echo $tmp == 'Dana'?'active':'' ?>">
          <a href="<?php echo base_url() ?>Dana"> 
            <i class="fa fa-money"></i><span>Penarikan Dana</span> 
          </a>
        </li>

        <li class="<?php echo $tmp == 'DanaInvest'?'active':'' ?>">
          <a href="<?php echo base_url() ?>DanaInvest"> 
            <i class="fa fa-money"></i><span>Dana Invest</span> 
          </a>
        </li>
		
		<li class="<?php echo $tmp == 'GadaiSaham'?'active':'' ?>">
          <a href="<?php echo base_url() ?>GadaiSaham"> 
            <i class="fa fa-money"></i><span>Gadai Saham</span> 
          </a>
        </li>
		
		<li class="<?php echo $tmp == 'JualSaham'?'active':'' ?>">
          <a href="<?php echo base_url() ?>JualSaham"> 
            <i class="fa fa-money"></i><span>Jual Saham</span> 
          </a>
        </li>
		
		<li class="<?php echo $tmp == 'Deposit'?'active':'' ?>">
          <a href="<?php echo base_url() ?>Deposit"> 
            <i class="fa fa-money"></i><span>Deposit User</span> 
          </a>
        </li>
		

        <?php } ?>

        <?php if ($this->session->userdata('tipe') == 'admin') {
        ?>
		
		<li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Bisnis</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu ">
			   <li class="<?php echo $tmp == 'Kategori'?'active':'' ?>">
				  <a href="<?php echo base_url() ?>Kategori">
					<i class="fa fa-briefcase" aria-hidden="true"></i><span>Kategori</span>
				  </a>
				</li>
				
				<li class="<?php echo $tmp == 'Bisnis'?'active':'' ?>">
				  <a href="<?php echo base_url() ?>Bisnis">
					<i class="fa fa-briefcase" aria-hidden="true"></i><span>Daftar Bisnis</span>
				  </a>
				</li>
			
            
          </ul>
        </li>
		
		<li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu ">
			   <li class="<?php echo $tmp == 'Laporanbisnis'?'active':'' ?>">
				  <a href="<?php echo base_url() ?>Laporanbisnis">
					<i class="fa fa-briefcase" aria-hidden="true"></i><span>Laporan Bisnis</span>
				  </a>
				</li>
				
				<li class="<?php echo $tmp == 'Erups'?'active':'' ?>">
				  <a href="<?php echo base_url() ?>Erups">
					<i class="fa fa-briefcase" aria-hidden="true"></i><span>E-RUPS</span>
				  </a>
				</li>
			
				<li class="<?php echo $tmp == 'Evoting'?'active':'' ?>">
				  <a href="<?php echo base_url() ?>Evoting">
					<i class="fa fa-briefcase" aria-hidden="true"></i><span>E-Voting</span>
				  </a>
				</li>
          </ul>
        </li>
		
		



		
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu ">
            <li class="<?php echo $tmp == 'MasterPage'?'active':'' ?>">
              <a href="<?php echo base_url() ?>MasterPage">
                <i class="fa fa-newspaper-o"></i> <span>Master Page</span>
              </a>
            </li>
			
			
            <!--<li class="<?php echo $tmp == 'Produk'?'active':'' ?>">
              <a href="<?php echo base_url() ?>Produk">
                <i class="fa fa-briefcase" aria-hidden="true"></i><span>Produk</span>
              </a>
            </li>-->
            
            <li class="<?php echo $tmp == 'Bank'?'active':'' ?>">
              <a href="<?php echo base_url() ?>Bank">
                <i class="fa fa-money" aria-hidden="true"></i><span>Bank</span>
              </a>
            </li>

            <li class="<?php echo $tmp == 'Msetting'?'active':'' ?>">
              <a href="<?php echo base_url() ?>Msetting">
                <i class="fa fa-money" aria-hidden="true"></i><span>Master Setting</span>
              </a>
            </li>

            <!-- <li class="<?php echo $tmp == 'Referal'?'active':'' ?>">
              <a href="<?php echo base_url() ?>Referal">
                <i class="fa fa-money" aria-hidden="true"></i><span>Referal</span>
              </a>
            </li> -->
            
          </ul>
        </li>

        
        

        <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>