<style type="text/css">   
.card {
    border: none !important;
}
/**Styling scrollable elements*/

.js-scroll {
  opacity: 0;
  transition: opacity 500ms;
}
.js-scroll.scrolled {
  opacity: 1;
}
.scrolled.fade-in {
  animation: fade-in 1s ease-in-out both;
}
.scrolled.fade-in-bottom {
  animation: fade-in-bottom 1s ease-in-out both;
}
.scrolled.slide-left {
  animation: slide-in-left 1s ease-in-out both;
}
.scrolled.slide-right {
  animation: slide-in-right 1s ease-in-out both;
}

/* ----------------------------------------------
 * Generated by Animista on 2021-2-11 23:32:31
 * Licensed under FreeBSD License.
 * See http://animista.net/license for more info. 
 * w: http://animista.net, t: @cssanimista
 * ---------------------------------------------- */

@keyframes slide-in-left {
  0% {
    -webkit-transform: translateX(-100px);
    transform: translateX(-100px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateX(0);
    transform: translateX(0);
    opacity: 1;
  }
}
@keyframes slide-in-right {
  0% {
    -webkit-transform: translateX(100px);
    transform: translateX(100px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateX(0);
    transform: translateX(0);
    opacity: 1;
  }
}
@keyframes fade-in-bottom {
  0% {
    -webkit-transform: translateY(50px);
    transform: translateY(50px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateY(0);
    transform: translateY(0);
    opacity: 1;
  }
}
@keyframes fade-in {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
span font font {
    font-size: 16px !important;
    font-weight: 700 !important;
}
p span span, li span {
    font-size: 14px !important;
    font-weight: 500 !important;
}
</style>

<?php if($data_page->judul == 'Cara Investasi'): ?>
<style type="text/css">
    @media only screen and (min-width: 1010px) {

        .card-body {
            display: flex !important;
        }
        .card-body p {
            display: contents !important;
        }

    }
</style>
<?php endif ?>
<br><br><br><br><br>
<section id="team" class="mb-5">
  <div class="container">
    <div class="section">
      <div id="page_details" class="row mt-5 scroll-element js-scroll fade-in-bottom">
          <div class="col-12">
            <div class="card px-4 bg-transparent">
              <h3 class="font-weight-bold mb-5 px-4"><?php echo $data_page->judul; ?></h3>
            </div>
          </div>
          <div class="col-12">
            <div class="card px-4">
              <div class="card-body">
                <?php echo $data_page->content; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {  
    var result = $("#page_details").offset().top;
    var text = result - 400;
        var scroll = $(window).scrollTop();
        if (scroll >= text) {
            $("#page_details").addClass("scrolled");
        }else{
            $("#page_details").removeClass("scrolled");
        }
    });
</script>