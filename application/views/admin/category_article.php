

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Category Article
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
                <button class="form-control btn btn-primary" data-toggle="modal" data-target="#formAddModal" data-category="" data-action="<?= base_url() ?>Article/category_store" data-label="Add Category"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
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
                    <th width="5%">No</th>
                    <th width="150">Category</th>
                    <th width="150">Action</th>
                  </tr>
                </thead>
                <tbody id="data-category-article">

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

  <div class="modal fade" id="formAddModal" tabindex="-1" aria-labelledby="formAddLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formAddLabel">Add Category</h5>
        </div>
        <div class="modal-body">
          <form action="<?= base_url() ?>Article/category_store" method="post" id="form_category">
            <div class="form-group">
              <label for="category" class="form-label">Category</label>
              <input type="text" class="form-control" id="category" name="category" required>
            </div>
            <div class="form-group text-right">
              <button type="submit" class="btn btn-primary">Save changes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php $this->load->view($content.'/ajax'); ?>

