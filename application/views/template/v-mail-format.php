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
                        <h4>Hi, <?php echo $email; ?>. Anda akan melakukan reset password</h4>
						<p>Klik Link Berikut untuk melakukan reset password</p>
						<a href="<?php echo base_url(); ?><?= $url ?>/resetpass/<?php echo $resetkey; ?>">Reset</a>
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