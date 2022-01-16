<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dana Invest
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dana Invest</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">


			<div class="col-md-12">
				<!-- /.box -->

				  <div class="box">
					<div class="box-header text-center">
					  	<h3>Dana Invest</h3>
							<div class="col-md-2" style="text-align: left;">

	                <!-- <a>
	                	<button onclick="export2csv()" class="form-control btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Export</button>
	                </a> -->
	            </div>
					</div>
					<div class="box-header">
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										<label>Search</label>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-6">
                        <div class="form-group row">
											    <label for="inputPassword" class="col-sm-3 col-form-label">Status Approve</label>
											    <div class="col-sm-9">
											      <select class="form-control" id="search_status_approve" name="search_status_approve">
											      	<option value="">-- All Status Approve --</option>
											      	<option value="approve">Approve</option>
											      	<option value="pending">Pending</option>
											      	<option value="cancel">Cancel</option>
											      	<option value="refuse">Refuse</option>
											      </select>
											    </div>
											  </div>
											  <div class="form-group row">
											    <label for="inputPassword" class="col-sm-3 col-form-label">Produk</label>
											    <div class="col-sm-9">
											      <input type="text" class="form-control" id="search_produk" name="search_produk" placeholder="All Produk">
											    </div>
											  </div>
											</div>
											<div class="col-md-6">
												<div class="form-group row">
											    <label for="staticEmail" class="col-sm-3 col-form-label">User</label>
											    <div class="col-sm-9">
											      <input type="text" class="form-control" id="search_user" name="search_user" placeholder="All User">
											    </div>
											  </div>
											</div>
										</div>
									</div>
									<div class="panel-footer" style="text-align: right;">
										<button class="btn btn-primary" id="btn_search">Search</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive">
						<div class="panel panel-default">
							<div class="panel-heading">
								<button type="button" class="btn btn-primary" onclick="showModal()">
		              Export Data
		            </button>
							</div>
							<div class="panel-body">
							  <table id="list-dana" class="table table-hover dataTable table-custom table-striped table-bordered nowrap dataTable dtr-inline">
								<thead>
								  <tr>
									<th>ID</th>
									<th>Jumlah Dana</th>
									<th>Tipe</th>
									<th>Lembar Saham</th>
									<th>Produk Invest</th>
									<th>User</th>
									<th>Status Approve</th>
									<th>Tanggal</th>
									<th>Action</th>
								  </tr>
								</thead>
								<tbody >

								</tbody>
							  </table>
							</div>
						</div>
					</div>
					<div style="display: none;">
						<table id="csv_table" class="table table-hover dataTable table-custom table-striped table-bordered nowrap dataTable dtr-inline">
						<thead>
						  <tr>
							<th>ID</th>
							<th>Jumlah Dana</th>
							<th>Tipe</th>
							<th>Lembar Saham</th>
							<th>Produk Invest</th>
							<th>User</th>
							<th>Status Approve</th>
							<th>Tanggal</th>
							<th>Action</th>
						  </tr>
						</thead>
						<tbody >

						</tbody>
					  </table>
					</div>
					<!-- /.box-body -->
				  </div>
				  <!-- /.box -->
			<div>
	  <div>

    </section>
    <!-- /.content -->
  </div>

  <!-- Modal -->
	<div class="modal fade" id="modalOptionDownload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel"><b>Export Data</b></h5>
	      </div>
	      <div class="modal-body">
	        <form action="DanaInvest/generateReport" method="post">
	      	<label>Periode Report :</label>
	      	<div class="row">
	      		<div class="col-md-6">
	      			<input type="date" class="form-control" name="report_from">
	      		</div>
	      		<div class="col-md-6">
	      			<input type="date" class="form-control" name="report_until">
	      		</div>
	      	</div>
	      	<br>
	        <label>Please select additional info to show in your report :</label>
	        	<input type="hidden" id="s_tipe" name="s_tipe">
	        	<input type="hidden" id="s_produk" name="s_produk">
	        	<input type="hidden" id="s_user" name="s_user">
	        	<input type="hidden" id="s_status" name="s_status">

            <div class="row">
              <?php foreach ($additional_info as $k => $adinfo): ?>
                <div class="col-md-4">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="additional_info[]" value="<?= $k ?>" checked>
                    <label class="form-check-label" for="exampleCheck1"><?= $adinfo ?></label>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
	          <button type="submit" class="btn btn-primary">Download Report</button>
	        </div>
	        </form>
	    </div>
	  </div>
	</div>


  <script type="text/javascript">

  	function showModal() {
  		var s_tipe = $('#search_tipe').val();
  		var s_user = $('#search_user').val();
  		var s_produk = $('#search_produk').val();
  		var s_status = $('#search_status_approve').val();


  		$('#s_tipe').val(s_tipe);
  		$('#s_user').val(s_user);
  		$('#s_produk').val(s_produk);
  		$('#s_status').val(s_status);

  		$('#modalOptionDownload').modal('show');
  	}

  	function closeModal() {
  		$('#s_tipe').val('');
  		$('#s_user').val('');
  		$('#s_produk').val('');
  		$('#s_status').val('');
  		$('#report_form').val('');
  		$('#report_until').val('');

  		$('#modalOptionDownload').modal('hide');
  	}
  </script>
  <script src="<?php echo base_url(); ?>assets/admin/dist/js/pages/dashboard.js"></script>

  <script>
  	$(document).ready(function () {

  		var dataTable = $('#list-dana').DataTable( {
				"serverSide": true,
				"processing": true,
				"ajax": {
					url: "<?= base_url() ?>DanaInvest/list_data",
					type: 'post',
					data: function (data) {
						var tipe= $('#search_tipe').val();
						var produk= $('#search_produk').val();
						var user= $('#search_user').val();
						var status_approve= $('#search_status_approve').val();
            var id_produk = <?= $idproduk ?>

						data.tipe = tipe;
						data.produk = produk;
						data.user = user;
						data.status_approve = status_approve;
            data.id_produk = id_produk;
					}
				},
				"order": [[ 0, "desc" ]],
				"searching": false,
				"lengthChange": false,
				"columns": [
	          { "data": 'id_dana'},
	          { "data": "jumlah_dana" }, // Tampilkan judul
	          { "data": "type_dana" },  // Tampilkan kategori
	          { "data": "lembar_saham" },  // Tampilkan penulis
	          { "data": "judul" },  // Tampilkan tgl posting
	          { "data": "username"},
	          { "data": "status_approve"},
	          { "data": "createddate"},
	          { "data": "action"},
	      ],
			} );

  		// renderData();

  		$('#btn_search').click(function () {

  			console.log($('#search_tipe').val());

  			dataTable.draw();
  		})
  	})

		function renderData() {

		}
  </script>
