<?php 
  $login_url = $this->facebook->login_url();
  $google_login_url = $this->google->get_login_url();
 ?>
   <br><br><br>
    
    <!--==========================
       Login Section
    ============================-->
    
     <?php if($this->session->userdata("invest_username")==""){echo "<br><br><br><br>";}?>

    <section id="team">
      <div class="container">
        <div class="section-header">
          <h3>Masuk Akun Investasi</h3>
            <p>Mohon lengkapi data dibawah ini</p>
        </div>
        
        <div class="row wow fadeInUp">
        <div class="col-md-3"></div>
        <div class="col-md-6">    
            <div class="form">
              
              <form action="<?php echo base_url() ?>invest/login_proses" method="post" role="form" class="contactFormx">
                <div class="form-row">
                   
                  <div class="form-group col-lg-12 inner-addon left-addon">
                    <i class="fa fa-user"></i>
                     <input type="text" class="form-control" name="email" id="email" placeholder="Alamat Email" data-rule="email" data-msg="Please enter a valid email" />
                  </div>
                  <div class="form-group col-lg-12 inner-addon left-addon">
                    <i class="fa fa-lock"></i>
                   <input type="password" name="password" class="form-control" id="password" placeholder="Password" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                    
                  </div>
                </div>
                
                <div style="text-align:center">
                     
                    <br><br>
                    <a href="<?php echo base_url() ?>invest/forget">Lupa Password?</a>
                    <br><br>
                </div>
                <div class="text-center">
                    <div class="row">
                        <div class="col-md-3">&nbsp;</div>
                        <div class="col-md-6">
                            <button class="btn btn-lg btn-warning btn-block" type="submit" >Masuk</button>
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
            <form id="formgoogle" action="<?php echo base_url() ?>/invest/oauth2callback" method="post">
				<input id="gnama" type="hidden" name="nama" />
				<input id="gemail" type="hidden" name="email" />
				<input id="gid" type="hidden" name="id" />
			</form>

        </div>
        <div class="col-md-3"></div>
        </div>
      </div>
    </section><!-- #team -->
     <?php if($this->session->userdata("invest_username")==""){echo "<br><br><br><br>";}?>
	 
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://apis.google.com/js/api:client.js"></script>
    <script>
      var googleUser = {};
      var startApp = function() {
        gapi.load('auth2', function(){
          // Retrieve the singleton for the GoogleAuth library and set up the client.
          auth2 = gapi.auth2.init({
            client_id: '876775673692-17jdn227d7oq5r8ppe3b099qr1oo7go2.apps.googleusercontent.com',
            cookiepolicy: 'single_host_origin',
            // Request scopes in addition to 'profile' and 'email'
            //scope: 'additional_scope'
          });
          attachSignin(document.getElementById('customBtn'));
        });
      };

      function attachSignin(element) {
        console.log(element.id);
        auth2.attachClickHandler(element, {},
            function(googleUser) {
              onSignIn(googleUser);
              // document.getElementById('name').innerText = "Signed in: " +
              //     googleUser.getBasicProfile().getName();
            }, function(error) {
              alert(JSON.stringify(error, undefined, 2));
            });
      }
      function onSignIn(googleUser) {
        signOut();

        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
        var url_login  = "<?php echo base_url() ?>Invest/oauth2callback";
		$("#gnama").val(profile.getName());
		$("#gemail").val(profile.getEmail());
		$("#gid").val(profile.getId());
		$("#formgoogle").submit();
        //Gunakan jquery AJAX
        /* $.ajax({
          url   : url_login,
          //mengirimkan username dan password ke script login.php
          data  : {
                nama:  profile.getName(),
                email: profile.getEmail(),
                id: profile.getId()
          }, 
          //Method pengiriman
          type  : 'POST',
          //Data yang akan diambil dari script pemroses
          dataType: 'html',
          //Respon jika data berhasil dikirim
          success : function(pesan){
            window.location.reload();
          },
        }); */
      }


    function signOut() {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function () {
        console.log('User signed out.');
      });
    }
    startApp();
    </script>

 