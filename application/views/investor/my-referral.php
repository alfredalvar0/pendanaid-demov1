<?php
$data = "";

?>
<section id="team" >
    <div class="container"  >
        <div class="section">
            <div class="row mt-5">
                <div class="col-12" align="center">
					<div class="card" >
						<div class="card-header text-left">
						
							<h4>Data Referral</h4>
						</div>
						<div class="card-body">
					
							<div class="form-group row mb-5">
								<label class="control-label col-2 text-left" for="akun_bank">Kode Referral</label>
								<input type="text" id="kode_referral" class="form-control col-4" name="kode_referral" value="<?php echo $data_referral!=""?$data_referral->kode_referral:""; ?>" readonly />
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
                </div>
            </div>
        </div>
    </div>
</section>
<?php

?>