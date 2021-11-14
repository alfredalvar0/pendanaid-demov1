<section id="content">
    <div class="container py-5">
			<h3 class="text-center font-weight-bold">Daftar Rekening Deposit</h3>
			<h3 class="text-center mt-5">0Y!</h3>
			<div class="text-center">
				<a href="<?php echo base_url()?>investor/oy" class="btn btn-success">Proceed</a>
			</div>

			<div class="row mt-5">
				<?php foreach($data_rekening->result() as $val) { ?>
				<div class="col-md-6 col-lg-4 my-4">
					<div class="card card-body">
						<p class="text-center font-weight-bold"><?php echo $val->nama_bank?></p>
						<table>
							<tr>
								<td><b>Nomor Rekening</b></td>
								<td>&nbsp;:&nbsp;</td>
								<td><?php echo $val->no_rek?></td>
							</tr>
							<tr>
								<td><b>Atas Nama Rekening</b></td>
								<td>&nbsp;:&nbsp;</td>
								<td><?php echo $val->atas_nama?></td>
							</tr>
						</table>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="text-center">
				<a href="<?= base_url()?>investor/dana_anda" class="mt-4 btn btn-success">Mulai Deposit</a>
			</div>
    </div>
</section>