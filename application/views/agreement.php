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
				<h1>Dokumen Utama</h1>
			</header>
			<!--END PAGE HEADER -->
			<!--START PAGE CONTENT -->
			<section class="page-content container-fluid">
                <form name="agreement" method="post" enctype="multipart/form-data" action="<?= base_url()?>investor/proses_agreement">
                    <div class="row">
                        <div class="col-md-4 text-center align-items-center">
                        <?php if($data_foto->foto_ktp !=""){ echo '<img style="width:225px;height:150px;border:2px solid grey" src="'.base_url().'assets/img/dokumen/ktp/'.$data_foto->foto_ktp.'">';}else{?>
                            <input type="file" class="dropify" name="foto_ktp" id="imgktp" accept="image/*">
                            <?php } ?><br>
                            <h5>KTP</h5>
                        </div>
                        <div class="col-md-4 text-center align-items-center">
                        <?php if($data_foto->foto_npwp !=""){ echo '<img style="width:225px;height:150px;border:2px solid grey" src="'.base_url().'assets/img/dokumen/npwp/'.$data_foto->foto_npwp.'">';}else{?>
                            <input type="file" class="dropify" name="foto_npwp" id="imgnpwp" accept="image/*">
                            <?php } ?><br>
                            <h5>NPWP</h5>
                        </div>
                        <div class="col-md-4 text-center align-items-center">
                            <?php if($data_foto->buku_tabungan !=""){ echo '<img style="width:225px;height:150px;border:2px solid grey" src="'.base_url().'assets/img/dokumen/buku_tabungan/'.$data_foto->buku_tabungan.'">';}else{?>
                            <input type="file" class="dropify" name="buku_tabungan" id="imgsim" accept="image/*">
                            <?php } ?><br>
                            <h5>Buku Tabungan</h5>
                        </div>
                        <div class="col-md-4 text-center align-items-center">
                            <?php if($data_foto->selfie !=""){ echo '<img style="width:225px;height:150px;border:2px solid grey" src="'.base_url().'assets/img/dokumen/selfie/'.$data_foto->selfie.'">';}else{?>
                            <input type="file" class="dropify" name="selfie" id="imgbpjs" accept="image/*">
                            <?php } ?><br>
                            <h5>Selfie <?php if($data_foto->foto_bpjs !=""){ ?>&nbsp;<a href="<?php echo base_url()?>investor/delete_agreement/foto_bpjs" style="font-size:14px">(hapus)</a><?php }?></h5>
                        </div>
                    </div>
                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-primary">Simpan Dokumen</button>
                    </div>
                </form>
			</section>
		</div>
	</div>
</div>

<script type="text/javascript">
    var step=0;
    $(document).ready(function(){
		$('#imgttd').dropify();
		$('#imgktp').dropify();
		$('#imgsim').dropify();
		$('#imgslipgaji').dropify();
		$('#imgnpwp').dropify();
		$('#imgbpjs').dropify();
	});
</script>