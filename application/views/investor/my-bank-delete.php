<section id="team" >
    <div class="container"  >
        <div class="section">
            <div class="row mt-5">
                <div class="col-12" align="center">
					<div class="card">
						<div class="card-header">
							Add Bank
						</div>
						<div class="card-body">
							<form action="<?php echo base_url(); ?>investor/proses_delete_bank">
								<input type="hidden" name="id_bank_pengguna" />
								<div class="form-group">
									<label for="exampleInputEmail1">Bank</label>
									<select class="form-control" name="bank">
										<option value="1">BCA</option>
										<option value="2">Mandiri</option>
										<option value="3">BRI</option>
									</select>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Nama Akun Bank</label>
									<input type="text" class="form-control" name="nama_akun" />
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">No. Rek</label>
									<input type="text" class="form-control" name="no_rek" />
								</div>
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</section>