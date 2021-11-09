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
  <link href="<?php echo base_url(); ?>assets/img/investpro-sm.png" rel="icon">
  <link href="<?php echo base_url(); ?>assets/img/investpro-sm.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?php echo base_url(); ?>assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

  <!-- Libraries CSS Files -->
  <link href="<?php echo base_url(); ?>assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet"> 
  <!-- <link href="<?php echo base_url(); ?>assets/lib/fontawesome/css/fontawesome.min.css" rel="stylesheet"> -->
  
  <link href="<?php echo base_url(); ?>assets/lib/animate/animate.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
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


    .tooltip{
      z-index: 1000;
      word-break: break-word;
      box-shadow: 0 0 16px 4px rgba(0,0,0, .3);
      position: absolute;
      font-family: Arial;
      text-align: center;
      color: white;
      border-radius: 5px;
      width: 300px;
      overflow: hidden;
      opacity: 0;
    }
    
    .tooltip-content {
      background-color: rgba(58,186,111, .9);
      padding: 20px;
    }
    
    .tooltip-header {
      font-size: 30px;
      margin-bottom: 10px;
    }
    
    .tooltip-body {
      font-size: 13px;
    }
    
    .tooltip-action {
     background-color: rgba(255,255,255, .9);
    }
    
    .tooltip-btn {
      background-color: rgba(58,186,111, .9);
      padding: 9px 20px;
      border: none;
      outline: none;
      border-radius: 4px;
      color: white;
      margin: 10px 0;
      cursor: pointer;
      font-size: 13px;
    }
    
    .tooltip-btn:hover{
      transition: all .2s;
      background-color: rgba(34,139,34, .9);
    }


    #card-product{
      border: 0;
    }

    #card-product:hover{
      box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
    }


    #header a {
      color: #0068b1;
    }

    #header a:hover {
      color: #68B100;
    }

    #header {
      background-color: white;
      box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.3);
    }

    #footer {

      background-color: white;
    }

    @media (max-width: 991px) {
      
      #memberArea {
        float: none;
      }

      #memberArea li a {
        width: 100%;
        left: 1em;
        bottom: 2em;
        text-align: center;
      }
      

      .logolegal {
        width: 20% !important;
      }

      .logosupport {
        width: 15% !important;
      }

    }




    

      
  </style>

</head>
<script type="text/javascript">
    // var txt = document.getElementsByClassName('skiptranslate').innerText;
    // console.log(txt);
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({ includedLanguages: "id,en" }, 'google_translate_element');
        }
        // document.body.innerText = document.body.innerText.replace('Powered by', '');
 </script>
 <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> 