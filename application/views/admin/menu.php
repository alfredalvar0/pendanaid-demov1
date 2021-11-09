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
       // $tmp = $uri_segments[3];
      }
	  
	  if (isset($uri_segments[4])) {
        $tmp = $uri_segments[3]."/".$uri_segments[4];
      }
    ?>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <!-- <li class="active"> -->
        
		<?php
		$query = $this->db->query("select * from tbl_modul where submodul=0 order by urutan asc")->result();
		foreach($query as $val){
			$subquery = $this->db->query("select * from tbl_modul where submodul=".$val->id." order by urutan asc");
			$active = ($tmp == $val->url)?'active':'';
			if($subquery->num_rows()>0){
				$active = "treeview";
			}
			
			//cek akses
			$cek = $this->db->query("select * from tbl_user_akses where id_modul=".$val->id." and id_user=".$this->session->userdata('id_admins'))->result();
			
			if(!empty($cek) && ($cek[0]->status==1)){
			
			echo '<li class="'.$active.'">
				  <a href="'.base_url().$val->url.'"> 
					<i class="fa fa-table"></i><span>'.$val->modul.'</span>'; 
					if($subquery->num_rows()>0){
					echo '<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						  </span>';
					}
			echo '</a>';
				  
				  if($subquery->num_rows()>0){
					  echo ' <ul class="treeview-menu ">';
					  foreach($subquery->result() as $valsub){
						  $active = ($tmp == $valsub->url)?'active':'';
						  //cek akses
							$cek2 = $this->db->query("select * from tbl_user_akses where id_modul=".$valsub->id." and id_user=".$this->session->userdata('id_admins'))->result();
							
							if($cek2[0]->status==1){
						  echo '<li class="'.$active.'">
								  <a href="'.base_url().$valsub->url.'">
									<i class="fa fa-briefcase" aria-hidden="true"></i><span>'.$valsub->modul.'</span>
								  </a>
								</li>';
							}
					  }
					  echo '</ul>';
				  }
			echo '</li>';
			
			}
		}
		?>
		<?php if($this->session->userdata('id_admins') == 14) { ?>
        <li class="treeview">
			<a href="<?php echo site_url('#') ?>"> 
					<i class="fa fa-table"></i><span>Dana</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li>
					<a href="<?php echo site_url('Dana/menambahkan') ?>">
						<i class="fa fa-briefcase" aria-hidden="true"></i><span>Menambahkan</span>
					</a>
				</li>
				<li>
					<a href="<?php echo site_url('Dana/menarik') ?>">
						<i class="fa fa-briefcase" aria-hidden="true"></i><span>Menarik</span>
					</a>
				</li>
			</ul>
		</li>
        <?php } ?>
 
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>