<?php
$data = "";
if($data_bank->num_rows()>0){
	$data=$data_bank->row();
}
?>
<br><br> 
<section id="team" >
    <div class="container"  >
        <div class="section">
            <!--<div class="row mt-5">
            </div>-->



            <!-- wrapper content investor-->
            <div class="row mb-5 h-100 mt-5" style="">

            	<?php echo $sidebar; ?>


				<!-- content -->
				<div class="col-lg-9" style="">
          			

					<div class="row mt-5">
		                <div class="col-md-12" align="center">
		                    <!--<h4 class="text-left"><b>Dokumen</b></h4>-->
		                </div>
			        </div>

	          		<div class="row justify-content-center mt-2" style="height: 100%;">


		                 <div class="col-md-12" align="center">
							<div class="card border-0" >
								<div class="text-center border-0">
									<!-- <a href="<?php echo base_url(); ?>investor/add_bank" class="btn btn-primary"><i class="fa fa-plus"></i></a> -->
									<h4><b>Data Bank</b></h4>
								</div>
								<div class="card-body">
									<form action="<?php echo base_url(); ?>investor/proses_edit_bank" method="post">
										<input type="hidden" name="id_pengguna" value="<?php echo $data!=""?$data->id_pengguna:""; ?>" />
										<div class="form-group col-md-12">
											<label class="control-label col-md-4 text-left" for="bank">Bank</label>
											<select class="form-control col-md-7" name="bank" id="bank">
												<option selected disabled>-- Pilih Bank --</option>
												<?php 
												foreach($mbank->result() as $dtb){
													echo '<option value="'.$dtb->id_bank.'" '.($dtb->id_bank==$data->bank?"selected":"").'>'.$dtb->nama_bank.'</option>';
												}
												?>
											</select>
										</div>
										<div class="form-group col-md-12">
											<label class="control-label col-md-4 text-left" for="akun_bank">Nama Akun Bank</label>
											<input type="text" id="akun_bank" class="form-control col-md-7" name="nama_akun" value="<?php echo $data!=""?$data->nama_akun:""; ?>" />
										</div>
										<div class="form-group col-md-12">
											<label class="control-label col-md-4 text-left" for="norek">No. Rek</label>
											<input type="text" class="form-control col-md-7" id="norek" name="no_rek" value="<?php echo $data!=""?$data->no_rek:""; ?>" />
										</div>
										<div class="form-group mt-3 col-md-12">
											
										<button type="submit" class="btn btn-primary">Simpan Bank</button>
										</div>
									</form>
									 
								</div>
							</div>
		                </div>
				
			</div>



			</div>

            	
        </div>
    </div>
</section>
 