<head>
  <meta charset="utf-8">
  <title>Pendana Usaha</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php 

    $page_uri = $_SERVER['REQUEST_URI'];
    $data_meta = $this->db->select('a.*')
                          ->from('tbl_meta_detail a')
                          ->join('tbl_meta_header b', 'a.id_header = b.id', 'inner')
                          ->where('page_uri', $page_uri)
                          ->get();

    foreach ($data_meta->result() as $val) {
      echo "<meta name='".$val->name."' content='".$val->content."'>";
    }

  ?>


  <meta content="" name="keywords">
  <meta content="" name="description">
  <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="876775673692-17jdn227d7oq5r8ppe3b099qr1oo7go2.apps.googleusercontent.com">
  <meta name="google-site-verification" content="nnLpqOgYUjhXMDiIw8xjk1uQViyUKSq4MvcHuF13nj8">
  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/favicon/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/favicon/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="<?= base_url(); ?>assets/favicon/site.webmanifest">

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet"> -->

  <!-- Bootstrap CSS File -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
  <link href="<?php echo base_url(); ?>assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
  <link href="<?php echo base_url(); ?>assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet"> 
  
  <link href="<?= base_url(); ?>assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css" rel="stylesheet">
  <!-- <link href="<?php echo base_url(); ?>assets/lib/animate/animate.min.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo base_url(); ?>assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo base_url(); ?>assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet"> -->
  <link href="<?php echo base_url(); ?>assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/vendor/metismenu/dist/metisMenu.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/layouts/vertical/core/main.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/layouts/vertical/menu-type/default.css" rel="stylesheet">
  
  <!-- Main Stylesheet File -->
  <link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/lib/dropify/css/dropify.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/showToolTip.css" rel="stylesheet">
  <link href='<?php echo base_url(); ?>assets/css/form-material.css' rel='stylesheet' type='text/css'>
  
  <!--sweetalert2@10-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <style type="text/css">
    #preloader {
      opacity: 80%;
    }
  </style>

  <!-- Facebook Pixel Scripts -->
  <script defer>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1221240094954942');
    fbq('track', 'PageView');
    </script>
  <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1221240094954942&ev=PageView&noscript=1"
    />
  </noscript>

  <!-- Google Analytics Script -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-46P6NHMHCT"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-46P6NHMHCT');
  </script>



</head>
<!-- <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({ includedLanguages: "id,en" }, 'google_translate_element');
        }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>  -->