<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("template/head");?>

<body>
  <?php if($this->session->userdata("invest_username")!="" && $this->session->userdata("invest_email")!=""){ 
    if(strtolower($this->router->fetch_class()) == "investor") {
      if(strtolower($this->router->fetch_method()) == "dokumen_saya" ||
        strtolower($this->router->fetch_method()) == "agreement" ||
        strtolower($this->router->fetch_method()) == "perjanjiananggota" ||
        strtolower($this->router->fetch_method()) == "perjanjianpinjaman" ||
        strtolower($this->router->fetch_method()) == "laporanbisnis" ||
        strtolower($this->router->fetch_method()) == "laporanjual" ||
        strtolower($this->router->fetch_method()) == "jual" ||
        strtolower($this->router->fetch_method()) == "proyeksi" ||
        strtolower($this->router->fetch_method()) == "kode_referral" ||
        strtolower($this->router->fetch_method()) == "bank_account" ||
        strtolower($this->router->fetch_method()) == "evote" ||
        strtolower($this->router->fetch_method()) == "erups" ||
        strtolower($this->router->fetch_method()) == "laporanhistory") {} 
        else {
          $this->load->view("template/header_investor");
        }
      } else {
        $this->load->view("template/header_investor");
      }
    } else {
      if(strtolower($this->router->fetch_class()) == "invest") {
        if(strtolower($this->router->fetch_method()) != "login" &&
        strtolower($this->router->fetch_method()) != "role_choice" &&
        strtolower($this->router->fetch_method()) != "login_choice" &&
        strtolower($this->router->fetch_method()) != "register_choice" &&
        strtolower($this->router->fetch_method()) != "register") {
          $this->load->view("template/header");
        }
      } else {
          $this->load->view("template/header");
      }
    }
  ?>
  
  <main id="main">
  <?php 
    $this->load->view("template/foot");
    echo $content;
  ?>

  </main>
  <?php
    if($this->session->userdata("invest_username") !="" && $this->session->userdata("invest_email") !=""){
      if(strtolower($this->router->fetch_class()) == "investor") {
        if(strtolower($this->router->fetch_method()) == "dokumen_saya" ||
        strtolower($this->router->fetch_method()) == "agreement" ||
        strtolower($this->router->fetch_method()) == "perjanjiananggota" ||
        strtolower($this->router->fetch_method()) == "perjanjianpinjaman" ||
        strtolower($this->router->fetch_method()) == "laporanbisnis" ||
        strtolower($this->router->fetch_method()) == "laporanjual" ||
        strtolower($this->router->fetch_method()) == "jual" ||
        strtolower($this->router->fetch_method()) == "proyeksi" ||
        strtolower($this->router->fetch_method()) == "kode_referral" ||
        strtolower($this->router->fetch_method()) == "bank_account" ||
        strtolower($this->router->fetch_method()) == "evote" ||
        strtolower($this->router->fetch_method()) == "erups" ||
        strtolower($this->router->fetch_method()) == "laporanhistory") {} 
        else {
          $this->load->view("template/footer");
        }
      } else {
        $this->load->view("template/header_investor");
      }
    } else {
      if(strtolower($this->router->fetch_class()) == "invest") {
        if(strtolower($this->router->fetch_method()) != "login" &&
          strtolower($this->router->fetch_method()) != "role_choice" &&
          strtolower($this->router->fetch_method()) != "login_choice" &&
          strtolower($this->router->fetch_method()) != "register_choice" &&
          strtolower($this->router->fetch_method()) != "register") {
            $this->load->view("template/footer");
        }
      } else {
          $this->load->view("template/footer");
      }
    } ?>

  <script>
    <?php 
    $msg = $this->session->flashdata('message');
    if($msg=="success"){?>
    Swal.fire( 'Sukses', 'Proses berhasil!',  'success' );
    <?php }else if($msg=="failed"){?>
    Swal.fire( 'Gagal', 'Proses gagal!',  'error' );
    <?php }else if($msg=="failed_saldo"){?>
    Swal.fire( 'Gagal', 'Saldo anda tidak cukup!',  'error' );
    <?php } ?>
  </script>

</body>
</html>