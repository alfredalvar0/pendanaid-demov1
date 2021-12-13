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
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalOptionDownload">
	                Export Data
	              </button>
	                <!-- <a>
	                	<button onclick="export2csv()" class="form-control btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Export</button>
	                </a> -->
	            </div>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive">
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
							<?php
							  $no=1;
							  foreach ($history->result() as $dana) {

								?>
								<tr> 
								  <td><?php echo $dana->id_dana; ?></td> 
								  <td>Rp. <?php echo number_format($dana->jumlah_dana); ?></td>
								  <td class="text-center"><?php echo $dana->type_dana; ?></td>
								  <td class="text-center"><?php echo $dana->lbr; ?></td>
								  <td class="text-center"><?php echo ($dana->type_dana == 'komisi') ? 'xxx' : $dana->jdl; ?></td>
								  <td><?php echo $dana->username; ?></td>  
								  <td class="text-center"><?php echo $dana->status_approve; ?></td>
								  <td><?php echo $dana->createddate; ?></td>
								   
								</tr>
								<?php
								$no++;
							  }
							?>

						</tbody>
					  </table>
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
							<?php
							  $no=1;
							  foreach ($history->result() as $dana) {

								?>
								<tr> 
								  <td><?php echo $dana->id_dana; ?></td> 
								  <td>Rp. <?php echo $dana->jumlah_dana; ?></td>
								  <td class="text-center"><?php echo $dana->type_dana; ?></td>
								  <td class="text-center"><?php echo $dana->lbr; ?></td>
								  <td class="text-center"><?php echo $dana->jdl; ?></td>
								  <td><?php echo $dana->username; ?></td>  
								  <td class="text-center"><?php echo $dana->status_approve; ?></td>
								  <td><?php echo $dana->createddate; ?></td>
								   
								</tr>
								<?php
								$no++;
							  }
							?>

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
		$('#list-data-dana').DataTable( {
			"order": [[ 0, "desc" ]]
		} );
  </script>
  
