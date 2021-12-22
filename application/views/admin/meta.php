
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Meta Tags Setting
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
                <a href="<?php echo base_url() ?>Meta/add">
                  <button class="form-control btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
                </a>
              </div>

              <?php if ($this->session->flashdata('msg') != ''): ?>
                <script type="text/javascript">
                  $(document).ready(function () {
                    <?php if ($this->session->flashdata('status') == 'success'): ?>
                      toastr.success('<?php echo $this->session->flashdata('msg'); ?>');                      
                    <?php else: ?>
                      toastr.error('<?php echo $this->session->flashdata('msg'); ?>');
                    <?php endif ?>
                  })
                </script>

              <?php endif ?>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="list-data" class="table table-hover js-basic-example dataTable table-custom table-striped table-bordered nowrap dataTable dtr-inline">
                <thead>
                  <tr>
                    <th width="10">No</th>
                    <th>Page URL</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data->result() as $idx => $row): ?>
                    <tr>
                      <td><?php echo $idx+1 ?></td>
                      <td><?php echo $row->page_uri ?></td>
                      <td>
                        <a href="<?= base_url() ?>Meta/detail/<?= $row->id ?>" class="btn btn-sm btn-primary">Metatag Lists</a>
                        <a href="<?= base_url() ?>Meta/edit/<?= $row->id ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?= base_url() ?>Meta/delete/<?= $row->id ?>" onclick='return confirm("Anda Yakin ?")' class="btn btn-sm btn-danger">Delete</a>
                      </td>
                    </tr>
                  <?php endforeach ?>
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
  
<?php /*$this->load->view($content.'/ajax');*/ ?>

