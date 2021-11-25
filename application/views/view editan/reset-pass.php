 <br><br><br>
    
    <!--==========================
       Login Section
    ============================-->
    
    

    <section id="team">
      <div class="container">
        <div class="section-header">
          <h3>Reset Password Akun Investasi</h3>
        </div>
        
        <div class="row wow fadeInUp">
        <div class="col-md-3"></div>
        <div class="col-md-6">    
            <div class="form">
              
              <form action="<?php echo base_url() ?>invest/prosesResetPass" method="post" role="form" class="contactFormx">
				<label class="control-label">Email : <b><?php echo $datatoken->email; ?></b></label>
				<input type="hidden" name="key" value="<?php echo $key ?>" />
                <div class="form-row">
                   
                  <div class="form-group col-lg-12 inner-addon left-addon">
                    <i class="fa fa-lock"></i>
                   <input class="form-control" id="npass" name="npass" type="password" placeholder="Password" onkeyup="checkPass();" autofocus="" required/>
                    
                  </div>
				  <div class="form-group col-lg-12 inner-addon left-addon">
                    <i class="fa fa-lock"></i>
                   <input class="form-control" id="cpass" name="cpass" type="password" placeholder="Konfirmasi Password" onkeyup="checkPass();" autofocus="" required/>
                    
                  </div>
                </div>
                
                <div class="text-center">
                    <div class="row">
                        <div class="col-md-3">&nbsp;</div>
                        <div class="col-md-6">
                            <button id="button" class="btn btn-lg btn-warning btn-block" type="submit" >Kirim</button>
                        </div>
                        <div class="col-md-3">&nbsp;</div>
                    </div>
                    
                </div>
                <div style="text-align:center">
                    <br><br>
                    Belum punya akun?  <a href="<?php echo base_url() ?>invest/register">Daftar sekarang</a>
                  
                </div>
              </form>
            </div>
            

        </div>
        <div class="col-md-3"></div>
        </div>
      </div>
    </section><!-- #team -->
	<script type="text/javascript">
	
		function checkPass(){
				var npass=$("#npass").val();
				var cpass=$("#cpass").val();
				if(npass.length>0 && cpass.length>0 && (npass == cpass)){
					$("#button").prop("disabled",false);
				} else {
					$("#button").prop("disabled",true);
				}
		}
    </script>
    