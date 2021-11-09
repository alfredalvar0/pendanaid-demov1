<br><br><br>
    <?php
	$url="";
	if($login_from=="google"){
		$url="invest/oauth2callback";
	}else if($login_from=="fb"){
		$url="invest/oauthfbcallback";
	}
	
	?>
    <!--==========================
       Role Section
    ============================-->
    <section id="team">
        <div class="container">
            <div class="section-header">
                <h3>Pilihan Anda</h3>
                <p>Tentukan pilihan anda</p>
            </div>
        </div>
        <div class="row wow fadeInUp">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-6">
                        <form action="<?php echo base_url().$url; ?>" method="post">
                            <input type="hidden" name="user_reg" value="<?php echo $user_reg; ?>" />
                            <input type="hidden" name="pass_reg" value="<?php echo $pass_reg; ?>" />
                            <input type="hidden" name="role_reg" value="investor" />
                            <button type="submit" class="btn btn-lg  btn-block" style="border:2px solid #999;margin-right:5px">
                                <!--<img src="<?php echo base_url() ?>assets/img/ico-investor.svg"  width="100px" />-->
                                <embed name="E" id="E" src="<?php echo base_url() ?>assets/img/ico-investor.svg" width="100px" height="100px">
                                <p>Investor</p>
                                <p>Daftar sebagai pemberi pinjaman</p>
                            </button>
                        </form>
                    </div>
                    <div class="col-6">
                        <form action="<?php echo base_url().$url; ?>" method="post">
                            <input type="hidden" name="user_reg" value="<?php echo $user_reg; ?>" />
                            <input type="hidden" name="pass_reg" value="<?php echo $pass_reg; ?>" />
                            <input type="hidden" name="role_reg" value="borrower" />
                            <button type="submit" class="btn btn-lg  btn-block" style="border:2px solid #999;margin-right:5px">
                                <!--<img src="<?php echo base_url() ?>assets/img/ico-investor.svg" width="100px" />-->
                                <embed name="E" id="E" src="<?php echo base_url() ?>assets/img/ico-borrower.svg" width="100px" height="100px">
                                <p>Borrower</p>
                                <p>Daftar sebagai peminjam</p>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </section>