<?php $data = ""; ?>

<section id="content">
	<div class="container py-5">
		<h1 class="mb-5" style="font-weight: 700; font-size: 28px;">Pemberitahuan</h1>
		<div class="card p-4 p-lg-5">
			<div class="row">
				<?php foreach($data_pesan->result() as $par) { ?>
					<div class="col-md-12 alert alert-success" id="success-alert" style="text-align:left">
						<?php echo $par->msgcreateddate; ?> &nbsp; - &nbsp;<?php echo $par->pesan; ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
