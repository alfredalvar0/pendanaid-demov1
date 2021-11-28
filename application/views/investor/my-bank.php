<?php
$data = "";
if($data_bank->num_rows()>0){
	$data=$data_bank->row();
}
?>

<div id="app" class="dashboard">
	<?= $sidebar; ?>
	<div class="content-wrapper">
		<nav class="top-toolbar navbar navbar-mobile navbar-tablet align-items-center bg-white" style="padding: 0 15px;">
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
				<h1>Data Bank</h1>
			</header>
			<!--END PAGE HEADER -->
			<!--START PAGE CONTENT -->
			<section class="page-content container-fluid">
				<div class="row">
					<div class="col-md-8 col-lg-6">
						<div class="card card-body border-0 shadow">
							<form action="<?= base_url(); ?>investor/proses_edit_bank" method="POST">
								<input type="hidden" name="id_pengguna" value="<?= $data != "" ? $data-> id_pengguna : ""; ?>" />
								<div class="form-group">
									<label class="control-label text-left" for="bank">Bank</label>
									<select class="form-control" name="bank" id="bank">
										<option selected disabled>-- Pilih Bank --</option>
										<?php  foreach($mbank->result() as $dtb){
											echo '<option value="'.$dtb->id_bank.'" '.($dtb->id_bank==$data->bank?"selected":"").'>'.$dtb->nama_bank.'</option>';
										}?>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label text-left" for="akun_bank">Nama Akun Bank</label>
									<input type="text" id="akun_bank" class="form-control" name="nama_akun" value="<?php echo $data!=""?$data->nama_akun:""; ?>" />
								</div>
								<div class="form-group">
									<label class="control-label text-left" for="norek">No. Rek</label>
									<input type="text" class="form-control" id="norek" name="no_rek" value="<?php echo $data!=""?$data->no_rek:""; ?>" />
								</div>
									
								<button type="submit" class="btn custom_btn-blue mt-3">Simpan Bank</button>
							</form>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>