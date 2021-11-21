<?php
  $login_url = $this->facebook->login_url();
  $google_login_url = $this->google->get_login_url();
?>

<section class="register-1">
  <div class="container py-5">
    <div class="row">
      <div class="col-md-8 col-lg-6 mx-auto">
        <div class="card card-body border-0 shadow">
          <h1 class="text-center mb-2 font-red-hat-display">Daftar Akun Investasi</h1>
          <p class="text-grey text-center font-red-hat-display">Mohon Lengkapi Data Dibawah Ini</p>
    
          <?php if($this->session->flashdata("msg")!="") { ?>
            <p>
              <?php echo $this->session->flashdata("msg"); ?>
              </p>
          <?php } ?>

          <form action="<?= base_url(); ?>invest/role_choice" method="post" role="form" class="mt-3">
            <div class="form-group">
              <label for="email" class="font-weight-bold">Alamat Email</label>
              <input type="email" class="form-control" placeholder="example@gmail.com" name="user_reg" id="email" placeholder="Alamat Email" data-rule="email" data-msg="Please enter a valid email" required />
            </div>
            <div class="form-group">
              <label for="password" class="font-weight-bold">Password</label>
              <input type="password" name="pass_reg" class="form-control" id="password" placeholder="Password" data-rule="minlen:4" data-msg="Please enter at least 4 chars" required />
            </div>
            <div class="form-group">
              <label for="confirm_password" class="font-weight-bold">Konfirmasi Password</label>
              <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Konfirmasi Password Anda" data-rule="minlen:4" data-msg="Please enter at least 4 chars" required />
            </div>

            <div class="btn-wrapper mt-4">
              <button type="submit" class="btn custom_btn-blue btn-block">Daftar</button>
            </div>

            <p class="text-center text-grey my-3">Sudah Punya Akun? <a href="<?= base_url(); ?>invest/login" class="font-weight-bold text-blue">Masuk</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<form id="formgoogle" action="<?php echo base_url() ?>/invest/oauth2callback" method="post">
  <input id="gnama" type="hidden" name="nama" />
  <input id="gemail" type="hidden" name="email" />
  <input id="gid" type="hidden" name="id" />
</form>

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