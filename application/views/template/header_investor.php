<style type="text/css">
iframe#\:1\.container {
    display: none !important;
}
iframe#\:0\.container {
    display: none;
}
a.goog-logo-link {
    display: none;
}
</style>
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
<div id="header" style="position: relative; z-index: 1000;">
  <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top py-2 py-lg-4">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="<?= base_url(); ?>">
      	<img src="<?= base_url() ?>assets/img/new/logo_pendana.png" alt="Logo Pendana" />
		<div class="d-block d-lg-none d-flex align-items-center">
		  <img class="mr-2" style="max-height: 35px;" src="<?= base_url(); ?>assets/img/new/logo_ojk.png" alt="Otoritas Jasa Keuangan">
		  <img style="max-height: 35px;" src="<?= base_url(); ?>assets/img/partner/logo_mui.png" alt="Otoritas Jasa Keuangan">
	  	</div>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse navigation" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
		<?php
			$wh = array("kategori"=>"sidebar","status_delete"=>"0");
			$datasidebar = $this->m_invest->getPage($wh);
			$sep=array("Dokumen","Portofolio","Akun Bank","Kode Referral","E-RUPS","E-Voting", "Pasar Sekunder");
			$akuntidakaktif = array("Tentang Kami","FAQ");
			$akuninvestor = array("Portofolio Saya","Tentang Kami","FAQ");
            foreach($dataheader->result() as $dth){
				if($this->session->userdata("invest_status")=="aktif"){
					if($this->session->userdata("invest_tipe")=="investor" && in_array($dth->judul,$akuninvestor)){ ?>
						<li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?><?php echo $dth->link_page; ?>"><?php echo $dth->judul; ?></a></li>
					<?php } else if($this->session->userdata("invest_tipe")=="borrower") { ?>
						<li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?><?php echo $dth->link_page; ?>"><?php echo $dth->judul; ?></a></li>
					<?php }
				} else {
					if(in_array($dth->judul,$akuntidakaktif)){ ?>
						<li class=""><a href="<?php echo base_url() ?><?php echo $dth->link_page; ?>"><?php echo $dth->judul; ?></a></li>
					<?php }
				}
            }?>
			<li class="nav-item">
				<a href="<?= base_url(); ?>investor/pasar_sekunder" class="nav-link">Pasar Sekunder</a>
			</li>
        </ul>
		<ul class="navbar-nav ml-auto">
			<li class="wallet d-flex align-items-center mr-4">
				<p class="mb-0 mr-2">Saldo Rp <?= number_format($jum_dana,0,".","."); ?></p>
				<a href="<?= base_url(); ?>investor/dana_anda" class="add-saldo p-2 d-flex align-items-center justify-content-center"><img
						src="<?= base_url(); ?>assets/img/new/plus.png" alt="Vector" width="16" height="16"></a>
			</li>
			<li class="nav-item d-flex align-items-center justify-content-lg-center mt-4 mt-lg-0">
				<a href="<?= base_url(); ?>investor/pesan"><i class="fa fa-bell text-grey"></i></a>
			</li>
			<li class="nav-item">
				<div class="dropdown-wrapper mt-4 mt-lg-0">
					<div class="dropdown-custom d-flex align-items-center" onclick="showDropdown()">
						<div class="avatar mr-2">
							<img src="<?= base_url(); ?>assets/img/new/user.png" alt="Shayna"
								class="img-fluid rounded-circle" width="50" height="50">
						</div>
						<p class="mb-0 font-weight-bold">Halo, <?= explode(" ", $this->session->userdata("invest_realname"))[0]; ?></p>
					</div>
					<div id="userDropdown"
						class="mt-2 dropdown-content bg-white d-none border"
						style="z-index:10;">
						<ul class="navbar-nav flex-column p-4">
							<?php
							$wh = array("kategori"=>"sidebar","status_delete"=>"0");
							$datasidebar = $this->m_invest->getPage($wh);
							$sep = array("Dokumen","Portofolio","Akun Bank","Kode Referral","E-RUPS","E-Voting", "Pasar Sekunder");
                            foreach($datasidebar->result() as $dts){
								$link = base_url().'invest/page/'.$dts->link_page;
								if(in_array($dts->judul,$sep)){
									$link = base_url().$dts->link_page;
								} ?>
									<li class="nav-item"><a class="nav-link" href="<?= $link; ?>"><?= $dts->judul; ?></a></li>
                        	<?php } ?>
							<li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>invest/logout">Log Out</a></li>
						</ul>
					</div>
				</div>
			</li>
		</ul>

        <div id="google_translate_element_mob"></div>

      </div>
    </div>
  </nav>
<div>

<script>
	function showDropdown() {
		document.getElementById("userDropdown").classList.remove("d-none");
		document.getElementById("userDropdown").classList.add("d-block");
	}

	window.addEventListener('click', function(e){   
		if (document.getElementsByClassName('dropdown-custom')[0].contains(e.target)){
		} else{
			document.getElementById("userDropdown").classList.add("d-none");
			document.getElementById("userDropdown").classList.remove("d-block");
		}
	});
</script>
<!-- <script type="text/javascript">
	function googleTranslateElementInit() {
		new google.translate.TranslateElement({ includedLanguages: "id,en" }, 'google_translate_element_log');
	}
 </script>

 <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>  -->