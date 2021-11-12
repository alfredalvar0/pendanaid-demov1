<div id="app" class="dashboard">
	<?= $sidebar; ?>
	<div class="content-wrapper">
		<nav class="top-toolbar navbar navbar-mobile navbar-tablet align-items-center">
			<ul class="navbar-nav nav-left">
				<li class="nav-item">
					<a href="javascript:void(0)" data-toggle-state="aside-left-open">
						<i class="fa fa-bars d-flex align-items-center justify-content-center"></i>
					</a>
				</li>
			</ul>
			<ul class="navbar-nav nav-center site-logo">
				<li class="d-flex align-items-center">
					<a href="<?= base_url(); ?>">
						<div class="mobile_logo d-block">
							<img src="<?= base_url(); ?>assets/img/new/logo_pendana.png" alt="Logo Pendana" width="50" height="50"
								class="img-fluid">
						</div>
						
					</a>
				</li>
			</ul>
		</nav>

		<div class="content">
			<!--START PAGE HEADER -->
			<header class="page-header">
				<h1>Daftar Dokumen</h1>
			</header>
			<!--END PAGE HEADER -->
			<!--START PAGE CONTENT -->
			<section class="page-content container-fluid">
				<div class="row document-list">
				<?php
					$arrm = array();
					$arrm[] = array("url"=>base_url()."investor/agreement","text"=>"Dokumen Utama","icon"=>"fa fa-address-card-o","color"=>"text-info");
					// $arrm[] = array("url"=>base_url()."investor/perjanjiananggota","text"=>"Perjanjian keanggotaan","icon"=>"fa fa-file-text-o","color"=>"text-success");
					// $arrm[] = array("url"=>base_url()."investor/perjanjianpinjaman","text"=>"Perjanjian investasi","icon"=>"fa fa-file-pdf-o","color"=>"text-danger");
					//$arrm[] = array("url"=>"javascript:;","text"=>"Perjanjian auto investasi");
					foreach($arrm as $dt) { ?>
						<div class="col-lg-4">
							<div class="card border-0">
								<div class="d-flex mb-5">
									<figure class="mb-0 mr-3">
										<i class="<?= $dt['icon'];?> <?= $dt['color']; ?>" style="font-size: 20px;"></i>
									</figure>
									<div>
										<p class="mb-0 font-weight-bold text-capitalize"><?= $dt['text']; ?></p>
										<!-- <p class="mb-0 text-grey">Lorem ipsum dolor sit amet.</p> -->
									</div>
								</div>
								<div class="btn-wrapper">
									<a href="<?= $dt['url'] ?>" class="text-blue font-weight-bold">Lihat Selengkapnya</a>
								</div>
							</div>
						</div>
				<?php } ?>
				</div>
			</section>
		</div>

	</div>
</div>
