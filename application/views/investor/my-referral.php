<?php $data = ""; ?>

<div id="app" class="dashboard">
	<?= $sidebar; ?>
	<div class="content-wrapper">
		<nav class="top-toolbar navbar navbar-mobile navbar-tablet align-items-center" style="padding: 0 15px;">
			<ul class="navbar-nav nav-left">
				<li class="nav-item">
					<a href="javascript:void(0)" data-toggle-state="aside-left-open" style="min-width: unset;">
						<i class="fa fa-bars d-flex align-items-center justify-content-center"></i>
					</a>
				</li>
			</ul>
			<ul class="navbar-nav nav-center site-logo">
				<li class="d-flex align-items-center">
					<a href="<?= base_url(); ?>">
						<div class="mobile_logo d-flex">
							<img src="<?= base_url(); ?>assets/img/new/logo_pendana.png" alt="Logo Pendana" width="50" height="50"
								class="img-fluid">
							<div class="d-block d-lg-none d-flex align-items-center">
								<img class="mr-2" style="max-height: 35px;" src="<?= base_url(); ?>assets/img/new/logo_ojk.png" alt="Otoritas Jasa Keuangan">
								<img style="max-height: 35px;" src="<?= base_url(); ?>assets/img/partner/logo_mui.png" alt="Otoritas Jasa Keuangan">
							</div>
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
										<th scope="col">ID User</th>
										<th scope="col">Tgl Join </th>
										<th scope="col">Tgl Invest </th>
										<th scope="col">Jumlah Invest </th>
										<th scope="col">No Trx Invest </th>
										<th scope="col">% Komisi </th>
										<th scope="col">Status Komisi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$num=0;
									foreach($list_referral->result() as $par){
										$num++;
										$komisi = (int)$par->jumlah_invest * ($par->persen_komisi/100);
										?>
										<tr>
											<td><?php echo $num; ?></td>
											<td><?php echo $par->id_user; ?></td>
											<td><?php echo date('d/m/Y H:i:s', strtotime($par->tanggal_join)); ?></td>
											<td><?php echo date('d/m/Y H:i:s', strtotime($par->tanggal_invest)); ?></td>
											<td><?php echo number_format($par->jumlah_invest, 0, ',', '.'); ?></td>
											<td><?php echo $par->no_trx_invest; ?></td>
											<td><?php echo number_format($komisi, 0, ',', '.').'&nbsp;('.$par->persen_komisi.'%)'; ?></td>
											<td>
										        <?php if($par->status == "0"): ?>
										          <label class="badge badge-danger"><i class="fa fa-fw fa-thumbs-down"></i> Refused</label>
										        <?php elseif($par->status == "1"): ?>
										          <label class="badge badge-success"><i class="fa fa-fw fa-thumbs-up"></i> Approved</label>
										        <?php else: ?>
										          <label class="badge badge-default"><i class="fa fa-fw fa-clock-o"></i> Pending</label>
										        <?php endif; ?>
											</td>
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