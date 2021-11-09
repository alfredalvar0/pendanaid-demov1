

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Menarik Dana
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              
              <div class="col-md-2">
              </div>
              <div class="msg" style="display:none;">
                <?php echo @$this->session->flashdata('msg'); ?>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">

            	<div class="col-md-2">
		        </div>
		        <div class="col-md-8">
		        </div>
		        <div class="col-md-2">
		            <button type="button" class="form-control btn btn-primary" data-toggle="modal" data-target="#flipFlop"> Menarik Dana</button>
					</button>
		        </div>

<div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<h4 class="modal-title" id="modalLabel"><strong>Select User Email</strong></h4>
</div>
<div class="modal-body">
<form method="POST" class="form-horizontal" action="<?php echo base_url() ?>Dana/withdraw">
	<div class="form-group">
      <div class="col-sm-12">
        <select name="id" class="form-control " aria-describedby="sizing-addon2">
          <?php foreach ($dataUser as $row) {?>
          	<option value="<?php echo $row['id_admin'];?>"><?php echo $row['email']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="form-group">
    	<div class="col-md-8">
    		
    	</div>
    	<div class="col-md-4">
    		<button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Submit</button>
    	</div>
    </div>
</form>
</div>
</div>
</div>
</div>
		        <hr>

              <table id="list-data" class="table table-hover js-basic-example dataTable table-custom table-striped table-bordered nowrap dataTable dtr-inline">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                  </tr>
                </thead>
                <tbody id="data-akun">
                	
	        		<?php 
	        		$no=1; 
	        		foreach ($dataTable as $row) {?>
	        			<tr>
	        				<td><?php echo $no; ?></td>
	            			<td><?php echo $row['username']; ?></td>
	            			<td><?php echo $row['email']; ?></td>
	            			<td><?php echo $row['amount']; ?></td>
	            			<td><?php echo $row['status']; ?></td>
	            			<td><?php echo $row['created_at']; ?></td>
	        			</tr>
	        		<?php $no++;
	        		 } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

