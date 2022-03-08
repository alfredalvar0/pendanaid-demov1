<section id="content">
	<div class="container py-5">
		<div class="row">
			<div class="col-md-8 col-lg-10 mx-auto">
				<h1 class="mb-5 text-center" style="font-weight: 700; font-size: 28px;">Metode Pembayaran</h1>
				<div class="card card-body">

					<?php foreach ($metode_pembayaran->result() as $row): ?>
						<p style="font-size: 20px; font-weight: 700;"><?php echo $row->method ?></p>

						<p>
							Silahkan melakukan pembayaran dengan cara transfer sejumlah <b>Rp. <?php echo number_format($amount->jumlah_dana) ?></b> ke nomor rekening berikut :
							<ul>
								<?php foreach ($nomor_rekening->result() as $rek): ?>
									<?php if ($rek->paymentmethod_id == $row->id): ?>
										<li><?php echo $rek->account_no." ".$rek->nama_bank ?> a/n <?php echo $rek->account_owner ?></li>
									<?php endif ?>
								<?php endforeach ?>
							</ul>
							<p>Kemudian silahkan lakukan konfirmasi pembayaran <a href="#">disini.</a></p>
						</p>
					<?php endforeach ?>

					<!-- <p style="font-size: 20px; font-weight: 700;">Check Out Form</p>

					<form id="filtyer-form" method="post">
						<input type="hidden" value="<?php echo $this->session->userdata("invest_username"); ?>" id="name" class="form-control" required>
						<input type="hidden" value="<?php echo $this->session->userdata("invest_email"); ?>" id="email" class="form-control" required>
						<input type="hidden" value="" id="phone_number" class="form-control" required>
						<input type="hidden" value="" id="description" class="form-control" required>
						
						<div class="form-group">
							<label for="amount">Amount</label>
							<input type="number" min="15000" value="" id="amount" class="form-control" required>
							<span class="text-grey mt-3 mb-4 d-block">Minimum Amount: Rp 15.000</span>
						</div>

						<button type="submit" class="btn btn-success btn-block">Proceed</button>
				</form> -->
				</div>
			</div>
		</div>
	</div>
</section>
  