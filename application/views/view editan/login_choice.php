<br><br><br><br><br><br>
    
    <!--==========================
       Login Section
    ============================-->
    <section id="team">
        <div class="container">
            <div class="section-header">
                 
                <h3><?php echo ucfirst($role_reg); ?></h3>
            </div>
        </div>
        <div class="row wow fadeInUp">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-6">
                        <form action="<?php echo base_url(); ?>invest/register_choice" method="post">
                            <input type="hidden" name="user_reg" value="<?php echo $user_reg; ?>" />
                            <input type="hidden" name="pass_reg" value="<?php echo $pass_reg; ?>" />
                            <input type="hidden" name="role_reg" value="<?php echo $role_reg; ?>" />
                            <input type="hidden" name="choice_reg" value="perorangan" />
                            <button type="submit" class="btn btn-lg  btn-block" style="border:2px solid #999;margin-right:5px">
                                <!-- <img src="<?php echo base_url() ?>assets/img/ico-person.svg" width="100px" /> -->
								<embed name="E" id="E" src="<?php echo base_url() ?>assets/img/ico-person.svg" width="100px" height="100px">
                                <p>Perorangan</p>
                            </button>
                        </form>
                    </div>
                    <div class="col-6">
                        <form action="<?php echo base_url(); ?>invest/register_choice" method="post">
                            <input type="hidden" name="user_reg" value="<?php echo $user_reg; ?>" />
                            <input type="hidden" name="pass_reg" value="<?php echo $pass_reg; ?>" />
                            <input type="hidden" name="role_reg" value="<?php echo $role_reg; ?>" />
                            <input type="hidden" name="choice_reg" value="perusahaan" />
                            <button type="submit" class="btn btn-lg  btn-block" style="border:2px solid #999;margin-right:5px">
                                <!-- <img src="<?php echo base_url() ?>assets/img/ico-company.svg" width="100px" /> -->
								<embed name="E" id="E" src="<?php echo base_url() ?>assets/img/ico-company.svg" width="100px" height="100px">
                                <p>Perusahaan</p>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </section>
	<br><br><br>