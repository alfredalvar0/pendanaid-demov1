<div class="modal fade" id="konfirmasiHapus" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
	      <h3 style="display:block; text-align:center;">Apakah Anda Yakin Hapus Data Ini ?</h3>
	      
	      <div class="col-md-6">
	        <button class="form-control btn btn-primary hapus-dataReferralmanagement"> <i class="glyphicon glyphicon-ok-sign"></i> Ya</button>
	      </div>
	      <div class="col-md-6">
	        <button class="form-control btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Tidak</button>
	      </div>
	      
	    </div>
    </div>
  </div>
</div>
<script>
  	window.onload = function(){
  		tampilReferralmanagement();
  		<?php
			if ($this->session->flashdata('msg') != '') {
				echo "effect_msg();";
			}
		?>
  	}

  	function refresh() {
			table = $('#list-data-ref-mng').DataTable({
				"responsive": true
			});
			table.destroy();
			table = $('#list-data-ref-mng').DataTable({
				"responsive": true
			});
		}

	function effect_msg_form() {
		// $('.form-msg').hide();
		$('.form-msg').show(1000);
		setTimeout(function() { $('.form-msg').fadeOut(1000); }, 3000);
	}

	function effect_msg() {
		// $('.msg').hide();
		$('.msg').show(1000);
		setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
	}

	// Film
	function tampilReferralmanagement() {
		$.get('<?php echo base_url('Referralmanagement/tampil'); ?>', function(data) {
			$('#list-data-ref-mng').dataTable().fnDestroy();
			$('#data-referral-mng').html(data);
			refresh();
		});
	}

	var id_referral;
	$(document).on("click", ".konfirmasiHapus-referral", function() {
		id_referral = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataReferralmanagement", function() {
		var id = id_referral;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Referralmanagement/delete'); ?>",
			data: "id=" +id
		})
		// alert(id)
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilReferralmanagement();
			$('.msg').html(data);
			effect_msg();
		})
	})
	
</script>