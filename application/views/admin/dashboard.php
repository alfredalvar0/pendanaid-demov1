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
						<div class="col-md-2">
			                <a>
			                	<button onclick="export2csv()" class="form-control btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Export</button>
			                </a>
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
  
