<!DOCTYPE HTML>
<html>
    <head>
    	<meta http-equiv="content-type" content="text/html" />
    	<meta name="author" content="lolkittens" />

    	<title>Untitled 1</title>
        <?php //$this->load->view('template/head'); ?>
        <?php //$this->load->view('hr/hr-mail-style');
            $url = "invest";

            if (isset($foradmin)) {
                $url = "admin";
            }
        ?>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php //echo $mailserver->mail_header; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <h2><?php echo $mailtitle; ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <div class="alert alert-primary">
                        <h4>Hi, <?php echo $email; ?>.</h4>
						            <p>
                          <?= $nama_bisnis ?> telah membuat laporan bisnis terbaru pada tanggal <?= $tgl_laporan ?>. <br>
                          Berikut detail laporannya : <br>
                          <ul>
                            <li>Laba : Rp. <?= number_format($laba) ?></li>
                            <li>Rugi : Rp. <?= number_format($rugi) ?></li>
                            <li>Dividen : <?= number_format($dividen) ?>%</li>
                            <li>Dividen Gadai : <?= number_format($dividen_gadai) ?>%</li>
                          </ul>
                        </p>
                        <h5>Regards,<br />Pendana Usaha</h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php //echo $mailserver->mail_footer; ?>
                </div>
            </div>
        </div>
    </body>
</html>
