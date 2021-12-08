<?php
$wh = array("kategori"=>"sidebar","status_delete"=>"0");
$datasidebar = $this->m_invest->getPage($wh);

$wh=array(
	"a.email"=>$this->session->userdata("invest_email"),
	"a.login_from"=>$this->session->userdata("invest_login"),
	"a.status"=>"aktif"
	);
$jum_dana=0;
$data=$this->m_invest->checkUser($wh);
 if($data->num_rows()>0){
	$dt=$data->row();
	if($dt->id_pengguna>0){
		$whd=array("id_pengguna"=>$this->session->userdata("invest_pengguna"));
		
		if($this->m_invest->checkRole()=="investor"){
			$dana=$this->m_invest->dataDana($whd);
			$jum_dana=$dana->num_rows()>0?$dana->row()->saldo:0;
		}  
    } 
} 
?>

<aside class="sidebar sidebar-left">
    <div class="sidebar-content bg-white">
        <div class="aside-toolbar">
            <div class="user d-flex align-items-center p-3 border">
                <div class="picture mr-3">
                    <img src="<?= base_url(); ?>assets/img/new/avatar.jpg" alt="<?= $this->session->userdata("invest_realname"); ?>" width="40" height="40">
                </div>
                <div class="description">
                    <h2 class="mb-0 font-weight-bold profile-name text-capitalize"><?= explode(" ", $this->session->userdata("invest_realname"))[0]; ?></h2>
                    <span class="d-block text-grey profile-balance"><?= $this->session->userdata("invest_username"); ?><span>
                </div>
            </div>
        </div>

        <nav class="main-menu mb-4">
            <ul class="nav metismenu">
                <li class="">
                    <a href="<?= base_url(); ?>" class="px-3">
                        <i class="fa fa-fw fa-home d-inline-flex align-items-center justify-content-center" style="vertical-align: middle;"></i>
                        Beranda
                    </a>
                </li>
                <?php  
                $wh = array("kategori"=>"sidebar","status_delete"=>"0");
                $datasidebar = $this->m_invest->getPage($wh);
                $sep=array("Dokumen","Portofolio","Akun Bank","Kode Referral","E-RUPS","E-Voting", "Pasar Sekunder");
                foreach($datasidebar->result() as $dts){
                    $link = base_url().'invest/page/'.$dts->link_page;
                    if(in_array($dts->judul,$sep)){
                        $link = base_url().$dts->link_page;
                    }
                ?> 
                <li class="<?php if(base_url(uri_string())==$link) echo 'active'; ?> ">
                    <a href="<?php echo $link; ?>" class="px-3">
                        <i class="fa fa-fw <?php echo $dts->icon; ?> d-inline-flex align-items-center justify-content-center" style="vertical-align: middle;"></i>
                        <?php echo $dts->judul; ?>
                    </a>
                </li>
                <?php } ?>
                <li class="">
                    <a href="<?= base_url(); ?>invest/logout" class="px-3">
                        <i class="fa fa-fw fa-sign-out"></i>
                        Log Out
                    </a>
                </li>
            </ul>
        </nav>

        <div class="wallet-card p-3 border">
            <p class="mb-0 font-weight-bold text-capitalize">Saldo Anda</p>
            <span class="d-block mb-3">Rp <?= number_format($jum_dana,0,".","."); ?></span>
            <a href="<?= base_url(); ?>investor/dana_anda" class="custom_btn-blue" style="font-size: 14px; padding: 8px 16px;">Top Up</a>
        </div>
    </div>
</aside>
