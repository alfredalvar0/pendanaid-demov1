

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Laporanbisnis
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
                <a href="<?php echo base_url() ?>Laporanbisnis/tambah">
                  <button class="form-control btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Buat Laporan</button>
                </a>
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
					<th>Id</th>
                    <th>Bisnis/Produk</th>
					<th>Laba</th>
					<th>Rugi</th>
					<th>Dividen</th>
					<th>Dividen Gadai</th>
					<th>Tanggal</th>
					<th>Dokumen</th>
					<th>Share Info at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="data-laporanbisnis">

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
