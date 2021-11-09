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
      <div class="row">
			<div class="col-md-12">
				<!-- /.box -->

				  <div class="box">
					<div class="box-header text-center">
					  <h3>History Transaksi</h3>
					   
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive">
					  <table id="list-data" class="table table-hover js-basic-example dataTable table-custom table-striped table-bordered nowrap dataTable dtr-inline">
						<thead>
						  <tr> 
							<th>ID</th> 
							 
							<th>Jumlah Dana</th>
							<th>Tipe</th>
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
  <script src="<?php echo base_url(); ?>assets/admin/dist/js/pages/dashboard.js"></script>