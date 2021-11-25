<!-- Uncomment below i you want to use a preloader -->
<div id="preloader" class="" ></div>

<!-- JavaScript Libraries -->
<script src="<?php echo base_url(); ?>assets/lib/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/jquery/jquery-migrate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/easing/easing.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/mobile-nav/mobile-nav.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/wow/wow.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/waypoints/waypoints.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/counterup/counterup.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/isotope/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/lightbox/js/lightbox.min.js"></script>
<!-- Contact Form JavaScript File -->
<script src="<?php echo base_url(); ?>assets/contactform/contactform.js"></script>
<!-- 
<script src="<?php echo base_url(); ?>assets/js/miniPopup.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.popupoverlay.js"></script>
-->
<script src="<?php echo base_url(); ?>assets/js/showToolTip.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/fontawesome/js/fontawesome.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/dropify/js/dropify.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootbox.all.js"></script>
<!-- Template Main Javascript File -->
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
<script>
	<?php
	if($this->session->flashdata("msg")!=""){
		?>
		$(function(){
			bootbox.alert(`<?php echo $this->session->flashdata('msg') ?>`);
		});
		<?php
	}
	?>
	function hanyaAngka(evt) {
	  var charCode = (evt.which) ? evt.which : event.keyCode
	   if (charCode > 31 && (charCode < 48 || charCode > 57))

	    return false;
	  return true;
	}
	function hanyaHuruf(e) {
        return (e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || e.charCode == 32;   
    }
</script>