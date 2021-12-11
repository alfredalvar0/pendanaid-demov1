

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Dana Invest
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalOptionDownload">
                  Download
                </button>
								
								<br/>
								<br/>

              </div>
              <div class="msg" style="display:none;">
                <?php echo @$this->session->flashdata('msg'); ?>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="list-data" class="table table-hover js-basic-example dataTable table-custom table-striped table-bordered nowrap dataTable dtr-inline">
                <thead>
                  <tr>
                    <th>No</th>
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
                <tbody id="data-danainvest">

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
  
<?php $this->load->view($content.'/ajax'); ?>

<!-- Modal -->
<div class="modal fade" id="modalOptionDownload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Download Report</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Please select field to show in your report :</label>
        <form action="danainvest/generateReport" method="post">
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
              Produk Invest
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="fieldList_user" name="fieldList[]" checked="true" value="user">
            <label class="form-check-label" for="defaultCheck1">
              User
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

