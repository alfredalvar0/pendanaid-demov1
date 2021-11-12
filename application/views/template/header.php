<style type="text/css">
  iframe#\:1\.container {
    display: none !important;
}
iframe#\:0\.container {
    display: none;
}
a.goog-logo-link {
    display: none;
}
</style>
<?php
$wh = array("kategori"=>"header");
$dataheader = $this->m_invest->getPage($wh);



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
<header id="header">
  <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top py-2 py-lg-4">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url(); ?>">
      <img src="<?= base_url() ?>assets/img/investpro.png" style="width:150px; " />
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse navigation" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <?php foreach($dataheader->result() as $dth) { 
            if($dth->judul!="Portofolio Saya" && $dth->status_delete ==0 && $dth->judul!="Daftar Jadi Investor") { ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url(); ?><?= $dth->link_page; ?>"><?= $dth->judul; ?></a>
            </li>
            <?php } }
          ?>
        </ul>

        <div id="google_translate_element_mob"></div>

        <!-- Mobile Buttons -->
        <div class="d-block d-lg-none">
          <a href="<?= base_url(); ?>invest/login" class="btn btn-outline-blue px-4 py-2 mr-2 btn-block">Masuk</a>
          <a href="<?= base_url(); ?>invest/register" class="custom_btn-blue btn-block">Daftar</a>
        </div>

        <!-- Desktop Buttons -->
        <div class="d-none d-lg-block">
          <a href="<?= base_url(); ?>invest/login" class="btn btn-outline-blue px-4 py-2 mr-2">Masuk</a>
          <a href="<?= base_url(); ?>invest/register" class="custom_btn-blue">Daftar</a>
        </div>
      </div>
    </div>
  </nav>
<header>