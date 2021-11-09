<?php
$data = "";

?>
<br><br>
<section id="team" >
    <div class="container"  >
        <div class="section">
            <div class="row mt-5">
                <div class="col-12" align="center">
					<div class="card" >
						<div class="card-header text-left">
						
							<h4>Pemberitahuan</h4>
						</div>
						<div class="card-body">
					
							<?php
			
							foreach($data_pesan->result() as $par){
							
								?>
								<div class="col-md-12 alert alert-success" id="success-alert" style="text-align:left">
                                    <!--<button type="button" class="close" data-dismiss="alert">x</button>-->
                                    <!--<strong>Success! </strong>-->
                                    <?php echo $par->msgcreateddate; ?> &nbsp; - &nbsp;<?php echo $par->pesan; ?>
                                </div>
							
								<?php
								
							}
							?>
								
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php

?>
