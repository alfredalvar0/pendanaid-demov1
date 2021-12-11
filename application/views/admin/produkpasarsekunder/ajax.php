<div class="modal fade" id="konfirmasiHapus" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
	      <h3 style="display:block; text-align:center;">Apakah Anda Yakin Hapus Data Ini ?</h3>
	      
	      <div class="col-md-6">
	        <button class="form-control btn btn-primary hapus-dataProduk"> <i class="glyphicon glyphicon-ok-sign"></i> Ya</button>
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
		tampilProduk();
		<?php
			if ($this->session->flashdata('msg') != '') {
				echo "effect_msg();";
			}
		?>
	}

	function refresh() {
		$('#list-data').DataTable({
			"responsive":true
		});
	}

	function effect_msg_form() {
		$('.form-msg').show(1000);
		setTimeout(function() { $('.form-msg').fadeOut(1000); }, 3000);
	}

	function effect_msg() {
		$('.msg').show(1000);
		setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
	}

	function tampilProduk() {
		$.get('<?php echo base_url('ProdukPasarSekunder/tampil'); ?>', function(data) {
			$('#list-data').dataTable().fnDestroy();
			$('#data-produk').html(data);
			refresh();
		});
	}
	
</script>