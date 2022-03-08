<section id="content">
	<div class="container py-5">
		<div class="row">
			<div class="col-md-8 col-lg-10 mx-auto">
				<h1 class="mb-5 text-center" style="font-weight: 700; font-size: 28px;">Konfirmasi Pembayaran</h1>
				
				<?php 
	                if ($this->session->flashdata('notif') != "") { 
	                    echo $this->session->flashdata('notif');
	                } 
	            ?>
				<div class="card card-body">

					<?php foreach ($metode_pembayaran->result() as $row): ?>
						<p style="font-size: 20px; font-weight: 700;"><?php echo $row->method ?></p>


						<form method="POST" action="<?php echo base_url() ?>investor/doKonfirmasi" enctype="multipart/form-data">
							<input type="hidden" name="id_transaksi" value="<?= $id_transaksi ?>">
							<div class="form-group">
								<label for="amount">Amount</label>
								<input value="<?= $transaksi->jumlah_dana ?>" name="amount" class="form-control" type="hidden" required readonly>
								<input value="Rp. <?= number_format($transaksi->jumlah_dana) ?>" class="form-control" required readonly>
							</div>
							<div class="form-group">
								<label for="amount">Transfer ke Bank</label>
								<select class="form-control" required name="payment_account_id">
									<option value="" disabled selected>-- Pilih Bank --</option>
									<?php foreach ($payment_accounts->result() as $row): ?>
										<option value="<?= $row->id ?>"><?php echo $row->rekening ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group">
								<label for="amount">Transfer dari Bank</label>
								<select class="form-control" required name="bank_id_from">
									<option value="" disabled selected>-- Pilih Bank --</option>
									<?php foreach ($bank->result() as $row): ?>
										<option value="<?= $row->id_bank ?>"><?php echo $row->nama_bank ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group">
								<label for="amount">No. Rekening Pengirim</label>
								<input type="text" name="account_no" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="amount">No. Rekening Pengirim atas Nama</label>
								<input type="text" name="account_name" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="amount">Bukti Transfer</label>
								<input type="file" name="transfer_proof" class="form-control" required>
							</div>
							<div class="form-group">
								<button class="btn btn-primary" style="width: 100%">Konfirmasi</button>
							</div>
						</form>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</section>
  