<!DOCTYPE HTML>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html" />
    <meta name="author" content="lolkittens" />
  
    <title>Untitled</title>
  </head>
  
  <body>
    <div class="container">
      <div class="row">
        <div class="col-12">&nbsp;</div>
      </div>
      <div class="row">
        <div class="col-12">
          <?php // space for header ?>
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center">
          <h2><?php echo $title; ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center">
          <div class="alert alert-primary">
            <h4>
              Hi <?php echo $username; ?>,
              <br/>
              Selamat, transaksi anda di pasar sekunder <b>berhasil</b> dengan rincian sebagai berikut:
            </h4>
            <p><?php echo $detail; ?></p>
            <h5>
              Regards,
              <br />
              Pendana Usaha
          </h5>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <?php // space for footer ?>
        </div>
      </div>
    </div>
  </body>
</html>
