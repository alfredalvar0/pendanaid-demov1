<?php

$useragent = $_SERVER['HTTP_USER_AGENT'];
$ismobile = false;

//cek perangkat
$iPod = stripos($useragent, "iPod"); 
$iPad = stripos($useragent, "iPad"); 
$iPhone = stripos($useragent, "iPhone");
$Android = stripos($useragent, "Android"); 
$iOS = stripos($useragent, "iOS");
$DEVICE = ($iPod||$iPad||$iPhone||$Android||$iOS);
//cek perangkat

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))
    && ($DEVICE=true) 
  )
{
   $ismobile = true; 
}

?>
<head>
  <meta charset="utf-8">
  <title>Pendana Usaha</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="876775673692-17jdn227d7oq5r8ppe3b099qr1oo7go2.apps.googleusercontent.com">
  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/favicon/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/favicon/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="<?= base_url(); ?>assets/favicon/site.webmanifest">

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet"> -->

  <!-- Bootstrap CSS File -->
  <!-- <link href="<?php echo base_url(); ?>assets/lib/aos/css/aos.css" rel="stylesheet">  -->
  <link href="<?php echo base_url(); ?>assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet"> 

  <!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

  <!-- Libraries CSS Files -->
  <link href="<?php echo base_url(); ?>assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet"> 
  <!-- <link href="<?php echo base_url(); ?>assets/lib/fontawesome/css/fontawesome.min.css" rel="stylesheet"> -->
  
  <link href="<?= base_url(); ?>assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/lib/animate/animate.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/vendor/metismenu/dist/metisMenu.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/layouts/vertical/core/main.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/layouts/vertical/menu-type/default.css" rel="stylesheet">
  
  <!-- <link href="<?php echo base_url(); ?>assets/css/icons/dripicons.min.css" rel="stylesheet"> -->
  <!-- Main Stylesheet File -->
  <link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/lib/dropify/css/dropify.min.css" rel="stylesheet">
  <?php
  if($this->session->userdata("invest_username")!="" && $this->session->userdata("invest_email")!=""){
      if(!$ismobile){
  ?>
  <link href="<?php echo base_url(); ?>assets/css/sidebar.css" rel="stylesheet">
  <?php
      }
  }
  ?>
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
  <script>
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