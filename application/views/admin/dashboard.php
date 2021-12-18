<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel admin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <h1>
        Welcome To Invest admin
      </h1>
	  <?php
			if($pendingVerif>0)
			{
		?>
	  <div class="box box-warning col-md-12 bg-yellow">
	  	<h4 class="text-black">Notifikasi: <a class="text-black" href="<?php echo site_url('Akun/verifikasi'); ?>"> <b><?php echo $pendingVerif; ?></b> Verifikasi Pengguna</a></h4>
	  </div>
	  <?php
			}
		?>


	  <br/>
	  <br/>
      <div class="row">
	  		

			<div class="col-md-12">
				<!-- /.box -->

				  <div class="box">
					<div class="box-header text-center">
					  	<h3>History Transaksi</h3>
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
											    <label for="staticEmail" class="col-sm-3 col-form-label">Tipe</label>
											    <div class="col-sm-9">
											      <select class="form-control" id="search_tipe" name="search_tipe">
											      	<option value="">-- All Tipe --</option>
											      	<option value="tambah">Tambah</option>
											      	<option value="tarik">Tarik</option>
											      	<option value="beli">Beli</option>
											      	<option value="gadai">Gadai</option>
											      	<option value="jual">Jual</option>
											      	<option value="tebus">Tebus</option>
											      	<option value="dividen">Dividen</option>
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
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalOptionDownload">
		              Export Data
		            </button>
							</div>
							<div class="panel-body">
							  <table id="list-data-dana" class="table table-hover dataTable table-custom table-striped table-bordered nowrap dataTable dtr-inline">
								<thead>
								  <tr> 
									<th>ID</th> 
									<th>Jumlah Dana</th>
									<th>Tipe</th>
									<th>Lembar Saham</th>
									<th>Produk</th>
									<th>User</th>
									<th>Status Approve</th>
									<th>Tanggal</th> 
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
							<th>Produk</th>
							<th>User</th>
							<th>Status Approve</th>
							<th>Tanggal</th> 
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
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="generateReport" method="post">
	      	<label>Periode Report :</label>
	      	<div class="row">
	      		<div class="col-md-6">
	      			<input type="date" class="form-control" name="report_from" required>
	      		</div>
	      		<div class="col-md-6">
	      			<input type="date" class="form-control" name="report_until" required>
	      		</div>
	      	</div>
	      	<br>
	        <label>Please select field to show in your report :</label>
	        	
	          <div class="form-check">
	            <input class="form-check-input" type="checkbox" id="fieldList_id" name="fieldList[]" checked="true" value="id">
	            <label class="form-check-label" for="defaultCheck1">
	              ID
	            </label>
	          </div>
	          <div class="form-check">
	            <input class="form-check-input" type="checkbox" id="fieldList_jumlahdana" name="fieldList[]" checked="true" value="jumlahdana">
	            <label class="form-check-label" for="defaultCheck1">
	              Jumlah Dana
	            </label>
	          </div>
	          <div class="form-check">
	            <input class="form-check-input" type="checkbox" id="fieldList_tipe" name="fieldList[]" checked="true" value="tipe">
	            <label class="form-check-label" for="defaultCheck1">
	              Tipe
	            </label>
	          </div>
	          <div class="form-check">
	            <input class="form-check-input" type="checkbox" id="fieldList_lembarsaham" name="fieldList[]" checked="true" value="lembarsaham">
	            <label class="form-check-label" for="defaultCheck1">
	              Lembar Saham
	            </label>
	          </div>
	          <div class="form-check">
	            <input class="form-check-input" type="checkbox" id="fieldList_produkinvest" name="fieldList[]" checked="true" value="produkinvest">
	            <label class="form-check-label" for="defaultCheck1">
	              Produk
	            </label>
	          </div>
	          <div class="form-check">
	            <input class="form-check-input" type="checkbox" id="fieldList_user" name="fieldList[]" checked="true" value="user">
	            <label class="form-check-label" for="defaultCheck1">
	              User
	            </label>
	          </div>
	          <div class="form-check">
	            <input class="form-check-input" type="checkbox" id="fieldList_user" name="fieldList[]" checked="true" value="nama">
	            <label class="form-check-label" for="defaultCheck1">
	              Nama Lengkap
	            </label>
	          </div>
	          <div class="form-check">
	            <input class="form-check-input" type="checkbox" id="fieldList_user" name="fieldList[]" checked="true" value="nik">
	            <label class="form-check-label" for="defaultCheck1">
	              NIK
	            </label>
	          </div>
	          <div class="form-check">
	            <input class="form-check-input" type="checkbox" id="fieldList_user" name="fieldList[]" checked="true" value="no_hp">
	            <label class="form-check-label" for="defaultCheck1">
	              Nomor HP
	            </label>
	          </div>
	          <div class="form-check">
	            <input class="form-check-input" type="checkbox" id="fieldList_user" name="fieldList[]" checked="true" value="email">
	            <label class="form-check-label" for="defaultCheck1">
	              Email
	            </label>
	          </div>
	          <div class="form-check">
	            <input class="form-check-input" type="checkbox" id="fieldList_statusapprove" name="fieldList[]" checked="true" value="statusapprove">
	            <label class="form-check-label" for="defaultCheck1">
	              Status Approve
	            </label>
	          </div>
	          <div class="form-check">
	            <input class="form-check-input" type="checkbox" id="fieldList_tanggal" name="fieldList[]" checked="true" value="tanggal">
	            <label class="form-check-label" for="defaultCheck1">
	              Tanggal
	            </label>
	          </div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	          <button type="submit" class="btn btn-primary">Download Report</button>
	        </div>
	        </form>
	    </div>
	  </div>
	</div>


  <script type="text/javascript">
  	function export2csv() {
  let data = "";
  const tableData = [];
  const rows = document.querySelectorAll("#csv_table tr");
  for (const row of rows) {
    const rowData = [];
    for (const [index, column] of row.querySelectorAll("th, td").entries()) {
      // To retain the commas in the "Description" column, we can enclose those fields in quotation marks.
      if ((index + 1) % 3 === 0) {
        rowData.push('"' + column.innerText + '"');
      } else {
        rowData.push(column.innerText);
      }
    }
    tableData.push(rowData.join(","));
  }
  data += tableData.join("\n");
  const a = document.createElement("a");
  a.href = URL.createObjectURL(new Blob([data], { type: "text/csv" }));
  a.setAttribute("download", "Transaksi.csv");
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
}
  </script>
  <script src="<?php echo base_url(); ?>assets/admin/dist/js/pages/dashboard.js"></script>

  <script>
  	$(document).ready(function () {

  		var dataTable = $('#list-data-dana').DataTable( {
				"serverSide": true,
				"processing": true,
				"ajax": {
					url: "<?= base_url() ?>Admin/list_data",
					type: 'post',
					data: function (data) {
						var tipe= $('#search_tipe').val();
						var produk= $('#search_produk').val();
						var user= $('#search_user').val();
						var status_approve= $('#search_status_approve').val();

						data.tipe = tipe;
						data.produk = produk;
						data.user = user;
						data.status_approve = status_approve;
					}
				},
				"order": [[ 0, "desc" ]],
				"searching": false,
				"lengthChange": false,
				"columns": [
	          {"data": 'id_dana'},
	          { "data": "jumlah_dana" }, // Tampilkan judul
	          { "data": "type_dana" },  // Tampilkan kategori
	          { "data": "lbr" },  // Tampilkan penulis
	          { "data": "jdl" },  // Tampilkan tgl posting
	          { "data": "username"},
	          { "data": "status_approve"},
	          { "data": "createddate"},
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
  
