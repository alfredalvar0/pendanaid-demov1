<?php

$useragent = $_SERVER['HTTP_USER_AGENT'];
$ismobile = false;
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{
   $ismobile = true; 
}


$wh = array("kategori"=>"header","status_delete"=>"0");
$dataheader = $this->m_invest->getPage($wh);

$wh=array(
	"a.email"=>$this->session->userdata("invest_email"),
	"a.login_from"=>$this->session->userdata("invest_login"),
	"a.status"=>"aktif"
	);
$jum_dana=0;
$data=$this->m_invest->checkUser($wh);
/* if($data->num_rows()>0){
	$dt=$data->row();
	if($dt->id_pengguna>0){ */
		$whd=array("id_pengguna"=>$this->session->userdata("invest_pengguna"));
		if($this->m_invest->checkRole()=="investor"){
			$dana=$this->m_invest->dataDana($whd);
		}  
		$jum_dana=$dana->num_rows()>0?$dana->row()->saldo:0;
	/* } 
} */
?>
<!--==========================
  Header
  ============================-->
  <header id="header" class="fixed-top" style="">
    <div class="container">

      <div class="logo float-left" style="margin-top:10px" >
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <h1 class="text-light"><a href="#header"><span>NewBiz</span></a></h1> -->
        <a href="<?php echo base_url(); ?>"  >
		<img src="<?php echo base_url() ?>assets/img/investpro.png" style="width:150px; " />
        <label style="font-size:27px;color:white"></label></a>
      </div>

      <nav class="main-nav float-right d-none d-lg-block d-sm-block d-xs-block d-md-block" style="padding-bottom:5px">
        <ul>
                <?php
          if($ismobile){
          ?>
          <!--awalnya sidebar-->
          <li class="mt-2 ml-3 mb-3 text-light"><b><?php echo $this->session->userdata("invest_username"); ?></b></li>
          <li class="">
              <a href="<?php echo base_url(); ?>investor/dana_anda" class="card mt-n2">
                  <div class="card-body">
					<table width="100%">
						<tr>
							<td class="p-1">
								<p style="font-size: 15px;color:black">Dana Anda</p>
								<p style="font-size: 15px;color:black">Rp. <?php echo number_format($jum_dana,0,".","."); ?></p>
							</td>
							<td class="text-center" style="background-color:#fdda0a;">
								<i class="fa fa-plus align-middle px-2"></i>
							</td>
						</tr>
					</table>
                  </div>
              </a>
          </li>

          <li class="mt-2"><a href="<?php echo base_url()?>investor"   ><i class="fa fa-home"></i> Home</a></li>
          <li class="mt-2"><a href="<?php echo base_url()?>investor/pesan"   ><i class="fa fa-bell"></i> Pesan</a></li>
		  		<li class=""><a href="<?php echo base_url(); ?>investor/pasar_sekunder"><i class="fa fa-shopping-bag"></i> Pasar Sekunder</a></li>
		  		<hr/>      
          <?php
                $wh = array("kategori"=>"sidebar","status_delete"=>"0");
                $datasidebar = $this->m_invest->getPage($wh);
    			$sep=array("Dokumen","Portofolio","Akun Bank","Kode Referral","E-RUPS","E-Voting");
                foreach($datasidebar->result() as $dts){
    				$link = base_url().'invest/page/'.$dts->link_page;
    				if(in_array($dts->judul,$sep)){
    					$link = base_url().$dts->link_page;
    				}
    				/*
    				Dokumen Saya,Laporan Saya,Akun Bank,Kode Referal
    				*/
                    ?>
                    <li class=""><a href="<?php echo $link; ?>"><i class="fa <?php echo $dts->icon; ?>"></i> <?php echo $dts->judul; ?></a></li>
                    <?php
                }
                $arr = array();
              
                $arr[]=array("link"=>base_url()."invest/logout","icon"=>"sign-out","text"=>"Keluar");
                foreach($arr as $ar){
                ?>
                <li><a href="<?php echo $ar['link']; ?>" class="text-warning"><i class="fa fa-<?php echo $ar['icon']; ?>"></i> <?php echo $ar['text']; ?></a></li>
                <?php
                }
                ?>
                
                <?php
				$akuntidakaktif = array("Tentang Kami","FAQ");
				$akuninvestor = array("Portofolio Saya","Tentang Kami","FAQ");
                foreach($dataheader->result() as $dth){
					if($this->session->userdata("invest_status")=="aktif"){
						if($this->session->userdata("invest_tipe")=="investor" && in_array($dth->judul,$akuninvestor)){
							?>
							<li class=""><a href="<?php echo base_url() ?><?php echo $dth->link_page; ?>"><?php echo $dth->judul; ?></a></li>
							<?php
						} else if($this->session->userdata("invest_tipe")=="borrower" ){
							?>
							<li class=""><a href="<?php echo base_url() ?><?php echo $dth->link_page; ?>"><?php echo $dth->judul; ?></a></li>
							<?php
						}
					} else {
						if(in_array($dth->judul,$akuntidakaktif)){
							?>
							<li class=""><a href="<?php echo base_url() ?><?php echo $dth->link_page; ?>"><?php echo $dth->judul; ?></a></li>
							<?php
						}
					}
                }
            ?>
          <?php }

          		//else if ismobile
          		else{ ?>
          
            <?php
				$akuntidakaktif = array("Tentang Kami","FAQ");
				$akuninvestor = array("Portofolio Saya","Tentang Kami","FAQ");
                foreach($dataheader->result() as $dth){
					if($this->session->userdata("invest_status")=="aktif"){
						if($this->session->userdata("invest_tipe")=="investor" && in_array($dth->judul,$akuninvestor)){
							?>
							<li class=""><a href="<?php echo base_url() ?><?php echo $dth->link_page; ?>"><?php echo $dth->judul; ?></a></li>
							<?php
						} else if($this->session->userdata("invest_tipe")=="borrower" ){
							?>
							<li class=""><a href="<?php echo base_url() ?><?php echo $dth->link_page; ?>"><?php echo $dth->judul; ?></a></li>
							<?php
						}
					} else {
						if(in_array($dth->judul,$akuntidakaktif)){
							?>
							<li class=""><a href="<?php echo base_url() ?><?php echo $dth->link_page; ?>"><?php echo $dth->judul; ?></a></li>
							<?php
						}
					}
                }
            ?>
            
          
          
            <!-- <li class=""><a href="<?php echo base_url(); ?>investor/my_invest">Investasiku</a></li> -->
          <!-- <li class=""><a href="javascript:;">Jadilah Investor</a></li>
          <li class=""><a href="javascript:;">Ajukan Pinjaman</a></li>
          <li class=""><a href="javascript:;">Tentang Kami</a></li>
          <li class=""><a href="javascript:;">FAQ</a></li>
          -->
		  <?php 
		  //if($this->session->userdata("invest_tipe")=="investor" ){
		  ?>


		  <li class=""><a href="<?php echo base_url(); ?>investor/pasar_sekunder">Pasar Sekunder</a></li>
          <li class="">
              <a href="<?php echo base_url(); ?>investor/dana_anda" class="card ">
                  <div class="card-body">
					<table width="100%">
						<tr>
							<td class="p-1"> 
								<p style="font-size: 10px;color:black;">Saldo Rp. <?php echo number_format($jum_dana,0,".","."); ?></p>
							</td>
							<td style="background-color:#fdda0a;">
								<i class="fa fa-plus align-middle px-2"></i>
							</td>
						</tr>
					</table>
                  </div>
              </a>
          </li>
		  <?php
		  //}
		  ?>
          <li class=""><a href="<?php echo base_url()?>investor/pesan"   ><i class="fa fa-bell"></i></a></li>
		  <!--<li class=""><a href="javascript:;"    ><i class="fa fa-user-circle"></i></a></li>-->
		  

		  <li>
			<div class="dropdown">
				 <a class="dropdown-toggle" type="button" data-toggle="dropdown" style="color:#337ab7;"><i class="fa fa-user-circle" style="font-size:20px;"></i> <b><?php echo $this->session->userdata("invest_username"); ?></b></a>
					 <ul class="dropdown-menu">
						<?php
								$wh = array("kategori"=>"sidebar","status_delete"=>"0");
								$datasidebar = $this->m_invest->getPage($wh);
								$sep=array("Dokumen","Portofolio","Akun Bank","Kode Referral","E-RUPS","E-Voting");
                                foreach($datasidebar->result() as $dts){
									$link = base_url().'invest/page/'.$dts->link_page;
									if(in_array($dts->judul,$sep)){
										$link = base_url().$dts->link_page;
									}
									/*
									Dokumen Saya,Laporan Saya,Akun Bank,Kode Referal
									*/
                                    ?>
									<li class="list-group-item  rounded"><a class="text-dark" href="<?php echo $link; ?>"><i class="fa <?php echo $dts->icon; ?>"></i> <?php echo $dts->judul; ?></a></li>
                                    <?php
                                }
								$arr = array();
								 $arr[]=array("link"=>base_url()."invest/logout","icon"=>"sign-out","text"=>"Keluar");
                                foreach($arr as $ar){
								?>
								<li class="list-group-item   rounded"><a class="text-dark" href="<?php echo $ar['link']; ?>"><i class="fa fa-<?php echo $ar['icon']; ?>"></i> <?php echo $ar['text']; ?></a></li>
                               
								 <?php
                                }
								 
								?>
						  
					 </ul>
				</div>
		  </li>
		  <?php } ?>
        </ul>
      </nav><!-- .main-nav -->
      
    </div>
    
  </header><!-- #header -->

