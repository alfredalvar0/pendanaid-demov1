
<br><br>
<section id="team" >
    <div class="container"  >
        <div class="section">
            <!--<div class="row mt-5">
                <div class="col-md-12" align="center">
                    <h4 class="text-center"><b>Dokumen</b></h4>
                </div>
            </div>-->

            

            <!-- wrapper content investor-->
            <div class="row mb-5 h-100 mt-5" style="">

            	<?php echo $sidebar; ?>


				<!-- content -->
				<div class="col-lg-9" style="">
          			

					<div class="row mt-5">
		                <div class="col-md-12" align="center">
		                    <h4 class="text-center"><b>Dokumen</b></h4>
		                </div>
			        </div>

	          		<div class="row justify-content-center mt-2" style="height: 100%;">



	          			<div class="col-md-12">
								<table id="example" class="table table-hover" style="width:100%">
									<thead>
										<tr>
											<th scope="col">No</th>
											<th scope="col">Daftar Dokumen</th>
										</tr>
									</thead>

									<tbody>
										<?php
											$arrm = array();
											$arrm[] = array("url"=>base_url()."investor/agreement","text"=>"Dokumen Utama","icon"=>"fa fa-address-card-o","color"=>"text-info");
											// $arrm[] = array("url"=>base_url()."investor/perjanjiananggota","text"=>"Perjanjian keanggotaan","icon"=>"fa fa-file-text-o","color"=>"text-success");
											// $arrm[] = array("url"=>base_url()."investor/perjanjianpinjaman","text"=>"Perjanjian investasi","icon"=>"fa fa-file-pdf-o","color"=>"text-danger");
											//$arrm[] = array("url"=>"javascript:;","text"=>"Perjanjian auto investasi");
											$num = 1;
											foreach($arrm as $dt)
											{
										?>
										<tr>
											<td><?php echo $num; ?></td>
											<td>
												<a class="text-dark" href="<?php echo $dt['url'] ?>">
													<i class="<?php echo $dt['icon'];?> <?php echo $dt['color']; ?> mr-2" style="font-size: 20px;"></i> <?php echo $dt['text']; ?>
													<br>
												</a>
											</td>
										</tr>
										<?php
												$num++;
											}
										?>
									</tbody>
								</table>
								</div>


						<!--
	                	<?php
							$arrm = array();
							$arrm[] = array("url"=>base_url()."investor/agreement","text"=>"Dokumen Utama","icon"=>"fa fa-address-card-o","color"=>"text-info");
							$arrm[] = array("url"=>base_url()."investor/perjanjiananggota","text"=>"Perjanjian keanggotaan","icon"=>"fa fa-file-text-o","color"=>"text-success");
							$arrm[] = array("url"=>base_url()."investor/perjanjianpinjaman","text"=>"Perjanjian investasi","icon"=>"fa fa-file-pdf-o","color"=>"text-danger");
							//$arrm[] = array("url"=>"javascript:;","text"=>"Perjanjian auto investasi");
							foreach($arrm as $dt){
								?>
						<div class="col-md-4 mt-4" style="">
							<div id="card-product" class="card" style="padding-top: 5px;">
								<div class="container-produk"></div>
								<div class="card-body">
									<div class="row">
										<div class="col-12">
											<p style="font-size:14px;" class="mb-0" align="center">
												<a class="text-dark" href="<?php echo $dt['url'] ?>">
													<i class="<?php echo $dt['icon'];?> <?php echo $dt['color']; ?>" style="font-size: 20px;"></i> <b><?php echo $dt['text']; ?></b>
												</a>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<?php
							}
						?>-->
					</div>
				
			</div>



			</div>

            
            








				<!--
				<div class="col-md-4">
                    <ul class="list-group">
						<?php
						$arrm = array();
						$arrm[] = array("url"=>base_url()."investor/agreement","text"=>"Dokumen Utama");
						$arrm[] = array("url"=>base_url()."investor/perjanjiananggota","text"=>"Perjanjian keanggotaan");
						$arrm[] = array("url"=>base_url()."investor/perjanjianpinjaman","text"=>"Perjanjian investasi");
						//$arrm[] = array("url"=>"javascript:;","text"=>"Perjanjian auto investasi");
						foreach($arrm as $dt){
							?>
							<li class="list-group-item border mb-1 rounded"><a class="text-dark row" href="<?php echo $dt['url'] ?>"><label class="col-10"><?php echo $dt['text']; ?></label> <i class="col-2 fa fa-chevron-right float-right mt-2" style="color:#fdda0a"></i></a> </li>
							<?php
						}
						?>
					</ul>
                </div>
            	-->



            
        </div>
    </div>
</section>
