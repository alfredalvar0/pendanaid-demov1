<!DOCTYPE HTML>
<html>
    <head>
    	<meta http-equiv="content-type" content="text/html" />
    	<meta name="author" content="lolkittens" />
    
    	<title>Untitled 1</title>
        <?php //$this->load->view('template/head'); ?>
        <?php //$this->load->view('hr/hr-mail-style'); ?>
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
                        <h4>Hi, <?php echo $email; ?>,
						<br/>
						Terima kasih atas pengajuan verifikasi data anda</h4>
						<p>Namun mohon maaf, verifikasi anda gagal karena:
							<br/>
							<b><?php echo $remark; ?></b>
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
