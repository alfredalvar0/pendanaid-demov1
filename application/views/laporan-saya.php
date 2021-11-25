<br><br>
<section id="team" >
    <div class="container"  >
        <div class="section">
            <div class="row mt-5">
                <div class="col-12" align="center">
                    <h4 class="text-left"><b>Laporan Saya</b></h4>
                </div>
				<div class="col-md-4">
                    <ul class="list-group">
						<?php
						$arrm = array();
						$arrm[] = array("url"=>base_url()."investor/proyeksi","text"=>"Laporan bagi hasil laba bulanan");
						foreach($arrm as $dt){
							?>
							<li class="list-group-item border mb-1 rounded"><a class="text-dark row" href="<?php echo $dt['url'] ?>"><label class="col-10"><?php echo $dt['text']; ?></label> <i class="col-2 fa fa-chevron-right float-right mt-2" style="color:#fdda0a"></i></a> </li>
							<?php
						}
						?>
					</ul>
                </div>
            </div>
        </div>
    </div>
</section>