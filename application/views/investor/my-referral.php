<?php $data = ""; ?>

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
				<h1>Kode Referral Saya</h1>
			</header>
			<!--END PAGE HEADER -->
			<!--START PAGE CONTENT -->
			<section class="page-content container-fluid">
			<div class="card" >
						<div class="card-header text-left">
							<h4>Data Referral</h4>
						</div>
						<div class="card-body">
					
							<div class="form-group form-inline mb-5">
								<label class="control-label text-left mb-2 mb-md-0 mr-2" for="akun_bank">Kode Referral</label>
								<input type="text" id="kode_referral" class="form-control" name="kode_referral" value="<?php echo $data_referral!=""?$data_referral->kode_referral:""; ?>" readonly />
							</div>
							
							
							<table class="table">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Username</th>
										<th scope="col">Email</th>
										<th scope="col">Tipe</th>
										
									</tr>
								</thead>
								<tbody>
									<?php
									$num=0;
									foreach($list_referral->result() as $par){
										$num++;
									
										?>
										<tr>
											<td><?php echo $num; ?></td>
											<td><?php echo $par->username; ?></td>
											<td><?php echo $par->email; ?></td>
											<td><?php echo $par->tipe; ?></td>
											
										</tr>
										<?php
										
									}
									?>
								</tbody>
							</table>
							
							
						</div>
					</div>
			</section>
		</div>

	</div>
</div>
<?php

?>